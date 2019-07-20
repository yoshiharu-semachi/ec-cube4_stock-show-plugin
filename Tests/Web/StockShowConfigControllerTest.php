<?php

/*
 * This file is part of EC-CUBE
 *
 * Copyright(c) EC-CUBE CO.,LTD. All Rights Reserved.
 *
 * http://www.ec-cube.co.jp/
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Plugin\StockShow4\Tests\Web;

use Faker\Generator;
use Symfony\Component\HttpKernel\Client;
use Symfony\Component\DomCrawler\Crawler;
use Eccube\Tests\Web\Admin\AbstractAdminWebTestCase;

/**
 * Class StockShowConfigControllerTest.
 */
class StockShowConfigControllerTest extends AbstractAdminWebTestCase
{
    /**
     * @var Generator
     */
    protected $faker;

    /**
     * セットアップ
     */
    public function setUp()
    {
        parent::setUp();
        $this->faker = $this->getFaker();
    }

    /**
     * プラグイン設定のtwig表示テスト
     */
    public function testRouting()
    {
        /**
         * @var Client
         */
        $client = $this->client;
        /**
         * @var Crawler
         */
        $crawler = $this->client->request('GET', $this->generateUrl('stock_show4_admin_config'));

        $this->assertTrue($client->getResponse()->isSuccessful());
        $this->assertContains('指定した在庫数<b>以下</b>になったときに<br>', $crawler->html());
    }

    /**
     * プラグイン設定のテスト
     */
    public function testSuccess()
    {
        /**
         * @var Client
         */
        $client = $this->client;
        /**
         * @var Crawler
         */
        $crawler = $this->client->request('GET', $this->generateUrl('stock_show4_admin_config'));

        $this->assertTrue($client->getResponse()->isSuccessful());

        $form = $crawler->selectButton('登録')->form();

        $form['stock_show_config[stock_qty_show]'] = $this->faker->randomNumber(1);
        $crawler = $client->submit($form);

        $this->assertTrue($client->getResponse()->isRedirection($this->generateUrl('stock_show4_admin_config')));

        $crawler = $client->followRedirect();
        $this->assertContains('登録しました。', $crawler->html());
    }
}

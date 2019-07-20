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

namespace Plugin\StockShow4;

use Eccube\Event\TemplateEvent;
use Plugin\StockShow4\Repository\StockShowConfigRepository;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;

class StockShowEvent implements EventSubscriberInterface
{
    /**
     * @var StockShowConfigRepository
     */
    protected $ConfigRepository;

    /**
     * ProductReview constructor.
     *
     * @param StockShowConfigRepository $ConfigRepository
     */
    public function __construct(StockShowConfigRepository $ConfigRepository)
    {
        $this->ConfigRepository = $ConfigRepository;
    }

    /**
     * @return array
     */
    public static function getSubscribedEvents()
    {
        return [
            'Product/detail.twig' => 'StockShowTwig',
        ];
    }

    /**
     * @param TemplateEvent $event
     */
    public function StockShowTwig(TemplateEvent $event)
    {
        $twig = '@StockShow4/default/Product/stock_show.twig';
        $event->addSnippet($twig);

        $Config = $this->ConfigRepository->get();

        $parameters = $event->getParameters();
        $parameters['StockQtyShow'] = $Config->getStockQtyShow();
        $event->setParameters($parameters);
    }
}

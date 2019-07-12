<?php

namespace Plugin\StockShow4;

use Doctrine\ORM\EntityManagerInterface;
use Eccube\Plugin\AbstractPluginManager;
use Plugin\StockShow4\Entity\Config;
use Symfony\Component\DependencyInjection\ContainerInterface;

class PluginManager extends AbstractPluginManager
{
    /**
     * プラグイン有効時の処理
     *
     * @param $meta
     * @param ContainerInterface $container
     */
    public function enable(array $meta, ContainerInterface $container)
    {
        $em = $container->get('doctrine.orm.entity_manager');
        $Config = $this->createConfig($em);
    }

    /**
     * プラグイン設定を追加
     * 
     * @param EntityManagerInterface $em
     */
    protected function createConfig(EntityManagerInterface $em)
    {
        $Config = $em->find(Config::class, 1);
        if ($Config) {
            return $Config;
        }
        $Config = new Config();
        $Config->setStockQtyShow(5);

        $em->persist($Config);
        $em->flush($Config);

        return $Config;
    }
}


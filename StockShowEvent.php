<?php

namespace Plugin\StockShow4;

use Eccube\Event\TemplateEvent;
use Plugin\StockShow4\Repository\ConfigRepository;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;

class StockShowEvent implements EventSubscriberInterface
{
    /**
     * @var ConfigRepository
     */
    protected $ConfigRepository;

    /**
     * ProductReview constructor.
     * 
     * @param ConfigRepository $ConfigRepository
     */
    public function __construct(ConfigRepository $ConfigRepository)
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

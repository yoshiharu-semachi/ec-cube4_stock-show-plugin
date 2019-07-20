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

namespace Plugin\StockShow4\Controller\Admin;

use Plugin\StockShow4\Form\Type\Admin\StockShowConfigType;
use Plugin\StockShow4\Repository\StockShowConfigRepository;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpFoundation\Request;

/**
 * Class ConfigController.
 */
class ConfigController extends \Eccube\Controller\AbstractController
{
    /**
     * @Route("/%eccube_admin_route%/stock_show4/config", name="stock_show4_admin_config")
     * @Template("@StockShow4/admin/config.twig")
     *
     * @param Request $request
     * @param StockShowConfigRepository $configRepository
     *
     * @return array
     */
    public function index(Request $request, StockShowConfigRepository $configRepository)
    {
        $Config = $configRepository->get();
        $form = $this->createForm(StockShowConfigType::class, $Config);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $Config = $form->getData();
            $this->entityManager->persist($Config);
            $this->entityManager->flush($Config);

            log_info('Stock show config', ['status' => 'Success']);
            $this->addSuccess('登録しました。', 'admin');

            return $this->redirectToRoute('stock_show4_admin_config');
        }

        return [
            'form' => $form->createView(),
        ];
    }
}

<?php

namespace Plugin\StockShow4\Controller\Admin;

use Plugin\StockShow4\Form\Type\Admin\ConfigType;
use Plugin\StockShow4\Repository\ConfigRepository;
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
     * @param ConfigRepository $configRepository
     * 
     * @return array
     */
    public function index(Request $request, ConfigRepository $configRepository)
    {
        $Config = $configRepository->get();
        $form = $this->createForm(ConfigType::class, $Config);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $Config = $form->getData();
            $this->entityManager->persist($Config);
            $this->entityManager->flush($Config);

            $this->addSuccess('登録しました。', 'admin');

            return $this->redirectToRoute('stock_show4_admin_config');
        }

        return [
            'form' => $form->createView(),
        ];
    }
}

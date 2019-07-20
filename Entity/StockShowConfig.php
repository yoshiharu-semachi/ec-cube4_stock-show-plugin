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

namespace Plugin\StockShow4\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Config
 *
 * @ORM\Table(name="plg_stock_show4_config")
 * @ORM\Entity(repositoryClass="Plugin\StockShow4\Repository\StockShowConfigRepository")
 */
class StockShowConfig
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer", options={"unsigned":true})
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var int
     *
     * @ORM\Column(name="stock_qty_show", type="smallint", nullable=true, options={"unsigned":true, "default":5})
     */
    private $stock_qty_show;

    /**
     * Get id.
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Get StockQtyShow
     *
     * @return int
     */
    public function getStockQtyShow()
    {
        return $this->stock_qty_show;
    }

    /**
     * Set $qty
     *
     * @param int $qty
     *
     * @return $this;
     */
    public function setStockQtyShow($qty)
    {
        $this->stock_qty_show = $qty;

        return $this;
    }
}

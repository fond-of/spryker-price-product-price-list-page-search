<?php

namespace FondOfSpryker\Zed\PriceProductPriceListPageSearch\Business\Model;

interface PriceProductAbstractSearchWriterInterface
{
    /**
     * @param int[] $priceProductPriceListIds
     *
     * @return void
     */
    public function publishAbstractPriceProductPriceList(array $priceProductPriceListIds): void;

    /**
     * @param int[] $productAbstractIds
     *
     * @return void
     */
    public function publishAbstractPriceProductByByProductAbstractIds(array $productAbstractIds): void;
}

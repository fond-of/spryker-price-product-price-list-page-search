<?php

namespace FondOfSpryker\Zed\PriceProductPriceListPageSearch\Persistence;

use Generated\Shared\Transfer\PriceProductPriceListPageSearchTransfer;
use Orm\Zed\PriceProductPriceListPageSearch\Persistence\FosPriceProductAbstractPriceListPageSearch;
use Orm\Zed\PriceProductPriceListPageSearch\Persistence\FosPriceProductConcretePriceListPageSearch;

interface PriceProductPriceListPageSearchEntityManagerInterface
{
    /**
     * @param \Generated\Shared\Transfer\PriceProductPriceListPageSearchTransfer $priceProductPriceListPageSearchTransfer
     * @param \Orm\Zed\PriceProductPriceListPageSearch\Persistence\FosPriceProductAbstractPriceListPageSearch $priceProductAbstractPriceListPageSearchEntity
     *
     * @return void
     */
    public function updatePriceProductAbstract(
        PriceProductPriceListPageSearchTransfer $priceProductPriceListPageSearchTransfer,
        FosPriceProductAbstractPriceListPageSearch $priceProductAbstractPriceListPageSearchEntity
    ): void;

    /**
     * @param \Generated\Shared\Transfer\PriceProductPriceListPageSearchTransfer $priceProductPriceListPageSearchTransfer
     *
     * @return void
     */
    public function createPriceProductAbstract(
        PriceProductPriceListPageSearchTransfer $priceProductPriceListPageSearchTransfer
    ): void;

    /**
     * @param \Orm\Zed\PriceProductPriceListPageSearch\Persistence\FosPriceProductAbstractPriceListPageSearch[] $priceProductAbstractPriceListPageSearchEntities
     *
     * @return void
     */
    public function deletePriceProductAbstractEntities(
        array $priceProductAbstractPriceListPageSearchEntities
    ): void;

    /**
     * @param \Generated\Shared\Transfer\PriceProductPriceListPageSearchTransfer $priceProductPriceListPageSearchTransfer
     * @param \Orm\Zed\PriceProductPriceListPageSearch\Persistence\FosPriceProductConcretePriceListPageSearch $priceProductConcretePriceListPageSearchEntity
     *
     * @return void
     */
    public function updatePriceProductConcrete(
        PriceProductPriceListPageSearchTransfer $priceProductPriceListPageSearchTransfer,
        FosPriceProductConcretePriceListPageSearch $priceProductConcretePriceListPageSearchEntity
    ): void;

    /**
     * @param \Generated\Shared\Transfer\PriceProductPriceListPageSearchTransfer $priceProductPriceListPageSearchTransfer
     *
     * @return void
     */
    public function createPriceProductConcrete(
        PriceProductPriceListPageSearchTransfer $priceProductPriceListPageSearchTransfer
    ): void;

    /**
     * @param \Orm\Zed\PriceProductPriceListPageSearch\Persistence\FosPriceProductConcretePriceListPageSearch[] $priceProductConcretePriceListPageSearchEntities
     *
     * @return void
     */
    public function deletePriceProductConcreteEntities(
        array $priceProductConcretePriceListPageSearchEntities
    ): void;
}

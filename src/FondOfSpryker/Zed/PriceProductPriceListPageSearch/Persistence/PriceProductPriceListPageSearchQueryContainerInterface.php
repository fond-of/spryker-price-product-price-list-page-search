<?php

namespace FondOfSpryker\Zed\PriceProductPriceListPageSearch\Persistence;

use Orm\Zed\PriceProductPriceList\Persistence\FosPriceProductPriceListQuery;
use Spryker\Zed\Kernel\Persistence\QueryContainer\QueryContainerInterface;

interface PriceProductPriceListPageSearchQueryContainerInterface extends QueryContainerInterface
{
    /**
     * @param array $priceProductPriceListIds
     *
     * @return \Orm\Zed\PriceProductPriceList\Persistence\FosPriceProductPriceListQuery
     */
    public function queryPriceProductAbstractPriceList(array $priceProductPriceListIds): FosPriceProductPriceListQuery;

    /**
     * @param array $priceProductPriceListIds
     *
     * @return \Orm\Zed\PriceProductPriceList\Persistence\FosPriceProductPriceListQuery
     */
    public function queryPriceProductConcretePriceList(array $priceProductPriceListIds): FosPriceProductPriceListQuery;
}

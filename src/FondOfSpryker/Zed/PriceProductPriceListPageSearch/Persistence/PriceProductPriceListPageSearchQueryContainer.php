<?php

namespace FondOfSpryker\Zed\PriceProductPriceListPageSearch\Persistence;

use Orm\Zed\PriceProductPriceList\Persistence\FosPriceProductPriceListQuery;
use Propel\Runtime\ActiveQuery\Criteria;
use Spryker\Zed\Kernel\Persistence\AbstractQueryContainer;

/**
 * @method \FondOfSpryker\Zed\PriceProductPriceListPageSearch\Persistence\PriceProductPriceListPageSearchPersistenceFactory getFactory()
 */
class PriceProductPriceListPageSearchQueryContainer extends AbstractQueryContainer implements PriceProductPriceListPageSearchQueryContainerInterface
{
    /**
     * @param array $priceProductPriceListIds
     *
     * @throws
     *
     * @return \Orm\Zed\PriceProductPriceList\Persistence\FosPriceProductPriceListQuery
     */
    public function queryPriceProductAbstractPriceList(array $priceProductPriceListIds): FosPriceProductPriceListQuery
    {
        $fosPriceProductPriceListQuery = $this->getFactory()->getPropelPriceProductPriceListQuery()
            ->clear()
            ->filterByFkProductAbstract(null, Criteria::ISNOTNULL)
            ->filterByFkProduct(null, Criteria::ISNULL);

        if (empty($priceProductPriceListIds)) {
            return $fosPriceProductPriceListQuery;
        }

        return $fosPriceProductPriceListQuery->filterByIdPriceProductPriceList_In($priceProductPriceListIds);
    }

    /**
     * @param array $priceProductPriceListIds
     *
     * @throws
     *
     * @return \Orm\Zed\PriceProductPriceList\Persistence\FosPriceProductPriceListQuery
     */
    public function queryPriceProductConcretePriceList(array $priceProductPriceListIds): FosPriceProductPriceListQuery
    {
        $fosPriceProductPriceListQuery = $this->getFactory()->getPropelPriceProductPriceListQuery()
            ->clear()
            ->filterByFkProductAbstract(null, Criteria::ISNULL)
            ->filterByFkProduct(null, Criteria::ISNOTNULL);

        if (empty($priceProductPriceListIds)) {
            return $fosPriceProductPriceListQuery;
        }

        return $fosPriceProductPriceListQuery->filterByIdPriceProductPriceList_In($priceProductPriceListIds);
    }
}

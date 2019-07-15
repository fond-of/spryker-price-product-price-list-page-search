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
     * @var \Orm\Zed\PriceProductPriceList\Persistence\FosPriceProductPriceListQuery
     */
    protected $fosPriceProductPriceListQuery;

    /**
     * @param \Orm\Zed\PriceProductPriceList\Persistence\FosPriceProductPriceListQuery $fosPriceProductPriceListQuery
     */
    public function __construct(FosPriceProductPriceListQuery $fosPriceProductPriceListQuery)
    {
        $this->fosPriceProductPriceListQuery = $fosPriceProductPriceListQuery;
    }

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
            ->filterByProductAbstract(null, Criteria::ISNOTNULL)
            ->filterByProduct(null, Criteria::ISNULL);

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
            ->filterByProductAbstract(null, Criteria::ISNULL)
            ->filterByProduct(null, Criteria::ISNOTNULL);

        if (empty($priceProductPriceListIds)) {
            return $fosPriceProductPriceListQuery;
        }

        return $fosPriceProductPriceListQuery->filterByIdPriceProductPriceList_In($priceProductPriceListIds);
    }
}

<?php

namespace FondOfSpryker\Zed\PriceProductPriceListPageSearch\Persistence;

use FondOfSpryker\Zed\PriceProductPriceListPageSearch\Persistence\Propel\Mapper\PriceProductPriceListPageSearchMapper;
use FondOfSpryker\Zed\PriceProductPriceListPageSearch\Persistence\Propel\Mapper\PriceProductPriceListPageSearchMapperInterface;
use FondOfSpryker\Zed\PriceProductPriceListPageSearch\PriceProductPriceListPageSearchDependencyProvider;
use Orm\Zed\PriceProductPriceList\Persistence\FosPriceProductPriceListQuery;
use Orm\Zed\PriceProductPriceListPageSearch\Persistence\FosPriceProductAbstractPriceListPageSearchQuery;
use Orm\Zed\PriceProductPriceListPageSearch\Persistence\FosPriceProductConcretePriceListPageSearchQuery;
use Spryker\Zed\Kernel\Persistence\AbstractPersistenceFactory;

/**
 * @method \FondOfSpryker\Zed\PriceProductPriceListPageSearch\PriceProductPriceListPageSearchConfig getConfig()
 * @method \FondOfSpryker\Zed\PriceProductPriceListPageSearch\Persistence\PriceProductPriceListPageSearchEntityManagerInterface getEntityManager()
 * @method \FondOfSpryker\Zed\PriceProductPriceListPageSearch\Persistence\PriceProductPriceListPageSearchRepositoryInterface getRepository()
 * @method \FondOfSpryker\Zed\PriceProductPriceListPageSearch\Persistence\PriceProductPriceListPageSearchQueryContainerInterface getQueryContainer()
 */
class PriceProductPriceListPageSearchPersistenceFactory extends AbstractPersistenceFactory
{
    /**
     * @return \Orm\Zed\PriceProductPriceList\Persistence\FosPriceProductPriceListQuery
     */
    public function getPropelPriceProductPriceListQuery(): FosPriceProductPriceListQuery
    {
        return $this->getProvidedDependency(PriceProductPriceListPageSearchDependencyProvider::PROPEL_QUERY_PRICE_PRODUCT_PRICE_LIST);
    }

    /**
     * @return \FondOfSpryker\Zed\PriceProductPriceListPageSearch\Persistence\Propel\Mapper\PriceProductPriceListPageSearchMapperInterface
     */
    public function createPriceProductPriceListPageSearchMapper(): PriceProductPriceListPageSearchMapperInterface
    {
        return new PriceProductPriceListPageSearchMapper();
    }

    /**
     * @return \Orm\Zed\PriceProductPriceListPageSearch\Persistence\FosPriceProductAbstractPriceListPageSearchQuery
     */
    public function createPriceProductAbstractPriceListPageSearchQuery(): FosPriceProductAbstractPriceListPageSearchQuery
    {
        return FosPriceProductAbstractPriceListPageSearchQuery::create();
    }

    /**
     * @return \Orm\Zed\PriceProductPriceListPageSearch\Persistence\FosPriceProductConcretePriceListPageSearchQuery
     */
    public function createPriceProductConcretePriceListPageSearchQuery(): FosPriceProductConcretePriceListPageSearchQuery
    {
        return FosPriceProductConcretePriceListPageSearchQuery::create();
    }
}

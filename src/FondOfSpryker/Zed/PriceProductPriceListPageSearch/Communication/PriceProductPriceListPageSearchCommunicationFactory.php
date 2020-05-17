<?php

namespace FondOfSpryker\Zed\PriceProductPriceListPageSearch\Communication;

use FondOfSpryker\Zed\PriceProductPriceListPageSearch\Dependency\Facade\PriceProductPriceListPageSearchToEventBehaviorFacadeInterface;
use FondOfSpryker\Zed\PriceProductPriceListPageSearch\PriceProductPriceListPageSearchDependencyProvider;
use Spryker\Zed\Kernel\Communication\AbstractCommunicationFactory;

/**
 * @method \FondOfSpryker\Zed\PriceProductPriceListPageSearch\Persistence\PriceProductPriceListPageSearchEntityManagerInterface getEntityManager()
 * @method \FondOfSpryker\Zed\PriceProductPriceListPageSearch\PriceProductPriceListPageSearchConfig getConfig()
 * @method \FondOfSpryker\Zed\PriceProductPriceListPageSearch\Persistence\PriceProductPriceListPageSearchRepositoryInterface getRepository()
 * @method \FondOfSpryker\Zed\PriceProductPriceListPageSearch\Business\PriceProductPriceListPageSearchFacadeInterface getFacade()
 */
class PriceProductPriceListPageSearchCommunicationFactory extends AbstractCommunicationFactory
{
    /**
     * @return \FondOfSpryker\Zed\PriceProductPriceListPageSearch\Dependency\Facade\PriceProductPriceListPageSearchToEventBehaviorFacadeInterface
     */
    public function getEventBehaviorFacade(): PriceProductPriceListPageSearchToEventBehaviorFacadeInterface
    {
        return $this->getProvidedDependency(PriceProductPriceListPageSearchDependencyProvider::FACADE_EVENT_BEHAVIOR);
    }

    /**
     * @return \FondOfSpryker\Zed\PriceProductPriceListPageSearch\Dependency\Plugin\PriceProductAbstractPriceListPageMapExpanderPluginInterface[]
     */
    public function getPriceProductAbstractPriceListPageMapExpanderPlugins(): array
    {
        return $this->getProvidedDependency(PriceProductPriceListPageSearchDependencyProvider::PLUGINS_PRICE_PRODUCT_ABSTRACT_PRICE_LIST_PAGE_MAP_EXPANDER);
    }

    /**
     * @return \FondOfSpryker\Zed\PriceProductPriceListPageSearch\Dependency\Plugin\PriceProductConcretePriceListPageMapExpanderPluginInterface[]
     */
    public function getPriceProductConcretePriceListPageMapExpanderPlugins(): array
    {
        return $this->getProvidedDependency(PriceProductPriceListPageSearchDependencyProvider::PLUGINS_PRICE_PRODUCT_CONCRETE_PRICE_LIST_PAGE_MAP_EXPANDER);
    }

    /**
     * @return \FondOfSpryker\Zed\PriceProductPriceListPageSearch\Dependency\Plugin\PriceProductAbstractPriceListPageMapExpanderPluginInterface[]
     */
    public function getPriceProductAbstractPriceListPageDataExpanderPlugins(): array
    {
        return $this->getProvidedDependency(PriceProductPriceListPageSearchDependencyProvider::PLUGINS_PRICE_PRODUCT_ABSTRACT_PRICE_LIST_PAGE_MAP_EXPANDER);
    }

    /**
     * @return \FondOfSpryker\Zed\PriceProductPriceListPageSearch\Dependency\Plugin\PriceProductConcretePriceListPageDataExpanderPluginInterface[]
     */
    public function getPriceProductConcretePriceListPageDataExpanderPlugins(): array
    {
        return $this->getProvidedDependency(PriceProductPriceListPageSearchDependencyProvider::PLUGINS_PRICE_PRODUCT_CONCRETE_PRICE_LIST_PAGE_MAP_EXPANDER);
    }
}

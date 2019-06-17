<?php

namespace FondOfSpryker\Zed\PriceProductPriceListPageSearch;

use FondOfSpryker\Zed\PriceProductPriceListPageSearch\Dependency\Facade\PriceProductPriceListPageSearchToEventBehaviorFacadeBridge;
use FondOfSpryker\Zed\PriceProductPriceListPageSearch\Dependency\Facade\PriceProductPriceListPageSearchToSearchFacadeBridge;
use FondOfSpryker\Zed\PriceProductPriceListPageSearch\Dependency\Service\PriceProductPriceListPageSearchToUtilEncodingServiceBridge;
use Orm\Zed\PriceProductPriceList\Persistence\FosPriceProductPriceListQuery;
use Spryker\Zed\Kernel\AbstractBundleDependencyProvider;
use Spryker\Zed\Kernel\Container;

class PriceProductPriceListPageSearchDependencyProvider extends AbstractBundleDependencyProvider
{
    public const PROPEL_QUERY_PRICE_PRODUCT_PRICE_LIST = 'PROPEL_QUERY_PRICE_PRODUCT_PRICE_LIST';

    public const FACADE_EVENT_BEHAVIOR = 'FACADE_EVENT_BEHAVIOR';
    public const FACADE_SEARCH = 'FACADE_SEARCH';

    public const SERVICE_UTIL_ENCODING = 'SERVICE_UTIL_ENCODING';

    public const PLUGINS_PRICE_PRODUCT_ABSTRACT_PRICE_LIST_PAGE_MAP_EXPANDER = 'PLUGINS_PRICE_PRODUCT_ABSTRACT_PRICE_LIST_PAGE_MAP_EXPANDER';
    public const PLUGINS_PRICE_PRODUCT_CONCRETE_PRICE_LIST_PAGE_MAP_EXPANDER = 'PLUGINS_PRICE_PRODUCT_CONCRETE_PRICE_LIST_PAGE_MAP_EXPANDER';
    public const PLUGINS_PRICE_PRODUCT_ABSTRACT_PRICE_LIST_PAGE_DATA_EXPANDER = 'PLUGINS_PRICE_PRODUCT_ABSTRACT_PRICE_LIST_PAGE_DATA_EXPANDER';
    public const PLUGINS_PRICE_PRODUCT_CONCRETE_PRICE_LIST_PAGE_DATA_EXPANDER = 'PLUGINS_PRICE_PRODUCT_CONCRETE_PRICE_LIST_PAGE_DATA_EXPANDER';

    /**
     * @param \Spryker\Zed\Kernel\Container $container
     *
     * @return \Spryker\Zed\Kernel\Container
     */
    public function provideBusinessLayerDependencies(Container $container): Container
    {
        $container = parent::provideBusinessLayerDependencies($container);

        $container = $this->addUtilEncodingService($container);
        $container = $this->addSearchFacade($container);

        return $container;
    }

    /**
     * @param \Spryker\Zed\Kernel\Container $container
     *
     * @return \Spryker\Zed\Kernel\Container
     */
    public function provideCommunicationLayerDependencies(Container $container): Container
    {
        $container = parent::provideCommunicationLayerDependencies($container);

        $container = $this->addEventBehaviorFacade($container);
        $container = $this->addPriceProductAbstractPriceListPageMapExpanderPlugins($container);
        $container = $this->addPriceProductConcretePriceListPageMapExpanderPlugins($container);

        return $container;
    }

    /**
     * @param \Spryker\Zed\Kernel\Container $container
     *
     * @return \Spryker\Zed\Kernel\Container
     */
    public function providePersistenceLayerDependencies(Container $container): Container
    {
        $container = parent::providePersistenceLayerDependencies($container);

        $container = $this->addPropelPriceProductPriceListQuery($container);

        return $container;
    }

    /**
     * @param \Spryker\Zed\Kernel\Container $container
     *
     * @return \Spryker\Zed\Kernel\Container
     */
    protected function addEventBehaviorFacade(Container $container): Container
    {
        $container[static::FACADE_EVENT_BEHAVIOR] = function (Container $container) {
            return new PriceProductPriceListPageSearchToEventBehaviorFacadeBridge(
                $container->getLocator()->eventBehavior()->facade()
            );
        };

        return $container;
    }

    /**
     * @param \Spryker\Zed\Kernel\Container $container
     *
     * @return \Spryker\Zed\Kernel\Container
     */
    protected function addPropelPriceProductPriceListQuery(Container $container): Container
    {
        $container[static::PROPEL_QUERY_PRICE_PRODUCT_PRICE_LIST] = function () {
            return FosPriceProductPriceListQuery::create();
        };

        return $container;
    }

    /**
     * @param \Spryker\Zed\Kernel\Container $container
     *
     * @return \Spryker\Zed\Kernel\Container
     */
    protected function addSearchFacade(Container $container): Container
    {
        $container[static::FACADE_SEARCH] = function (Container $container) {
            return new PriceProductPriceListPageSearchToSearchFacadeBridge(
                $container->getLocator()->search()->facade()
            );
        };

        return $container;
    }

    /**
     * @param \Spryker\Zed\Kernel\Container $container
     *
     * @return \Spryker\Zed\Kernel\Container
     */
    protected function addUtilEncodingService(Container $container): Container
    {
        $container[static::SERVICE_UTIL_ENCODING] = function (Container $container) {
            return new PriceProductPriceListPageSearchToUtilEncodingServiceBridge(
                $container->getLocator()->utilEncoding()->service()
            );
        };

        return $container;
    }

    /**
     * @param \Spryker\Zed\Kernel\Container $container
     *
     * @return \Spryker\Zed\Kernel\Container
     */
    protected function addPriceProductAbstractPriceListPageMapExpanderPlugins(Container $container): Container
    {
        $container[static::PLUGINS_PRICE_PRODUCT_ABSTRACT_PRICE_LIST_PAGE_MAP_EXPANDER] = function (Container $container) {
            return $this->getPriceProductAbstractPriceListPageMapExpanderPlugins();
        };

        return $container;
    }

    /**
     * @return \FondOfSpryker\Zed\PriceProductPriceListPageSearch\Dependency\Plugin\PriceProductAbstractPriceListPageMapExpanderPluginInterface[]
     */
    protected function getPriceProductAbstractPriceListPageMapExpanderPlugins(): array
    {
        return [];
    }

    /**
     * @param \Spryker\Zed\Kernel\Container $container
     *
     * @return \Spryker\Zed\Kernel\Container
     */
    protected function addPriceProductConcretePriceListPageMapExpanderPlugins(Container $container): Container
    {
        $container[static::PLUGINS_PRICE_PRODUCT_ABSTRACT_PRICE_LIST_PAGE_MAP_EXPANDER] = function (Container $container) {
            return $this->getPriceProductConcretePriceListPageMapExpanderPlugins();
        };

        return $container;
    }

    /**
     * @return \FondOfSpryker\Zed\PriceProductPriceListPageSearch\Dependency\Plugin\PriceProductConcretePriceListPageMapExpanderPluginInterface[]
     */
    protected function getPriceProductConcretePriceListPageMapExpanderPlugins(): array
    {
        return [];
    }

    /**
     * @param \Spryker\Zed\Kernel\Container $container
     *
     * @return \Spryker\Zed\Kernel\Container
     */
    protected function addPriceProductAbstractPriceListPageDataExpanderPlugins(Container $container): Container
    {
        $container[static::PLUGINS_PRICE_PRODUCT_ABSTRACT_PRICE_LIST_PAGE_MAP_EXPANDER] = function (Container $container) {
            return $this->getPriceProductAbstractPriceListPageDataExpanderPlugins();
        };

        return $container;
    }

    /**
     * @return \FondOfSpryker\Zed\PriceProductPriceListPageSearch\Dependency\Plugin\PriceProductAbstractPriceListPageDataExpanderPluginInterface[]
     */
    protected function getPriceProductAbstractPriceListPageDataExpanderPlugins(): array
    {
        return [];
    }

    /**
     * @param \Spryker\Zed\Kernel\Container $container
     *
     * @return \Spryker\Zed\Kernel\Container
     */
    protected function addPriceProductConcretePriceListPageDataExpanderPlugins(Container $container): Container
    {
        $container[static::PLUGINS_PRICE_PRODUCT_ABSTRACT_PRICE_LIST_PAGE_MAP_EXPANDER] = function (Container $container) {
            return $this->getPriceProductConcretePriceListPageDataExpanderPlugins();
        };

        return $container;
    }

    /**
     * @return \FondOfSpryker\Zed\PriceProductPriceListPageSearch\Dependency\Plugin\PriceProductConcretePriceListPageDataExpanderPluginInterface[]
     */
    protected function getPriceProductConcretePriceListPageDataExpanderPlugins(): array
    {
        return [];
    }
}

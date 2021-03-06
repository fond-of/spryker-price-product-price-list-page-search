<?php

namespace FondOfSpryker\Client\PriceProductPriceListPageSearch;

use FondOfSpryker\Client\PriceProductPriceListPageSearch\Dependency\Client\PriceProductPriceListPageSearchToSearchClientBridge;
use FondOfSpryker\Client\PriceProductPriceListPageSearch\Plugin\Elasticsearch\Query\PriceProductAbstractPriceListSearchQueryPlugin;
use FondOfSpryker\Client\PriceProductPriceListPageSearch\Plugin\Elasticsearch\Query\PriceProductConcretePriceListSearchQueryPlugin;
use Spryker\Client\Kernel\AbstractDependencyProvider;
use Spryker\Client\Kernel\Container;
use Spryker\Client\Search\Dependency\Plugin\QueryInterface;

class PriceProductPriceListPageSearchDependencyProvider extends AbstractDependencyProvider
{
    public const CLIENT_SEARCH = 'CLIENT_SEARCH';

    public const PLUGIN_PRICE_PRODUCT_ABSTRACT_PRICE_LIST_SEARCH_QUERY = 'PLUGIN_PRICE_PRODUCT_ABSTRACT_PRICE_LIST_SEARCH_QUERY';
    public const PLUGIN_PRICE_PRODUCT_CONCRETE_PRICE_LIST_SEARCH_QUERY = 'PLUGIN_PRICE_PRODUCT_CONCRETE_PRICE_LIST_SEARCH_QUERY';

    public const PLUGINS_PRICE_PRODUCT_ABSTRACT_PRICE_LIST_SEARCH_COUNT_QUERY_EXPANDER = 'PLUGINS_PRICE_PRODUCT_ABSTRACT_PRICE_LIST_SEARCH_COUNT_QUERY_EXPANDER';
    public const PLUGINS_PRICE_PRODUCT_ABSTRACT_PRICE_LIST_SEARCH_RESULT_FORMATTER = 'PLUGINS_PRICE_PRODUCT_ABSTRACT_PRICE_LIST_SEARCH_RESULT_FORMATTER';
    public const PLUGINS_PRICE_PRODUCT_ABSTRACT_PRICE_LIST_SEARCH_QUERY_EXPANDER = 'PLUGINS_PRICE_PRODUCT_ABSTRACT_PRICE_LIST_SEARCH_QUERY_EXPANDER';
    public const PLUGINS_PRICE_PRODUCT_CONCRETE_PRICE_LIST_SEARCH_COUNT_QUERY_EXPANDER = 'PLUGINS_PRICE_PRODUCT_CONCRETE_PRICE_LIST_SEARCH_COUNT_QUERY_EXPANDER';
    public const PLUGINS_PRICE_PRODUCT_CONCRETE_PRICE_LIST_SEARCH_RESULT_FORMATTER = 'PLUGINS_PRICE_PRODUCT_CONCRETE_PRICE_LIST_SEARCH_RESULT_FORMATTER';

    public const PLUGINS_PRICE_PRODUCT_CONCRETE_PRICE_LIST_SEARCH_QUERY_EXPANDER = 'PLUGINS_PRICE_PRODUCT_CONCRETE_PRICE_LIST_SEARCH_QUERY_EXPANDER';

    /**
     * @param \Spryker\Client\Kernel\Container $container
     *
     * @return \Spryker\Client\Kernel\Container
     */
    public function provideServiceLayerDependencies(Container $container): Container
    {
        $container = parent::provideServiceLayerDependencies($container);

        $container = $this->addSearchClient($container);

        $container = $this->addPriceProductAbstractPriceListSearchQueryPlugin($container);
        $container = $this->addPriceProductAbstractPriceListSearchResultFormatterPlugins($container);
        $container = $this->addPriceProductAbstractPriceListSearchQueryExpanderPlugins($container);
        $container = $this->addPriceProductAbstractPriceListSearchCountQueryExpanderPlugins($container);

        $container = $this->addPriceProductConcretePriceListSearchQueryPlugin($container);
        $container = $this->addPriceProductConcretePriceListSearchResultFormatterPlugins($container);
        $container = $this->addPriceProductConcretePriceListSearchQueryExpanderPlugins($container);
        $container = $this->addPriceProductConcretePriceListSearchQueryCountExpanderPlugins($container);

        return $container;
    }

    /**
     * @param \Spryker\Client\Kernel\Container $container
     *
     * @return \Spryker\Client\Kernel\Container
     */
    protected function addSearchClient(Container $container): Container
    {
        $container[static::CLIENT_SEARCH] = function (Container $container) {
            return new PriceProductPriceListPageSearchToSearchClientBridge(
                $container->getLocator()->search()->client()
            );
        };

        return $container;
    }

    /**
     * @param \Spryker\Client\Kernel\Container $container
     *
     * @return \Spryker\Client\Kernel\Container
     */
    protected function addPriceProductAbstractPriceListSearchQueryPlugin(Container $container): Container
    {
        $container[static::PLUGIN_PRICE_PRODUCT_ABSTRACT_PRICE_LIST_SEARCH_QUERY] = function () {
            return $this->createPriceProductAbstractPriceListSearchQueryPlugin();
        };

        return $container;
    }

    /**
     * @param \Spryker\Client\Kernel\Container $container
     *
     * @return \Spryker\Client\Kernel\Container
     */
    protected function addPriceProductAbstractPriceListSearchResultFormatterPlugins(Container $container): Container
    {
        $container[static::PLUGINS_PRICE_PRODUCT_ABSTRACT_PRICE_LIST_SEARCH_RESULT_FORMATTER] = function () {
            return $this->createPriceProductAbstractPriceListSearchResultFormatterPlugins();
        };

        return $container;
    }

    /**
     * @param \Spryker\Client\Kernel\Container $container
     *
     * @return \Spryker\Client\Kernel\Container
     */
    protected function addPriceProductAbstractPriceListSearchQueryExpanderPlugins(Container $container): Container
    {
        $container[static::PLUGINS_PRICE_PRODUCT_ABSTRACT_PRICE_LIST_SEARCH_QUERY_EXPANDER] = function () {
            return $this->createPriceProductAbstractPriceListSearchQueryExpanderPlugins();
        };

        return $container;
    }

    /**
     * @param \Spryker\Client\Kernel\Container $container
     *
     * @return \Spryker\Client\Kernel\Container
     */
    protected function addPriceProductAbstractPriceListSearchCountQueryExpanderPlugins(Container $container): Container
    {
        $container[static::PLUGINS_PRICE_PRODUCT_ABSTRACT_PRICE_LIST_SEARCH_COUNT_QUERY_EXPANDER] = function () {
            return $this->createPriceProductAbstractPriceListSearchCountQueryExpanderPlugins();
        };

        return $container;
    }

    /**
     * @param \Spryker\Client\Kernel\Container $container
     *
     * @return \Spryker\Client\Kernel\Container
     */
    protected function addPriceProductConcretePriceListSearchQueryPlugin(Container $container): Container
    {
        $container[static::PLUGIN_PRICE_PRODUCT_CONCRETE_PRICE_LIST_SEARCH_QUERY] = function () {
            return $this->createPriceProductConcretePriceListSearchQueryPlugin();
        };

        return $container;
    }

    /**
     * @param \Spryker\Client\Kernel\Container $container
     *
     * @return \Spryker\Client\Kernel\Container
     */
    protected function addPriceProductConcretePriceListSearchResultFormatterPlugins(Container $container): Container
    {
        $container[static::PLUGINS_PRICE_PRODUCT_CONCRETE_PRICE_LIST_SEARCH_RESULT_FORMATTER] = function () {
            return $this->createPriceProductConcretePriceListSearchResultFormatterPlugins();
        };

        return $container;
    }

    /**
     * @param \Spryker\Client\Kernel\Container $container
     *
     * @return \Spryker\Client\Kernel\Container
     */
    protected function addPriceProductConcretePriceListSearchQueryExpanderPlugins(Container $container): Container
    {
        $container[static::PLUGINS_PRICE_PRODUCT_CONCRETE_PRICE_LIST_SEARCH_QUERY_EXPANDER] = function () {
            return $this->createPriceProductConcretePriceListSearchQueryExpanderPlugins();
        };

        return $container;
    }

    /**
     * @param \Spryker\Client\Kernel\Container $container
     *
     * @return \Spryker\Client\Kernel\Container
     */
    protected function addPriceProductConcretePriceListSearchQueryCountExpanderPlugins(Container $container): Container
    {
        $container[static::PLUGINS_PRICE_PRODUCT_CONCRETE_PRICE_LIST_SEARCH_QUERY_EXPANDER] = function () {
            return $this->createPriceProductConcretePriceListSearchCountQueryExpanderPlugins();
        };

        return $container;
    }

    /**
     * @return \Spryker\Client\Search\Dependency\Plugin\QueryInterface
     */
    protected function createPriceProductAbstractPriceListSearchQueryPlugin(): QueryInterface
    {
        return new PriceProductAbstractPriceListSearchQueryPlugin();
    }

    /**
     * @return \Spryker\Client\Search\Dependency\Plugin\QueryInterface
     */
    protected function createPriceProductConcretePriceListSearchQueryPlugin(): QueryInterface
    {
        return new PriceProductConcretePriceListSearchQueryPlugin();
    }

    /**
     * @return \Spryker\Client\Search\Dependency\Plugin\ResultFormatterPluginInterface[]
     */
    protected function createPriceProductAbstractPriceListSearchResultFormatterPlugins(): array
    {
        return [];
    }

    /**
     * @return \Spryker\Client\Search\Dependency\Plugin\QueryExpanderPluginInterface[]
     */
    protected function createPriceProductAbstractPriceListSearchQueryExpanderPlugins(): array
    {
        return [];
    }

    /**
     * @return \Spryker\Client\Search\Dependency\Plugin\QueryExpanderPluginInterface[]
     */
    protected function createPriceProductAbstractPriceListSearchCountQueryExpanderPlugins(): array
    {
        return [];
    }

    /**
     * @return \Spryker\Client\Search\Dependency\Plugin\ResultFormatterPluginInterface[]
     */
    protected function createPriceProductConcretePriceListSearchResultFormatterPlugins(): array
    {
        return [];
    }

    /**
     * @return \Spryker\Client\Search\Dependency\Plugin\QueryExpanderPluginInterface[]
     */
    protected function createPriceProductConcretePriceListSearchQueryExpanderPlugins(): array
    {
        return [];
    }

    /**
     * @return \Spryker\Client\Search\Dependency\Plugin\QueryExpanderPluginInterface[]
     */
    protected function createPriceProductConcretePriceListSearchCountQueryExpanderPlugins(): array
    {
        return [];
    }
}

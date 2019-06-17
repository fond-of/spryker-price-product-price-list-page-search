<?php

namespace FondOfSpryker\Client\PriceProductPriceListPageSearch;

use FondOfSpryker\Client\PriceProductPriceListPageSearch\Dependency\Client\PriceProductPriceListPageSearchToSearchClientBridge;
use Spryker\Client\Kernel\AbstractDependencyProvider;
use Spryker\Client\Kernel\Container;
use Spryker\Client\PriceProductPriceListPageSearch\Plugin\Elasticsearch\Query\PriceProductPriceListPageSearchQueryPlugin;
use Spryker\Client\Search\Dependency\Plugin\QueryInterface;

class PriceProductPriceListPageSearchDependencyProvider extends AbstractDependencyProvider
{
    public const CLIENT_SEARCH = 'CLIENT_SEARCH';
    public const PLUGINS_PRICE_PRODUCT_PRICE_LIST_PAGE_SEARCH_COUNT_QUERY_EXPANDER = 'PLUGINS_PRICE_PRODUCT_PRICE_LIST_PAGE_SEARCH_COUNT_QUERY_EXPANDER';
    public const PLUGINS_PRICE_PRODUCT_PRICE_LIST_PAGE_SEARCH_RESULT_FORMATTER = 'PLUGINS_PRICE_PRODUCT_PRICE_LIST_PAGE_SEARCH_RESULT_FORMATTER';
    public const PLUGINS_PRICE_PRODUCT_PRICE_LIST_PAGE_SEARCH_QUERY = 'PLUGINS_PRICE_PRODUCT_PRICE_LIST_PAGE_SEARCH_QUERY';
    public const PLUGINS_PRICE_PRODUCT_PRICE_LIST_PAGE_SEARCH_QUERY_EXPANDER = 'PLUGINS_PRICE_PRODUCT_PRICE_LIST_PAGE_SEARCH_QUERY_EXPANDER';

    /**
     * @param \Spryker\Client\Kernel\Container $container
     *
     * @return \Spryker\Client\Kernel\Container
     */
    public function provideServiceLayerDependencies(Container $container): Container
    {
        $container = parent::provideServiceLayerDependencies($container);

        $container = $this->addSearchClient($container);
        $container = $this->addPriceProductPriceListPageSearchQueryPlugin($container);
        $container = $this->addPriceProductPriceListPageSearchResultFormatterPlugins($container);
        $container = $this->addPriceProductPriceListPageSearchQueryExpanderPlugins($container);
        $container = $this->addPriceProductPriceListPageSearchQueryCountExpanderPlugins($container);

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
    }

    /**
     * @param \Spryker\Client\Kernel\Container $container
     *
     * @return \Spryker\Client\Kernel\Container
     */
    protected function addPriceProductPriceListPageSearchQueryPlugin(Container $container): Container
    {
        return $container;
    }

    /**
     * @param \Spryker\Client\Kernel\Container $container
     *
     * @return \Spryker\Client\Kernel\Container
     */
    protected function addPriceProductPriceListPageSearchResultFormatterPlugins(Container $container): Container
    {
        return $container;
    }

    /**
     * @param \Spryker\Client\Kernel\Container $container
     *
     * @return \Spryker\Client\Kernel\Container
     */
    protected function addPriceProductPriceListPageSearchQueryExpanderPlugins(Container $container): Container
    {
        return $container;
    }

    /**
     * @param \Spryker\Client\Kernel\Container $container
     *
     * @return \Spryker\Client\Kernel\Container
     */
    protected function addPriceProductPriceListPageSearchQueryCountExpanderPlugins(Container $container): Container
    {
        return $container;
    }

    /**
     * @return \Spryker\Client\Search\Dependency\Plugin\QueryInterface
     */
    protected function createPriceProductPriceListPageSearchQueryPlugin(): QueryInterface
    {
        return new PriceProductPriceListPageSearchQueryPlugin();
    }

    /**
     * @return \Spryker\Client\Search\Dependency\Plugin\ResultFormatterPluginInterface[]
     */
    protected function createPriceProductPriceListPageSearchResultFormatterPlugins(): array
    {
        return [];
    }

    /**
     * @return \Spryker\Client\Search\Dependency\Plugin\QueryExpanderPluginInterface[]
     */
    protected function createPriceProductPriceListPageSearchQueryExpanderPlugins(): array
    {
        return [];
    }

    /**
     * @return \Spryker\Client\Search\Dependency\Plugin\QueryExpanderPluginInterface[]
     */
    protected function createPriceProductPriceListPageSearchCountQueryExpanderPlugins(): array
    {
        return [];
    }
}

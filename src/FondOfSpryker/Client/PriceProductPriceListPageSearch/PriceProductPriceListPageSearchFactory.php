<?php

namespace FondOfSpryker\Client\PriceProductPriceListPageSearch;

use FondOfSpryker\Client\PriceProductPriceListPageSearch\Dependency\Client\PriceProductPriceListPageSearchToSearchClientInterface;
use Spryker\Client\Kernel\AbstractFactory;
use Spryker\Client\SearchExtension\Dependency\Plugin\QueryInterface;
use Spryker\Client\SearchExtension\Dependency\Plugin\SearchStringSetterInterface;

/**
 * @method \FondOfSpryker\Client\PriceProductPriceListPageSearch\PriceProductPriceListPageSearchConfig getConfig()
 */
class PriceProductPriceListPageSearchFactory extends AbstractFactory
{
    /**
     * @return \FondOfSpryker\Client\PriceProductPriceListPageSearch\Dependency\Client\PriceProductPriceListPageSearchToSearchClientInterface
     */
    public function getSearchClient(): PriceProductPriceListPageSearchToSearchClientInterface
    {
        return $this->getProvidedDependency(PriceProductPriceListPageSearchDependencyProvider::CLIENT_SEARCH);
    }

    /**
     * @param string $searchString
     * @param array $requestParameters
     * @param \Spryker\Client\SearchExtension\Dependency\Plugin\QueryExpanderPluginInterface[] $queryExpanderPlugins
     *
     * @return \Spryker\Client\SearchExtension\Dependency\Plugin\QueryInterface
     */
    public function createPriceProductAbstractPriceListSearchQuery(
        string $searchString,
        array $requestParameters,
        array $queryExpanderPlugins
    ): QueryInterface {
        $searchQuery = $this->getPriceProductAbstractPriceListSearchQueryPlugin();

        if ($searchQuery instanceof SearchStringSetterInterface) {
            $searchQuery->setSearchString($searchString);
        }

        $searchQuery = $this->getSearchClient()->expandQuery($searchQuery, $queryExpanderPlugins, $requestParameters);

        return $searchQuery;
    }

    /**
     * @param string $searchString
     * @param array $requestParameters
     * @param \Spryker\Client\SearchExtension\Dependency\Plugin\QueryExpanderPluginInterface[] $queryExpanderPlugins
     *
     * @return \Spryker\Client\SearchExtension\Dependency\Plugin\QueryInterface
     */
    public function createPriceProductConcretePriceListSearchQuery(
        string $searchString,
        array $requestParameters,
        array $queryExpanderPlugins
    ): QueryInterface {
        $searchQuery = $this->getPriceProductConcretePriceListSearchQueryPlugin();

        if ($searchQuery instanceof SearchStringSetterInterface) {
            $searchQuery->setSearchString($searchString);
        }

        $searchQuery = $this->getSearchClient()->expandQuery($searchQuery, $queryExpanderPlugins, $requestParameters);

        return $searchQuery;
    }

    /**
     * @return \Spryker\Client\SearchExtension\Dependency\Plugin\QueryExpanderPluginInterface[]
     */
    public function getPriceProductAbstractPriceListSearchQueryExpanderPlugins(): array
    {
        return $this->getProvidedDependency(PriceProductPriceListPageSearchDependencyProvider::PLUGINS_PRICE_PRODUCT_ABSTRACT_PRICE_LIST_SEARCH_QUERY_EXPANDER);
    }

    /**
     * @return \Spryker\Client\SearchExtension\Dependency\Plugin\QueryExpanderPluginInterface[]
     */
    public function getPriceProductAbstractPriceListSearchCountQueryExpanderPlugins(): array
    {
        return $this->getProvidedDependency(PriceProductPriceListPageSearchDependencyProvider::PLUGINS_PRICE_PRODUCT_ABSTRACT_PRICE_LIST_SEARCH_COUNT_QUERY_EXPANDER);
    }

    /**
     * @return \Spryker\Client\SearchExtension\Dependency\Plugin\ResultFormatterPluginInterface[]
     */
    public function getPriceProductAbstractPriceListSearchResultFormatters(): array
    {
        return $this->getProvidedDependency(
            PriceProductPriceListPageSearchDependencyProvider::PLUGINS_PRICE_PRODUCT_ABSTRACT_PRICE_LIST_SEARCH_RESULT_FORMATTER
        );
    }

    /**
     * @return \Spryker\Client\SearchExtension\Dependency\Plugin\QueryInterface
     */
    public function getPriceProductAbstractPriceListSearchQueryPlugin(): QueryInterface
    {
        return $this->getProvidedDependency(PriceProductPriceListPageSearchDependencyProvider::PLUGIN_PRICE_PRODUCT_ABSTRACT_PRICE_LIST_SEARCH_QUERY);
    }

    /**
     * @return \Spryker\Client\SearchExtension\Dependency\Plugin\QueryExpanderPluginInterface[]
     */
    public function getPriceProductConcretePriceListSearchQueryExpanderPlugins(): array
    {
        return $this->getProvidedDependency(PriceProductPriceListPageSearchDependencyProvider::PLUGINS_PRICE_PRODUCT_CONCRETE_PRICE_LIST_SEARCH_QUERY_EXPANDER);
    }

    /**
     * @return \Spryker\Client\SearchExtension\Dependency\Plugin\QueryExpanderPluginInterface[]
     */
    public function getPriceProductConcretePriceListSearchCountQueryExpanderPlugins(): array
    {
        return $this->getProvidedDependency(PriceProductPriceListPageSearchDependencyProvider::PLUGINS_PRICE_PRODUCT_CONCRETE_PRICE_LIST_SEARCH_COUNT_QUERY_EXPANDER);
    }

    /**
     * @return \Spryker\Client\SearchExtension\Dependency\Plugin\ResultFormatterPluginInterface[]
     */
    public function getPriceProductConcretePriceListSearchResultFormatters(): array
    {
        return $this->getProvidedDependency(
            PriceProductPriceListPageSearchDependencyProvider::PLUGINS_PRICE_PRODUCT_CONCRETE_PRICE_LIST_SEARCH_RESULT_FORMATTER
        );
    }

    /**
     * @return \Spryker\Client\SearchExtension\Dependency\Plugin\QueryInterface
     */
    public function getPriceProductConcretePriceListSearchQueryPlugin(): QueryInterface
    {
        return $this->getProvidedDependency(PriceProductPriceListPageSearchDependencyProvider::PLUGIN_PRICE_PRODUCT_CONCRETE_PRICE_LIST_SEARCH_QUERY);
    }
}

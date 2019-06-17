<?php

namespace FondOfSpryker\Client\PriceProductPriceListPageSearch;

use FondOfSpryker\Client\PriceProductPriceListPageSearch\Config\PaginationConfigBuilderInterface;
use FondOfSpryker\Client\PriceProductPriceListPageSearch\Config\PriceProductPriceListSearchPaginationConfigBuilder;
use FondOfSpryker\Client\PriceProductPriceListPageSearch\Config\PriceProductPriceListSearchSortConfigBuilder;
use FondOfSpryker\Client\PriceProductPriceListPageSearch\Config\SortConfigBuilderInterface;
use FondOfSpryker\Client\PriceProductPriceListPageSearch\Dependency\Client\PriceProductPriceListPageSearchToSearchClientInterface;
use Spryker\Client\Kernel\AbstractFactory;
use Spryker\Client\Search\Dependency\Plugin\QueryInterface;
use Spryker\Client\Search\Dependency\Plugin\SearchStringSetterInterface;

/**
 * @method \FondOfSpryker\Client\PriceProductPriceListPageSearch\PriceProductPriceListPageSearchConfig getConfig()
 */
class PriceProductPriceListPageSearchFactory extends AbstractFactory
{
    /**
     * @throws
     *
     * @return \FondOfSpryker\Client\PriceProductPriceListPageSearch\Dependency\Client\PriceProductPriceListPageSearchToSearchClientInterface
     */
    public function getSearchClient(): PriceProductPriceListPageSearchToSearchClientInterface
    {
        return $this->getProvidedDependency(PriceProductPriceListPageSearchDependencyProvider::CLIENT_SEARCH);
    }

    /**
     * @param string $searchString
     * @param array $requestParameters
     * @param \Spryker\Client\Search\Dependency\Plugin\QueryExpanderPluginInterface[] $queryExpanderPlugins
     *
     * @return \Spryker\Client\Search\Dependency\Plugin\QueryInterface
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
     * @param \Spryker\Client\Search\Dependency\Plugin\QueryExpanderPluginInterface[] $queryExpanderPlugins
     *
     * @return \Spryker\Client\Search\Dependency\Plugin\QueryInterface
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
     * @throws
     *
     * @return \Spryker\Client\Search\Dependency\Plugin\QueryExpanderPluginInterface[]
     */
    public function getPriceProductAbstractPriceListSearchQueryExpanderPlugins(): array
    {
        return $this->getProvidedDependency(PriceProductPriceListPageSearchDependencyProvider::PLUGINS_PRICE_PRODUCT_ABSTRACT_PRICE_LIST_SEARCH_QUERY_EXPANDER);
    }

    /**
     * @throws
     *
     * @return \Spryker\Client\Search\Dependency\Plugin\QueryExpanderPluginInterface[]
     */
    public function getPriceProductAbstractPriceListSearchCountQueryExpanderPlugins(): array
    {
        return $this->getProvidedDependency(PriceProductPriceListPageSearchDependencyProvider::PLUGINS_PRICE_PRODUCT_ABSTRACT_PRICE_LIST_SEARCH_COUNT_QUERY_EXPANDER);
    }

    /**
     * @throws
     *
     * @return \Spryker\Client\Search\Dependency\Plugin\ResultFormatterPluginInterface[]
     */
    public function getPriceProductAbstractPriceListSearchResultFormatters(): array
    {
        return $this->getProvidedDependency(
            PriceProductPriceListPageSearchDependencyProvider::PLUGINS_PRICE_PRODUCT_ABSTRACT_PRICE_LIST_SEARCH_RESULT_FORMATTER
        );
    }

    /**
     * @throws
     *
     * @return \Spryker\Client\Search\Dependency\Plugin\QueryInterface
     */
    public function getPriceProductAbstractPriceListSearchQueryPlugin(): QueryInterface
    {
        return $this->getProvidedDependency(PriceProductPriceListPageSearchDependencyProvider::PLUGIN_PRICE_PRODUCT_ABSTRACT_PRICE_LIST_SEARCH_QUERY);
    }

    /**
     * @throws
     *
     * @return \Spryker\Client\Search\Dependency\Plugin\QueryExpanderPluginInterface[]
     */
    public function getPriceProductConcretePriceListSearchQueryExpanderPlugins(): array
    {
        return $this->getProvidedDependency(PriceProductPriceListPageSearchDependencyProvider::PLUGINS_PRICE_PRODUCT_CONCRETE_PRICE_LIST_SEARCH_QUERY_EXPANDER);
    }

    /**
     * @throws
     *
     * @return \Spryker\Client\Search\Dependency\Plugin\QueryExpanderPluginInterface[]
     */
    public function getPriceProductConcretePriceListSearchCountQueryExpanderPlugins(): array
    {
        return $this->getProvidedDependency(PriceProductPriceListPageSearchDependencyProvider::PLUGINS_PRICE_PRODUCT_CONCRETE_PRICE_LIST_SEARCH_COUNT_QUERY_EXPANDER);
    }

    /**
     * @throws
     *
     * @return \Spryker\Client\Search\Dependency\Plugin\ResultFormatterPluginInterface[]
     */
    public function getPriceProductConcretePriceListSearchResultFormatters(): array
    {
        return $this->getProvidedDependency(
            PriceProductPriceListPageSearchDependencyProvider::PLUGINS_PRICE_PRODUCT_CONCRETE_PRICE_LIST_SEARCH_RESULT_FORMATTER
        );
    }

    /**
     * @throws
     *
     * @return \Spryker\Client\Search\Dependency\Plugin\QueryInterface
     */
    public function getPriceProductConcretePriceListSearchQueryPlugin(): QueryInterface
    {
        return $this->getProvidedDependency(PriceProductPriceListPageSearchDependencyProvider::PLUGIN_PRICE_PRODUCT_CONCRETE_PRICE_LIST_SEARCH_QUERY);
    }

    /**
     * @return \FondOfSpryker\Client\PriceProductPriceListPageSearch\Config\SortConfigBuilderInterface
     */
    public function createSortConfigBuilder(): SortConfigBuilderInterface
    {
        $sortConfigBuilder = new PriceProductPriceListSearchSortConfigBuilder();
        $sortConfigBuilder->addSort($this->getConfig()->getAscendingNameSortConfigTransfer());
        $sortConfigBuilder->addSort($this->getConfig()->getDescendingNameSortConfigTransfer());

        return $sortConfigBuilder;
    }

    /**
     * @return \FondOfSpryker\Client\PriceProductPriceListPageSearch\Config\PaginationConfigBuilderInterface
     */
    public function createPaginationConfigBuilder(): PaginationConfigBuilderInterface
    {
        $paginationConfigBuilder = new PriceProductPriceListSearchPaginationConfigBuilder();
        $paginationConfigBuilder->setPaginationConfigTransfer(
            $this->getConfig()->getPriceProductPriceListSearchPaginationConfigTransfer()
        );

        return $paginationConfigBuilder;
    }
}

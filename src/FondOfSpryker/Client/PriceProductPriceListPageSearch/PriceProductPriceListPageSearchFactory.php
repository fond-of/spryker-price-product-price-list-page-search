<?php

namespace FondOfSpryker\Client\PriceProductPriceListPageSearch;

use FondOfSpryker\Client\PriceProductPriceListPageSearch\Config\PaginationConfigBuilderInterface;
use FondOfSpryker\Client\PriceProductPriceListPageSearch\Config\PriceProductPriceListPagePaginationConfigBuilder;
use FondOfSpryker\Client\PriceProductPriceListPageSearch\Config\PriceProductPriceListPageSortConfigBuilder;
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
    public function createPriceProductPriceListPageSearchQuery(
        string $searchString,
        array $requestParameters,
        array $queryExpanderPlugins
    ): QueryInterface {
        $searchQuery = $this->getPriceProductPriceListPageSearchQueryPlugin();

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
    public function getPriceProductPriceListPageSearchQueryExpanderPlugins(): array
    {
        return $this->getProvidedDependency(PriceProductPriceListPageSearchDependencyProvider::PLUGINS_PRICE_PRODUCT_PRICE_LIST_PAGE_SEARCH_QUERY_EXPANDER);
    }

    /**
     * @throws
     *
     * @return \Spryker\Client\Search\Dependency\Plugin\QueryExpanderPluginInterface[]
     */
    public function getPriceProductPriceListPageSearchCountQueryExpanderPlugins(): array
    {
        return $this->getProvidedDependency(PriceProductPriceListPageSearchDependencyProvider::PLUGINS_PRICE_PRODUCT_PRICE_LIST_PAGE_SEARCH_COUNT_QUERY_EXPANDER);
    }

    /**
     * @throws
     *
     * @return \Spryker\Client\Search\Dependency\Plugin\ResultFormatterPluginInterface[]
     */
    public function getPriceProductPriceListPageSearchResultFormatters(): array
    {
        return $this->getProvidedDependency(
            PriceProductPriceListPageSearchDependencyProvider::PLUGINS_PRICE_PRODUCT_PRICE_LIST_PAGE_SEARCH_RESULT_FORMATTER
        );
    }

    /**
     * @throws
     *
     * @return \Spryker\Client\Search\Dependency\Plugin\QueryInterface
     */
    public function getPriceProductPriceListPageSearchQueryPlugin(): QueryInterface
    {
        return $this->getProvidedDependency(PriceProductPriceListPageSearchDependencyProvider::PLUGINS_PRICE_PRODUCT_PRICE_LIST_PAGE_SEARCH_QUERY);
    }

    /**
     * @return \FondOfSpryker\Client\PriceProductPriceListPageSearch\Config\SortConfigBuilderInterface
     */
    public function createSortConfigBuilder(): SortConfigBuilderInterface
    {
        $cmsPageSortConfigBuilder = new PriceProductPriceListPageSortConfigBuilder();
        $cmsPageSortConfigBuilder->addSort($this->getConfig()->getAscendingNameSortConfigTransfer());
        $cmsPageSortConfigBuilder->addSort($this->getConfig()->getDescendingNameSortConfigTransfer());

        return $cmsPageSortConfigBuilder;
    }

    /**
     * @return \FondOfSpryker\Client\PriceProductPriceListPageSearch\Config\PaginationConfigBuilderInterface
     */
    public function createPaginationConfigBuilder(): PaginationConfigBuilderInterface
    {
        $cmsPaginationConfigBuilder = new PriceProductPriceListPagePaginationConfigBuilder();
        $cmsPaginationConfigBuilder->setPaginationConfigTransfer(
            $this->getConfig()->getPriceProductPriceListPagePaginationConfigTransfer()
        );

        return $cmsPaginationConfigBuilder;
    }
}

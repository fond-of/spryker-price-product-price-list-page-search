<?php

namespace FondOfSpryker\Client\PriceProductPriceListPageSearch;

use Spryker\Client\Kernel\AbstractClient;

/**
 * @method \FondOfSpryker\Client\PriceProductPriceListPageSearch\PriceProductPriceListPageSearchFactory getFactory()
 */
class PriceProductPriceListPageSearchClient extends AbstractClient implements PriceProductPriceListPageSearchClientInterface
{
    /**
     * {@inheritdoc}
     *
     * @param string $searchString
     * @param array $requestParameters
     *
     * @return array
     * @api
     */
    public function searchAbstract(string $searchString, array $requestParameters): array
    {
        $queryExpanderPlugins = $this->getFactory()->getPriceProductAbstractPriceListSearchQueryExpanderPlugins();

        $searchQuery = $this->getFactory()
            ->createPriceProductAbstractPriceListSearchQuery($searchString, $requestParameters, $queryExpanderPlugins);

        $resultFormatters = $this
            ->getFactory()
            ->getPriceProductAbstractPriceListSearchResultFormatters();

        return $this
            ->getFactory()
            ->getSearchClient()
            ->search($searchQuery, $resultFormatters, $requestParameters);
    }

    /**
     * {@inheritdoc}
     *
     * @param string $searchString
     * @param array $requestParameters
     *
     * @return int
     * @api
     *
     */
    public function searchAbstractCount(string $searchString, array $requestParameters): int
    {
        $queryExpanderPlugins = $this->getFactory()->getPriceProductAbstractPriceListSearchCountQueryExpanderPlugins();

        $searchQuery = $this->getFactory()
            ->createPriceProductAbstractPriceListSearchQuery($searchString, $requestParameters, $queryExpanderPlugins);

        return $this
            ->getFactory()
            ->getSearchClient()
            ->search($searchQuery, [], $requestParameters)
            ->getTotalHits();
    }

    /**
     * {@inheritdoc}
     *
     * @param string $searchString
     * @param array $requestParameters
     *
     * @return array
     * @api
     */
    public function searchConcrete(string $searchString, array $requestParameters): array
    {
        $queryExpanderPlugins = $this->getFactory()->getPriceProductAbstractPriceListSearchQueryExpanderPlugins();

        $searchQuery = $this->getFactory()
            ->createPriceProductConcretePriceListSearchQuery($searchString, $requestParameters, $queryExpanderPlugins);

        $resultFormatters = $this
            ->getFactory()
            ->getPriceProductAbstractPriceListSearchResultFormatters();

        return $this
            ->getFactory()
            ->getSearchClient()
            ->search($searchQuery, $resultFormatters, $requestParameters);
    }

    /**
     * {@inheritdoc}
     *
     * @param string $searchString
     * @param array $requestParameters
     *
     * @return int
     * @api
     *
     */
    public function searchConcreteCount(string $searchString, array $requestParameters): int
    {
        $queryExpanderPlugins = $this->getFactory()->getPriceProductConcretePriceListSearchCountQueryExpanderPlugins();

        $searchQuery = $this->getFactory()
            ->createPriceProductConcretePriceListSearchQuery($searchString, $requestParameters, $queryExpanderPlugins);

        return $this
            ->getFactory()
            ->getSearchClient()
            ->search($searchQuery, [], $requestParameters)
            ->getTotalHits();
    }
}

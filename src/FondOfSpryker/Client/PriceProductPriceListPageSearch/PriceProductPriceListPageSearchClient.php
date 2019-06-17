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
    public function search(string $searchString, array $requestParameters): array
    {
        $queryExpanderPlugins = $this->getFactory()->getPriceProductPriceListPageSearchQueryExpanderPlugins();

        $searchQuery = $this->getFactory()
            ->createPriceProductPriceListPageSearchQuery($searchString, $requestParameters, $queryExpanderPlugins);

        $resultFormatters = $this
            ->getFactory()
            ->getPriceProductPriceListPageSearchResultFormatters();

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
    public function searchCount(string $searchString, array $requestParameters): int
    {
        $queryExpanderPlugins = $this->getFactory()->getPriceProductPriceListPageSearchCountQueryExpanderPlugins();

        $searchQuery = $this->getFactory()
            ->createPriceProductPriceListPageSearchQuery($searchString, $requestParameters, $queryExpanderPlugins);

        return $this
            ->getFactory()
            ->getSearchClient()
            ->search($searchQuery, [], $requestParameters)
            ->getTotalHits();
    }
}

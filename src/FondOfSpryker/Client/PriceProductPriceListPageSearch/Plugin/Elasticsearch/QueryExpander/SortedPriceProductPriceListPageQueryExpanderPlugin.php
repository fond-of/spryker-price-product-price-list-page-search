<?php

namespace FondOfSpryker\Client\PriceProductPriceListPageSearch\Plugin\Elasticsearch\QueryExpander;

use Elastica\Query;
use Spryker\Client\Kernel\AbstractPlugin;
use Spryker\Client\Search\Dependency\Plugin\QueryExpanderPluginInterface;
use Spryker\Client\Search\Dependency\Plugin\QueryInterface;

class SortedPriceProductPriceListPageQueryExpanderPlugin extends AbstractPlugin implements QueryExpanderPluginInterface
{
    /**
     * Specification:
     *  - Expands base query
     *
     * @api
     *
     * @param \Spryker\Client\Search\Dependency\Plugin\QueryInterface $searchQuery
     * @param array $requestParameters
     *
     * @return \Spryker\Client\Search\Dependency\Plugin\QueryInterface
     */
    public function expandQuery(QueryInterface $searchQuery, array $requestParameters = []): QueryInterface
    {
        $this->addSortingToQuery(
            $searchQuery->getSearchQuery(),
            $requestParameters
        );

        return $searchQuery;
    }

    /**
     * @param \Elastica\Query $query
     * @param array $requestParameters
     *
     * @return void
     */
    protected function addSortingToQuery(Query $query, array $requestParameters): void
    {
        $sortConfig = $this->getFactory()->createSortConfigBuilder();
        $sortParamName = $sortConfig->getActiveParamName($requestParameters);
        $sortConfigTransfer = $sortConfig->getSortConfigTransfer($sortParamName);

        if ($sortConfigTransfer === null) {
            return;
        }

        $nestedSortField = $sortConfigTransfer->getFieldName() . '.' . $sortConfigTransfer->getName();
        $query->addSort(
            [
                $nestedSortField => [
                    'order' => $sortConfig->getSortDirection($sortParamName),
                ],
            ]
        );
    }
}

<?php

namespace FondOfSpryker\Client\PriceProductPriceListPageSearch\Plugin\Elasticsearch\ResultFormatter;

use Elastica\ResultSet;
use Generated\Shared\Transfer\PaginationSearchResultTransfer;
use Spryker\Client\Search\Plugin\Elasticsearch\ResultFormatter\AbstractElasticsearchResultFormatterPlugin;

class PaginatedPriceProductPriceListPageResultFormatterPlugin extends AbstractElasticsearchResultFormatterPlugin
{
    protected const NAME = 'pagination';

    /**
     * @param \Elastica\ResultSet $searchResult
     * @param array $requestParameters
     *
     * @return \Generated\Shared\Transfer\PaginationSearchResultTransfer
     */
    protected function formatSearchResult(
        ResultSet $searchResult,
        array $requestParameters
    ): PaginationSearchResultTransfer {
        $paginationConfig = $this
            ->getFactory()
            ->createPaginationConfigBuilder();

        $itemsPerPage = $paginationConfig->getCurrentItemsPerPage($requestParameters);
        $maxPage = (int)ceil($searchResult->getTotalHits() / $itemsPerPage);
        $currentPage = min($paginationConfig->getCurrentPage($requestParameters), $maxPage);

        $paginationSearchResultTransfer = new PaginationSearchResultTransfer();
        $paginationSearchResultTransfer
            ->setNumFound($searchResult->getTotalHits())
            ->setCurrentPage($currentPage)
            ->setMaxPage($maxPage)
            ->setCurrentItemsPerPage($itemsPerPage)
            ->setConfig(clone $paginationConfig->getPaginationConfigTransfer());

        return $paginationSearchResultTransfer;
    }

    /**
     * @api
     *
     * @return string
     */
    public function getName(): string
    {
        return static::NAME;
    }
}

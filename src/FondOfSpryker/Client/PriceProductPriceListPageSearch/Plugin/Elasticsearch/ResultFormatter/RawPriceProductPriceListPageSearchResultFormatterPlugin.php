<?php

namespace FondOfSpryker\Client\PriceProductPriceListPageSearch\Plugin\Elasticsearch\ResultFormatter;

use Elastica\ResultSet;
use Generated\Shared\Search\PageIndexMap;
use Spryker\Client\Search\Plugin\Elasticsearch\ResultFormatter\AbstractElasticsearchResultFormatterPlugin;

class RawPriceProductPriceListPageSearchResultFormatterPlugin extends AbstractElasticsearchResultFormatterPlugin
{
    public const NAME = 'price_product_price_list_pages';

    /**
     * @return string
     */
    public function getName(): string
    {
        return self::NAME;
    }

    /**
     * @param \Elastica\ResultSet $searchResult
     * @param array $requestParameters
     *
     * @return array
     */
    protected function formatSearchResult(ResultSet $searchResult, array $requestParameters): array
    {
        $pages = [];
        $results = $searchResult->getResults();

        foreach ($results as $document) {
            $pages[] = $document->getSource()[PageIndexMap::SEARCH_RESULT_DATA];
        }

        return $pages;
    }
}

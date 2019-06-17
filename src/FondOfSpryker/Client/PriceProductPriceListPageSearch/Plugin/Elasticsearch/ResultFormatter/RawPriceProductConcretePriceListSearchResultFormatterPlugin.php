<?php

namespace FondOfSpryker\Client\PriceProductPriceListPageSearch\Plugin\Elasticsearch\ResultFormatter;

use Elastica\ResultSet;
use Generated\Shared\Search\PageIndexMap;
use Spryker\Client\Search\Plugin\Elasticsearch\ResultFormatter\AbstractElasticsearchResultFormatterPlugin;

/**
 * @method \FondOfSpryker\Client\PriceProductPriceListPageSearch\PriceProductPriceListPageSearchFactory getFactory()
 */
class RawPriceProductConcretePriceListSearchResultFormatterPlugin extends AbstractElasticsearchResultFormatterPlugin
{
    public const NAME = 'price_product_concrete_price_lists';

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

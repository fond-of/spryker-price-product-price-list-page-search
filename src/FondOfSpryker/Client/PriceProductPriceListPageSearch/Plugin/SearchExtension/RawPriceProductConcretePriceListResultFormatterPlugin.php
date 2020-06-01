<?php

namespace FondOfSpryker\Client\PriceProductPriceListPageSearch\Plugin\SearchExtension;

use Elastica\ResultSet;
use Generated\Shared\Search\PriceProductPriceListIndexMap;
use Spryker\Client\SearchElasticsearch\Plugin\ResultFormatter\AbstractElasticsearchResultFormatterPlugin;

class RawPriceProductConcretePriceListResultFormatterPlugin extends AbstractElasticsearchResultFormatterPlugin
{
    public const NAME = 'price_product_concrete_price_lists';

    /**
     * {@inheritDoc}
     *
     * @param \Elastica\ResultSet $searchResult
     * @param array $requestParameters
     *
     * @return mixed
     */
    protected function formatSearchResult(ResultSet $searchResult, array $requestParameters)
    {
        $pages = [];
        $results = $searchResult->getResults();

        foreach ($results as $document) {
            $pages[] = $document->getSource()[PriceProductPriceListIndexMap::SEARCH_RESULT_DATA];
        }

        return $pages;
    }

    /**
     * {@inheritDoc}
     *
     * @api
     *
     * @return string
     */
    public function getName(): string
    {
        return static::NAME;
    }
}

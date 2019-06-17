<?php

namespace FondOfSpryker\Client\PriceProductPriceListPageSearch;

interface PriceProductPriceListPageSearchClientInterface
{
    /**
     * Specification:
     * - A query based on the given search string and request parameters will be executed
     * - The query will also create facet aggregations, pagination and sorting based on the request parameters
     * - The result is a formatted associative array where the used result formatters' name are the keys and their results are the values
     *
     * @api
     *
     * @param string $searchString
     * @param array $requestParameters
     *
     * @return array
     */
    public function search(string $searchString, array $requestParameters): array;

    /**
     * Specification:
     * - A query based on the given search string and request parameters will be executed
     * - The result is a number of hits
     *
     * @api
     *
     * @param string $searchString
     * @param array $requestParameters
     *
     * @return int
     */
    public function searchCount(string $searchString, array $requestParameters): int;
}

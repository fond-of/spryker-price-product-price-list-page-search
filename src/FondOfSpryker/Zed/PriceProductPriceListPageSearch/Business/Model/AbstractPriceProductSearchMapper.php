<?php

namespace FondOfSpryker\Zed\PriceProductPriceListPageSearch\Business\Model;

use FondOfSpryker\Zed\PriceProductPriceListPageSearch\Dependency\Facade\PriceProductPriceListPageSearchToStoreFacadeInterface;
use Generated\Shared\Search\ConditionalAvailabilityPeriodIndexMap;
use Generated\Shared\Search\PriceProductPriceListIndexMap;

abstract class AbstractPriceProductSearchMapper implements PriceProductSearchMapperInterface
{
    protected const DATA_KEY_STORE = 'store';
    protected const DATA_KEY_ID_PRICE_LIST = 'id_price_list';
    protected const DATA_KEY_SKU = 'sku';
    protected const DATA_KEY_PRICE_LIST_NAME = 'price_list_name';
    protected const DATA_KEY_PRICES = 'prices';

    protected const SEARCH_RESULT_DATA_KEY_SKU = 'sku';
    protected const SEARCH_RESULT_DATA_KEY_PRICE_LIST_NAME = 'price_list_name';
    protected const SEARCH_RESULT_DATA_KEY_ID_PRICE_LIST = 'id_price_list';
    protected const SEARCH_RESULT_DATA_KEY_PRICES = 'prices';

    /**
     * @var \FondOfSpryker\Zed\PriceProductPriceListPageSearch\Dependency\Facade\PriceProductPriceListPageSearchToStoreFacadeInterface
     */
    protected $storeFacade;

    /**
     * @param \FondOfSpryker\Zed\PriceProductPriceListPageSearch\Dependency\Facade\PriceProductPriceListPageSearchToStoreFacadeInterface $storeFacade
     */
    public function __construct(PriceProductPriceListPageSearchToStoreFacadeInterface $storeFacade)
    {
        $this->storeFacade = $storeFacade;
    }

    /**
     * @param array $data
     *
     * @return array
     */
    public function mapDataToSearchData(array $data): array
    {
        $store = $this->storeFacade->getCurrentStore()->getName();

        if (isset($data[static::DATA_KEY_STORE])) {
            $store = $data[static::DATA_KEY_STORE];
        }

        $searchData = [
            PriceProductPriceListIndexMap::STORE => $store,
            PriceProductPriceListIndexMap::LOCALE => null,
            PriceProductPriceListIndexMap::ID_PRICE_LIST => $data[static::DATA_KEY_ID_PRICE_LIST],
            PriceProductPriceListIndexMap::SKU => $data[static::DATA_KEY_SKU],
            PriceProductPriceListIndexMap::PRICE_LIST_NAME => $data[static::DATA_KEY_PRICE_LIST_NAME],
            ConditionalAvailabilityPeriodIndexMap::SEARCH_RESULT_DATA => $this->mapDataToSearchResultData($data),
        ];

        $searchData = $this->expandSearchData($data, $searchData);

        return $searchData;
    }

    /**
     * @param array $data
     *
     * @return array
     */
    protected function mapDataToSearchResultData(array $data): array
    {
        return [
            static::SEARCH_RESULT_DATA_KEY_SKU => $data[static::DATA_KEY_SKU],
            static::SEARCH_RESULT_DATA_KEY_PRICE_LIST_NAME => $data[static::DATA_KEY_PRICE_LIST_NAME],
            static::SEARCH_RESULT_DATA_KEY_ID_PRICE_LIST => $data[static::DATA_KEY_ID_PRICE_LIST],
            static::SEARCH_RESULT_DATA_KEY_PRICES => $data[static::DATA_KEY_PRICES],
        ];
    }

    /**
     * @param array $data
     * @param array $searchData
     *
     * @return array
     */
    abstract protected function expandSearchData(array $data, array $searchData): array;
}

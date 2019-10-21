<?php

namespace FondOfSpryker\Zed\PriceProductPriceListPageSearch\Communication\Plugin\Search;

use FondOfSpryker\Shared\PriceProductPriceListPageSearch\PriceProductPriceListPageSearchConstants;

class PriceProductConcretePriceListPageMapPlugin extends AbstractPriceProductPriceListPageMapPlugin
{
    protected const KEY_ID_PRODUCT_CONCRETE = 'id_product';
    protected const TYPE_PRICE_PRODUCT_CONCRETE_PRICE_LIST = 'price_product_concrete_price_list';

    /**
     * {@inheritdoc}
     *
     * @return string
     * @api
     *
     */
    public function getName(): string
    {
        return PriceProductPriceListPageSearchConstants::PRICE_PRODUCT_CONCRETE_PRICE_LIST_RESOURCE_NAME;
    }

    /**
     * @return string
     */
    protected function getKeyIdProduct(): string
    {
        return static::KEY_ID_PRODUCT_CONCRETE;
    }

    /**
     * @return string
     */
    protected function getTypeProductPriceList(): string
    {
        return static::TYPE_PRICE_PRODUCT_CONCRETE_PRICE_LIST;
    }
}

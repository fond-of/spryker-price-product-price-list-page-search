<?php

namespace FondOfSpryker\Zed\PriceProductPriceListPageSearch\Communication\Plugin\Search;

use FondOfSpryker\Shared\PriceProductPriceListPageSearch\PriceProductPriceListPageSearchConstants;

class PriceProductAbstractPriceListPageMapPlugin extends AbstractPriceProductPriceListPageMapPlugin
{
    protected const KEY_ID_PRODUCT_ABSTRACT = 'id_product_abstract';
    protected const TYPE_PRICE_PRODUCT_ABSTRACT_PRICE_LIST = 'price_product_abstract_price_list';

    /**
     * {@inheritdoc}
     *
     * @return string
     * @api
     *
     */
    public function getName(): string
    {
        return PriceProductPriceListPageSearchConstants::PRICE_PRODUCT_ABSTRACT_PRICE_LIST_RESOURCE_NAME;
    }

    /**
     * @return string
     */
    protected function getKeyIdProduct(): string
    {
        return static::KEY_ID_PRODUCT_ABSTRACT;
    }

    /**
     * @return string
     */
    protected function getTypeProductPriceList(): string
    {
        return static::TYPE_PRICE_PRODUCT_ABSTRACT_PRICE_LIST;
    }
}

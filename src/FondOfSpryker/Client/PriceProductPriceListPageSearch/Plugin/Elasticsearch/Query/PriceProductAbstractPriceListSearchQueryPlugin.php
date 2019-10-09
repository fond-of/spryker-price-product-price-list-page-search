<?php

namespace FondOfSpryker\Client\PriceProductPriceListPageSearch\Plugin\Elasticsearch\Query;

class PriceProductAbstractPriceListSearchQueryPlugin extends AbstractPriceProductPriceListSearchQueryPlugin
{
    protected const TYPE = 'price_product_abstract_price_list';

    /**
     * @return string
     */
    protected function getType(): string
    {
        return static::TYPE;
    }
}

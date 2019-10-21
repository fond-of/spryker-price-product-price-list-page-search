<?php

namespace FondOfSpryker\Client\PriceProductPriceListPageSearch\Plugin\Elasticsearch\Query;

class PriceProductConcretePriceListSearchQueryPlugin extends AbstractPriceProductPriceListSearchQueryPlugin
{
    protected const TYPE = 'price_product_concrete_price_list';

    /**
     * @return string
     */
    protected function getType(): string
    {
        return static::TYPE;
    }
}

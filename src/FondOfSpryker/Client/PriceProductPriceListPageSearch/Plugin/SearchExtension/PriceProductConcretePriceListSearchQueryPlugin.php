<?php

namespace FondOfSpryker\Client\PriceProductPriceListPageSearch\Plugin\SearchExtension;

class PriceProductConcretePriceListSearchQueryPlugin extends AbstractPriceProductPriceListSearchQueryPlugin
{
    protected const TYPE = 'concrete';

    /**
     * @return string
     */
    protected function getType(): string
    {
        return static::TYPE;
    }
}

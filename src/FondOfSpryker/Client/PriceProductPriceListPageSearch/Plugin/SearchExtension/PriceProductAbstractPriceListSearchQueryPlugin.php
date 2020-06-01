<?php

namespace FondOfSpryker\Client\PriceProductPriceListPageSearch\Plugin\SearchExtension;

class PriceProductAbstractPriceListSearchQueryPlugin extends AbstractPriceProductPriceListSearchQueryPlugin
{
    protected const TYPE = 'abstract';

    /**
     * @return string
     */
    protected function getType(): string
    {
        return static::TYPE;
    }
}

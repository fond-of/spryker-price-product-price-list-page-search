<?php

namespace FondOfSpryker\Zed\PriceProductPriceListPageSearch\Dependency\Plugin;

use Generated\Shared\Transfer\PriceProductPriceListPageSearchTransfer;

interface PriceProductAbstractPriceListPageDataExpanderPluginInterface
{
    /**
     * Specification:
     * - Expands the provided PriceProductPriceListPageSearchTransfer transfer object's data by reference.
     *
     * @api
     *
     * @param \Generated\Shared\Transfer\PriceProductPriceListPageSearchTransfer $priceProductPriceListPageSearchTransfer
     *
     * @return PriceProductPriceListPageSearchTransfer
     */
    public function expand(
        PriceProductPriceListPageSearchTransfer $priceProductPriceListPageSearchTransfer
    ): PriceProductPriceListPageSearchTransfer;
}

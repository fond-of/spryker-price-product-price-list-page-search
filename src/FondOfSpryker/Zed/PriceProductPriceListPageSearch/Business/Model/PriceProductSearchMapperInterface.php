<?php

namespace FondOfSpryker\Zed\PriceProductPriceListPageSearch\Business\Model;

use FondOfSpryker\Shared\PriceProductPriceListPageSearch\PriceProductPriceListPageSearchConstants;
use Generated\Shared\Transfer\PriceProductPriceListPageSearchTransfer;

interface PriceProductSearchMapperInterface
{
    /**
     * @param \Generated\Shared\Transfer\PriceProductPriceListPageSearchTransfer $priceProductPriceListPageSearchTransfer
     * @param string $resourceName
     *
     * @return array
     */
    public function mapTransferToSearchData(
        PriceProductPriceListPageSearchTransfer $priceProductPriceListPageSearchTransfer,
        string $resourceName = PriceProductPriceListPageSearchConstants::PRICE_PRODUCT_ABSTRACT_PRICE_LIST_RESOURCE_NAME
    ): array;
}

<?php

namespace FondOfSpryker\Zed\PriceProductPriceListPageSearch\Business\Model;

use FondOfSpryker\Shared\PriceProductPriceListPageSearch\PriceProductPriceListPageSearchConstants;
use FondOfSpryker\Zed\PriceProductPriceListPageSearch\Dependency\Facade\PriceProductPriceListPageSearchToSearchFacadeInterface;
use Generated\Shared\Transfer\LocaleTransfer;
use Generated\Shared\Transfer\PriceProductPriceListPageSearchTransfer;

class PriceProductSearchMapper implements PriceProductSearchMapperInterface
{
    /**
     * @var \FondOfSpryker\Zed\PriceProductPriceListPageSearch\Dependency\Facade\PriceProductPriceListPageSearchToSearchFacadeInterface
     */
    protected $searchFacade;

    /**
     * @param \FondOfSpryker\Zed\PriceProductPriceListPageSearch\Dependency\Facade\PriceProductPriceListPageSearchToSearchFacadeInterface $searchFacade
     */
    public function __construct(PriceProductPriceListPageSearchToSearchFacadeInterface $searchFacade)
    {
        $this->searchFacade = $searchFacade;
    }

    /**
     * @param \Generated\Shared\Transfer\PriceProductPriceListPageSearchTransfer $priceProductPriceListPageSearchTransfer
     * @param string $resourceName
     *
     * @return array
     */
    public function mapTransferToSearchData(
        PriceProductPriceListPageSearchTransfer $priceProductPriceListPageSearchTransfer,
        string $resourceName = PriceProductPriceListPageSearchConstants::PRICE_PRODUCT_ABSTRACT_PRICE_LIST_RESOURCE_NAME
    ): array {
        return $this->searchFacade->transformPageMapToDocumentByMapperName(
            $priceProductPriceListPageSearchTransfer->toArray(true, true),
            new LocaleTransfer(),
            $resourceName
        );
    }
}

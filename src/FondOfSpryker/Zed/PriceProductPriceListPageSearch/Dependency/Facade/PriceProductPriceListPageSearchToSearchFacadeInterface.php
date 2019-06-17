<?php

namespace FondOfSpryker\Zed\PriceProductPriceListPageSearch\Dependency\Facade;

use Generated\Shared\Transfer\LocaleTransfer;

interface PriceProductPriceListPageSearchToSearchFacadeInterface
{
    /**
     * @param array $data
     * @param \Generated\Shared\Transfer\LocaleTransfer $localeTransfer
     * @param string $mapperName
     *
     * @return array
     */
    public function transformPageMapToDocumentByMapperName(
        array $data,
        LocaleTransfer $localeTransfer,
        $mapperName
    ): array;
}

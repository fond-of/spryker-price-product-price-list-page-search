<?php

namespace FondOfSpryker\Zed\PriceProductPriceListPageSearch\Dependency\Facade;

use Generated\Shared\Transfer\LocaleTransfer;
use Spryker\Zed\Search\Business\SearchFacadeInterface;

class PriceProductPriceListPageSearchToSearchFacadeBridge implements PriceProductPriceListPageSearchToSearchFacadeInterface
{
    /**
     * @var \Spryker\Zed\Search\Business\SearchFacadeInterface
     */
    protected $searchFacade;

    /**
     * @param \Spryker\Zed\Search\Business\SearchFacadeInterface $searchFacade
     */
    public function __construct(SearchFacadeInterface $searchFacade)
    {
        $this->searchFacade = $searchFacade;
    }

    /**
     * @param array $data
     * @param \Generated\Shared\Transfer\LocaleTransfer $localeTransfer
     * @param string $mapperName
     *
     * @throws
     *
     * @return array
     */
    public function transformPageMapToDocumentByMapperName(
        array $data,
        LocaleTransfer $localeTransfer,
        $mapperName
    ): array {
        return $this->searchFacade->transformPageMapToDocumentByMapperName($data, $localeTransfer, $mapperName);
    }
}

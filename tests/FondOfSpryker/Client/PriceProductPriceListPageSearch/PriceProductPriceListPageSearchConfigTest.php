<?php

namespace FondOfSpryker\Client\PriceProductPriceListPageSearch;

use Codeception\Test\Unit;
use Generated\Shared\Transfer\PaginationConfigTransfer;
use Generated\Shared\Transfer\SortConfigTransfer;

class PriceProductPriceListPageSearchConfigTest extends Unit
{
    /**
     * @var \FondOfSpryker\Client\PriceProductPriceListPageSearch\PriceProductPriceListPageSearchConfig
     */
    protected $priceProductPriceListPageSearchConfig;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->priceProductPriceListPageSearchConfig = new PriceProductPriceListPageSearchConfig();
    }

    /**
     * @return void
     */
    public function testGetPriceProductPriceListSearchPaginationConfigTransfer(): void
    {
        $this->assertInstanceOf(PaginationConfigTransfer::class, $this->priceProductPriceListPageSearchConfig->getPriceProductPriceListSearchPaginationConfigTransfer());
    }

    /**
     * @return void
     */
    public function testGetAscendingNameSortConfigTransfer(): void
    {
        $this->assertInstanceOf(SortConfigTransfer::class, $this->priceProductPriceListPageSearchConfig->getAscendingNameSortConfigTransfer());
    }

    /**
     * @return void
     */
    public function testGetDescendingNameSortConfigTransfer(): void
    {
        $this->assertInstanceOf(SortConfigTransfer::class, $this->priceProductPriceListPageSearchConfig->getDescendingNameSortConfigTransfer());
    }
}

<?php

namespace FondOfSpryker\Client\PriceProductPriceListPageSearch\Config;

use Codeception\Test\Unit;
use Generated\Shared\Transfer\PaginationConfigTransfer;

class PriceProductPriceListSearchPaginationConfigBuilderTest extends Unit
{
    /**
     * @var \FondOfSpryker\Client\PriceProductPriceListPageSearch\Config\PriceProductPriceListSearchPaginationConfigBuilder
     */
    protected $priceProductPriceListSearchPaginationConfigBuilder;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Generated\Shared\Transfer\PaginationConfigTransfer
     */
    protected $paginationConfigTransferMock;

    /**
     * @var array
     */
    protected $requestParameters;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->paginationConfigTransferMock = $this->getMockBuilder(PaginationConfigTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->requestParameters = [
            "string" => 1,
        ];

        $this->priceProductPriceListSearchPaginationConfigBuilder = new PriceProductPriceListSearchPaginationConfigBuilder();
        $this->priceProductPriceListSearchPaginationConfigBuilder->setPaginationConfigTransfer($this->paginationConfigTransferMock);
    }

    /**
     * @return void
     */
    public function testSetPaginationConfigTransfer(): void
    {
        $this->priceProductPriceListSearchPaginationConfigBuilder->setPaginationConfigTransfer($this->paginationConfigTransferMock);
    }

    /**
     * @return void
     */
    public function testGetPaginationConfigTransfer(): void
    {
        $this->assertInstanceOf(PaginationConfigTransfer::class, $this->priceProductPriceListSearchPaginationConfigBuilder->getPaginationConfigTransfer());
    }

    /**
     * @return void
     */
    public function testGetCurrentPage(): void
    {
        $this->paginationConfigTransferMock->expects($this->atLeastOnce())
            ->method('requireParameterName')
            ->willReturn($this->paginationConfigTransferMock);

        $this->paginationConfigTransferMock->expects($this->atLeastOnce())
            ->method('getParameterName')
            ->willReturn("string");

        $this->assertSame(1, $this->priceProductPriceListSearchPaginationConfigBuilder->getCurrentPage($this->requestParameters));
    }

    /**
     * @return void
     */
    public function testGetCurrentItemsPerPage(): void
    {
        $this->paginationConfigTransferMock->expects($this->atLeastOnce())
            ->method('getItemsPerPageParameterName')
            ->willReturn("string");

        $this->paginationConfigTransferMock->expects($this->atLeastOnce())
            ->method('getValidItemsPerPageOptions')
            ->willReturn([1]);

        $this->assertSame(1, $this->priceProductPriceListSearchPaginationConfigBuilder->getCurrentItemsPerPage($this->requestParameters));
    }

    /**
     * @return void
     */
    public function testGetCurrentItemsPerPageFalse(): void
    {
        $this->paginationConfigTransferMock->expects($this->atLeastOnce())
            ->method('getItemsPerPageParameterName')
            ->willReturn("string");

        $this->paginationConfigTransferMock->expects($this->atLeastOnce())
            ->method('getValidItemsPerPageOptions')
            ->willReturn([5]);

        $this->paginationConfigTransferMock->expects($this->atLeastOnce())
            ->method('getDefaultItemsPerPage')
            ->willReturn(4);

        $this->assertSame(4, $this->priceProductPriceListSearchPaginationConfigBuilder->getCurrentItemsPerPage($this->requestParameters));
    }
}

<?php

namespace FondOfSpryker\Client\PriceProductPriceListPageSearch\Config;

use Codeception\Test\Unit;
use Generated\Shared\Transfer\SortConfigTransfer;

class PriceProductPriceListSearchSortConfigBuilderTest extends Unit
{
    /**
     * @var \FondOfSpryker\Client\PriceProductPriceListPageSearch\Config\PriceProductPriceListSearchSortConfigBuilder
     */
    protected $priceProductPriceListSearchSortConfigBuilder;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Generated\Shared\Transfer\SortConfigTransfer
     */
    protected $sortConfigTransferMock;

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

        $this->sortConfigTransferMock = $this->getMockBuilder(SortConfigTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->requestParameters = [
            "sort" => "asc",
        ];

        $this->priceProductPriceListSearchSortConfigBuilder = new PriceProductPriceListSearchSortConfigBuilder();

        $this->sortConfigTransferMock->expects($this->atLeastOnce())
            ->method('requireName')
            ->willReturn($this->sortConfigTransferMock);

        $this->sortConfigTransferMock->expects($this->atLeastOnce())
            ->method('requireParameterName')
            ->willReturn($this->sortConfigTransferMock);

        $this->sortConfigTransferMock->expects($this->atLeastOnce())
            ->method('requireFieldName')
            ->willReturn($this->sortConfigTransferMock);

        $this->sortConfigTransferMock->expects($this->atLeastOnce())
            ->method('getParameterName')
            ->willReturn('sort');

        $this->priceProductPriceListSearchSortConfigBuilder->addSort($this->sortConfigTransferMock);
    }

    /**
     * @return void
     */
    public function testAddSort(): void
    {
        $this->sortConfigTransferMock->expects($this->atLeastOnce())
            ->method('requireName')
            ->willReturn($this->sortConfigTransferMock);

        $this->sortConfigTransferMock->expects($this->atLeastOnce())
            ->method('requireParameterName')
            ->willReturn($this->sortConfigTransferMock);

        $this->sortConfigTransferMock->expects($this->atLeastOnce())
            ->method('requireFieldName')
            ->willReturn($this->sortConfigTransferMock);

        $this->sortConfigTransferMock->expects($this->atLeastOnce())
            ->method('getParameterName')
            ->willReturn('sort');

        $this->assertInstanceOf(PriceProductPriceListSearchSortConfigBuilder::class, $this->priceProductPriceListSearchSortConfigBuilder->addSort($this->sortConfigTransferMock));
    }

    /**
     * @return void
     */
    public function testGetSortConfigTransfer(): void
    {
        $this->assertInstanceOf(SortConfigTransfer::class, $this->priceProductPriceListSearchSortConfigBuilder->getSortConfigTransfer("sort"));
    }

    /**
     * @return void
     */
    public function testGetAllSortConfigTransfer(): void
    {
        $this->assertIsArray($this->priceProductPriceListSearchSortConfigBuilder->getAllSortConfigTransfers());
    }

    /**
     * @return void
     */
    public function testGetActiveParamName(): void
    {
        $this->assertSame("asc", $this->priceProductPriceListSearchSortConfigBuilder->getActiveParamName($this->requestParameters));
    }

    /**
     * @return void
     */
    public function testGetSortDirectionAsc(): void
    {
        $this->assertSame("asc", $this->priceProductPriceListSearchSortConfigBuilder->getSortDirection("sort"));
    }

    /**
     * @return void
     */
    public function testGetSortDirectionDesc(): void
    {
        $this->sortConfigTransferMock->expects($this->atLeastOnce())
            ->method('getIsDescending')
            ->willReturn(true);

        $this->assertSame("desc", $this->priceProductPriceListSearchSortConfigBuilder->getSortDirection("sort"));
    }

    /**
     * @return void
     */
    public function testGetSortDirectionParamNameNull(): void
    {
        $this->assertNull($this->priceProductPriceListSearchSortConfigBuilder->getSortDirection(null));
    }

    /**
     * @return void
     */
    public function testGetSortDirectionConfigTransferNull(): void
    {
        $this->assertNull($this->priceProductPriceListSearchSortConfigBuilder->getSortDirection("test"));
    }
}

<?php

namespace FondOfSpryker\Zed\PriceProductPriceListPageSearch\Dependency\Facade;

use Codeception\Test\Unit;
use Generated\Shared\Transfer\LocaleTransfer;
use Spryker\Zed\Search\Business\SearchFacadeInterface;

class PriceProductPriceListPageSearchToSearchFacadeBridgeTest extends Unit
{
    /**
     * @var \FondOfSpryker\Zed\PriceProductPriceListPageSearch\Dependency\Facade\PriceProductPriceListPageSearchToSearchFacadeBridge
     */
    protected $priceProductPriceListPageSearchToSearchFacadeBridge;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Spryker\Zed\Search\Business\SearchFacadeInterface
     */
    protected $searchFacadeInterfaceMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Generated\Shared\Transfer\LocaleTransfer
     */
    protected $localeTransferMock;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->searchFacadeInterfaceMock = $this->getMockBuilder(SearchFacadeInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->localeTransferMock = $this->getMockBuilder(LocaleTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->priceProductPriceListPageSearchToSearchFacadeBridge = new PriceProductPriceListPageSearchToSearchFacadeBridge($this->searchFacadeInterfaceMock);
    }

    /**
     * @return void
     */
    public function testTransformPageMapToDocumentByMapperName(): void
    {
        $this->searchFacadeInterfaceMock->expects($this->atLeastOnce())
            ->method('transformPageMapToDocumentByMapperName')
            ->willReturn([]);

        $this->assertIsArray($this->priceProductPriceListPageSearchToSearchFacadeBridge->transformPageMapToDocumentByMapperName([], $this->localeTransferMock, "mapper name"));
    }
}

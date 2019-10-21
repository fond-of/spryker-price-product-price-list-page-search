<?php

namespace FondOfSpryker\Zed\PriceProductPriceListPageSearch\Business\Model;

use Codeception\Test\Unit;
use FondOfSpryker\Zed\PriceProductPriceListPageSearch\Dependency\Facade\PriceProductPriceListPageSearchToSearchFacadeInterface;
use Generated\Shared\Transfer\PriceProductPriceListPageSearchTransfer;

class PriceProductSearchMapperTest extends Unit
{
    /**
     * @var \FondOfSpryker\Zed\PriceProductPriceListPageSearch\Business\Model\PriceProductSearchMapper
     */
    protected $priceProductSearchMapper;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\FondOfSpryker\Zed\PriceProductPriceListPageSearch\Dependency\Facade\PriceProductPriceListPageSearchToSearchFacadeInterface
     */
    protected $searchFacadeMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Generated\Shared\Transfer\PriceProductPriceListPageSearchTransfer
     */
    protected $priceProductPriceListPageSearchTransferMock;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->searchFacadeMock = $this->getMockBuilder(PriceProductPriceListPageSearchToSearchFacadeInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->priceProductPriceListPageSearchTransferMock = $this->getMockBuilder(PriceProductPriceListPageSearchTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->priceProductSearchMapper = new PriceProductSearchMapper($this->searchFacadeMock);
    }

    /**
     * @return void
     */
    public function testMapTransferToSearchData(): void
    {
        $this->priceProductPriceListPageSearchTransferMock->expects($this->atLeastOnce())
            ->method('toArray')
            ->willReturn([]);

        $this->searchFacadeMock->expects($this->atLeastOnce())
            ->method('transformPageMapToDocumentByMapperName')
            ->willReturn([]);

        $this->assertIsArray($this->priceProductSearchMapper->mapTransferToSearchData($this->priceProductPriceListPageSearchTransferMock));
    }
}

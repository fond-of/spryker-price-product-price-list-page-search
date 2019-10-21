<?php

namespace FondOfSpryker\Zed\PriceProductPriceListPageSearch\Communication\Plugin\Search;

use Codeception\Test\Unit;
use FondOfSpryker\Shared\PriceProductPriceListPageSearch\PriceProductPriceListPageSearchConstants;
use Generated\Shared\Transfer\LocaleTransfer;
use Spryker\Zed\Search\Business\Model\Elasticsearch\DataMapper\PageMapBuilderInterface;

class PriceProductAbstractPriceListPageMapPluginTest extends Unit
{
    /**
     * @var \FondOfSpryker\Zed\PriceProductPriceListPageSearch\Communication\Plugin\Search\PriceProductAbstractPriceListPageMapPlugin
     */
    protected $priceProductAbstractPriceListPageMapPlugin;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Spryker\Zed\Search\Business\Model\Elasticsearch\DataMapper\PageMapBuilderInterface
     */
    protected $pageMapBuilderInterfaceMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Generated\Shared\Transfer\LocaleTransfer
     */
    protected $localTransferMock;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->pageMapBuilderInterfaceMock = $this->getMockBuilder(PageMapBuilderInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->localTransferMock = $this->getMockBuilder(LocaleTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->priceProductAbstractPriceListPageMapPlugin = new PriceProductAbstractPriceListPageMapPlugin();
    }

    /**
     * @return void
     */
    public function testGetName(): void
    {
        $this->assertSame(PriceProductPriceListPageSearchConstants::PRICE_PRODUCT_ABSTRACT_PRICE_LIST_RESOURCE_NAME, $this->priceProductAbstractPriceListPageMapPlugin->getName());
    }
}

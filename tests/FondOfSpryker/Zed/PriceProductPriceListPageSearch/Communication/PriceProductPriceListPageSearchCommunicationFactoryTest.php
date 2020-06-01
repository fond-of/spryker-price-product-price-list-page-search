<?php

namespace FondOfSpryker\Zed\PriceProductPriceListPageSearch\Communication\Plugin;

use Codeception\Test\Unit;
use FondOfSpryker\Zed\PriceProductPriceListPageSearch\Communication\PriceProductPriceListPageSearchCommunicationFactory;
use FondOfSpryker\Zed\PriceProductPriceListPageSearch\Dependency\Facade\PriceProductPriceListPageSearchToEventBehaviorFacadeBridge;
use Spryker\Zed\Kernel\Container;

class PriceProductPriceListPageSearchCommunicationFactoryTest extends Unit
{
    /**
     * @var \FondOfSpryker\Zed\PriceProductPriceListPageSearch\Communication\PriceProductPriceListPageSearchCommunicationFactory
     */
    protected $priceProductPriceListPageSearchCommunicationFactory;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Spryker\Zed\Kernel\Container
     */
    protected $containerMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\FondOfSpryker\Zed\PriceProductPriceListPageSearch\Dependency\Facade\PriceProductPriceListPageSearchToEventBehaviorFacadeInterface
     */
    protected $priceProductPriceListPageSearchToEventBehaviorFacadeInterfaceMock;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->containerMock = $this->getMockBuilder(Container::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->priceProductPriceListPageSearchToEventBehaviorFacadeInterfaceMock = $this->getMockBuilder(PriceProductPriceListPageSearchToEventBehaviorFacadeBridge::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->priceProductPriceListPageSearchCommunicationFactory = new PriceProductPriceListPageSearchCommunicationFactory();
        $this->priceProductPriceListPageSearchCommunicationFactory->setContainer($this->containerMock);
    }

    /**
     * @return void
     */
    public function testGetEventBehaviorFacade(): void
    {
        $this->containerMock->expects($this->atLeastOnce())
            ->method('has')
            ->willReturn(true);

        $this->containerMock->expects($this->atLeastOnce())
            ->method('get')
            ->willReturn($this->priceProductPriceListPageSearchToEventBehaviorFacadeInterfaceMock);

        $this->assertInstanceOf(
            PriceProductPriceListPageSearchToEventBehaviorFacadeBridge::class,
            $this->priceProductPriceListPageSearchCommunicationFactory->getEventBehaviorFacade()
        );
    }
}

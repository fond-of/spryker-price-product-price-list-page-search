<?php

namespace FondOfSpryker\Zed\PriceProductPriceListPageSearch\Communication\Plugin;

use Codeception\Test\Unit;
use FondOfSpryker\Zed\PriceProductPriceListPageSearch\Communication\PriceProductPriceListPageSearchCommunicationFactory;
use FondOfSpryker\Zed\PriceProductPriceListPageSearch\Dependency\Facade\PriceProductPriceListPageSearchToEventBehaviorFacadeInterface;
use FondOfSpryker\Zed\PriceProductPriceListPageSearch\PriceProductPriceListPageSearchDependencyProvider;
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

        $this->priceProductPriceListPageSearchToEventBehaviorFacadeInterfaceMock = $this->getMockBuilder(PriceProductPriceListPageSearchToEventBehaviorFacadeInterface::class)
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
        $this->containerMock->expects(self::atLeastOnce())
            ->method('has')
            ->with(PriceProductPriceListPageSearchDependencyProvider::FACADE_EVENT_BEHAVIOR)
            ->willReturn(true);

        $this->containerMock->expects(self::atLeastOnce())
            ->method('get')
            ->with(PriceProductPriceListPageSearchDependencyProvider::FACADE_EVENT_BEHAVIOR)
            ->willReturn($this->priceProductPriceListPageSearchToEventBehaviorFacadeInterfaceMock);

        self::assertInstanceOf(
            PriceProductPriceListPageSearchToEventBehaviorFacadeInterface::class,
            $this->priceProductPriceListPageSearchCommunicationFactory->getEventBehaviorFacade()
        );
    }

    /**
     * @return void
     */
    public function testGetPriceProductAbstractPriceListPageMapExpanderPlugins(): void
    {
        $this->containerMock->expects(self::atLeastOnce())
            ->method('has')
            ->with(PriceProductPriceListPageSearchDependencyProvider::PLUGINS_PRICE_PRODUCT_ABSTRACT_PRICE_LIST_PAGE_MAP_EXPANDER)
            ->willReturn(true);

        $this->containerMock->expects(self::atLeastOnce())
            ->method('get')
            ->with(PriceProductPriceListPageSearchDependencyProvider::PLUGINS_PRICE_PRODUCT_ABSTRACT_PRICE_LIST_PAGE_MAP_EXPANDER)
            ->willReturn([]);

        self::assertIsArray(
            $this->priceProductPriceListPageSearchCommunicationFactory->getPriceProductAbstractPriceListPageMapExpanderPlugins()
        );
    }

    /**
     * @return void
     */
    public function testGetPriceProductConcretePriceListPageMapExpanderPlugins(): void
    {
        $this->containerMock->expects(self::atLeastOnce())
            ->method('has')
            ->with(PriceProductPriceListPageSearchDependencyProvider::PLUGINS_PRICE_PRODUCT_CONCRETE_PRICE_LIST_PAGE_MAP_EXPANDER)
            ->willReturn(true);

        $this->containerMock->expects(self::atLeastOnce())
            ->method('get')
            ->with(PriceProductPriceListPageSearchDependencyProvider::PLUGINS_PRICE_PRODUCT_CONCRETE_PRICE_LIST_PAGE_MAP_EXPANDER)
            ->willReturn([]);

        self::assertIsArray(
            $this->priceProductPriceListPageSearchCommunicationFactory->getPriceProductConcretePriceListPageMapExpanderPlugins()
        );
    }
}

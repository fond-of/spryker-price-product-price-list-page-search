<?php

namespace FondOfSpryker\Zed\PriceProductPriceListPageSearch\Business;

use Codeception\Test\Unit;
use FondOfSpryker\Zed\PriceProductPriceListPageSearch\Business\Model\PriceProductAbstractSearchWriterInterface;
use FondOfSpryker\Zed\PriceProductPriceListPageSearch\Business\Model\PriceProductConcreteSearchWriterInterface;
use FondOfSpryker\Zed\PriceProductPriceListPageSearch\Dependency\Facade\PriceProductPriceListPageSearchToSearchFacadeInterface;
use FondOfSpryker\Zed\PriceProductPriceListPageSearch\Dependency\Service\PriceProductPriceListPageSearchToUtilEncodingServiceInterface;
use FondOfSpryker\Zed\PriceProductPriceListPageSearch\Persistence\PriceProductPriceListPageSearchEntityManager;
use FondOfSpryker\Zed\PriceProductPriceListPageSearch\Persistence\PriceProductPriceListPageSearchRepository;
use FondOfSpryker\Zed\PriceProductPriceListPageSearch\PriceProductPriceListPageSearchDependencyProvider;
use Spryker\Zed\Kernel\Container;

class PriceProductPriceListPageSearchBusinessFactoryTest extends Unit
{
    /**
     * @var \FondOfSpryker\Zed\PriceProductPriceListPageSearch\Business\PriceProductPriceListPageSearchBusinessFactory
     */
    protected $priceProductPriceListPageSearchBusinessFactory;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\FondOfSpryker\Zed\PriceProductPriceListPageSearch\Persistence\PriceProductPriceListPageSearchRepository
     */
    protected $priceProductPriceListPageSearchRepositoryMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\FondOfSpryker\Zed\PriceProductPriceListPageSearch\Persistence\PriceProductPriceListPageSearchEntityManager
     */
    protected $priceProductPriceListPageSearchEntityManagerMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Spryker\Zed\Kernel\Container
     */
    protected $containerMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\FondOfSpryker\Zed\PriceProductPriceListPageSearch\Dependency\Facade\PriceProductPriceListPageSearchToSearchFacadeInterface
     */
    protected $priceProductPriceListPageSearchToSearchFacadeInterfaceMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\FondOfSpryker\Zed\PriceProductPriceListPageSearch\Dependency\Service\PriceProductPriceListPageSearchToUtilEncodingServiceInterface
     */
    protected $priceProductPriceListPageSearchToUtilEncodingServiceInterfaceMock;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->priceProductPriceListPageSearchRepositoryMock = $this->getMockBuilder(PriceProductPriceListPageSearchRepository::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->priceProductPriceListPageSearchEntityManagerMock = $this->getMockBuilder(PriceProductPriceListPageSearchEntityManager::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->containerMock = $this->getMockBuilder(Container::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->priceProductPriceListPageSearchToSearchFacadeInterfaceMock = $this->getMockBuilder(PriceProductPriceListPageSearchToSearchFacadeInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->priceProductPriceListPageSearchToUtilEncodingServiceInterfaceMock = $this->getMockBuilder(PriceProductPriceListPageSearchToUtilEncodingServiceInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->priceProductPriceListPageSearchBusinessFactory = new PriceProductPriceListPageSearchBusinessFactory();
        $this->priceProductPriceListPageSearchBusinessFactory->setRepository($this->priceProductPriceListPageSearchRepositoryMock);
        $this->priceProductPriceListPageSearchBusinessFactory->setEntityManager($this->priceProductPriceListPageSearchEntityManagerMock);
        $this->priceProductPriceListPageSearchBusinessFactory->setContainer($this->containerMock);
    }

    /**
     * @return void
     */
    public function testCreatePriceProductAbstractSearchWrite(): void
    {
        $this->containerMock->expects($this->atLeastOnce())
            ->method('has')
            ->withConsecutive(
                [PriceProductPriceListPageSearchDependencyProvider::FACADE_SEARCH],
                [PriceProductPriceListPageSearchDependencyProvider::SERVICE_UTIL_ENCODING]
            )->willReturnOnConsecutiveCalls(
                true,
                true
            );

        $this->containerMock->expects($this->atLeastOnce())
            ->method('get')
            ->withConsecutive(
                [PriceProductPriceListPageSearchDependencyProvider::FACADE_SEARCH],
                [PriceProductPriceListPageSearchDependencyProvider::SERVICE_UTIL_ENCODING]
            )->willReturnOnConsecutiveCalls(
                $this->priceProductPriceListPageSearchToSearchFacadeInterfaceMock,
                $this->priceProductPriceListPageSearchToUtilEncodingServiceInterfaceMock
            );

        $this->assertInstanceOf(PriceProductAbstractSearchWriterInterface::class, $this->priceProductPriceListPageSearchBusinessFactory->createPriceProductAbstractSearchWriter());
    }

    /**
     * @return void
     */
    public function testCreatePriceProductConcreteSearchWriter(): void
    {
        $this->containerMock->expects($this->atLeastOnce())
            ->method('has')
            ->withConsecutive(
                [PriceProductPriceListPageSearchDependencyProvider::FACADE_SEARCH],
                [PriceProductPriceListPageSearchDependencyProvider::SERVICE_UTIL_ENCODING]
            )->willReturnOnConsecutiveCalls(
                true,
                true
            );

        $this->containerMock->expects($this->atLeastOnce())
            ->method('get')
            ->withConsecutive(
                [PriceProductPriceListPageSearchDependencyProvider::FACADE_SEARCH],
                [PriceProductPriceListPageSearchDependencyProvider::SERVICE_UTIL_ENCODING]
            )->willReturnOnConsecutiveCalls(
                $this->priceProductPriceListPageSearchToSearchFacadeInterfaceMock,
                $this->priceProductPriceListPageSearchToUtilEncodingServiceInterfaceMock
            );

        $this->assertInstanceOf(PriceProductConcreteSearchWriterInterface::class, $this->priceProductPriceListPageSearchBusinessFactory->createPriceProductConcreteSearchWriter());
    }
}

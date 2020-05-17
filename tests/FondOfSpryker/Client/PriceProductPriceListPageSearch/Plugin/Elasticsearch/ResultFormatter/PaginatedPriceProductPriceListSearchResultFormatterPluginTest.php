<?php

namespace FondOfSpryker\Client\PriceProductPriceListPageSearch\Plugin\Elasticsearch\ResultFormatter;

use Codeception\Test\Unit;
use Elastica\ResultSet;
use FondOfSpryker\Client\PriceProductPriceListPageSearch\Config\PaginationConfigBuilderInterface;
use FondOfSpryker\Client\PriceProductPriceListPageSearch\PriceProductPriceListPageSearchFactory;
use Generated\Shared\Transfer\PaginationSearchResultTransfer;
use ReflectionClass;
use ReflectionMethod;

class PaginatedPriceProductPriceListSearchResultFormatterPluginTest extends Unit
{
    /**
     * @var \FondOfSpryker\Client\PriceProductPriceListPageSearch\Plugin\Elasticsearch\ResultFormatter\PaginatedPriceProductPriceListSearchResultFormatterPlugin
     */
    protected $paginatedPriceProductPriceListSearchResultFormatterPlugin;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Elastica\ResultSet
     */
    protected $resultSetMock;

    /**
     * @var array
     */
    protected $requestParameters;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\FondOfSpryker\Client\PriceProductPriceListPageSearch\PriceProductPriceListPageSearchFactory
     */
    protected $priceProductPriceListPageSearchFactoryMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\FondOfSpryker\Client\PriceProductPriceListPageSearch\Config\PaginationConfigBuilderInterface
     */
    protected $paginationConfigBuilderInterfaceMock;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->resultSetMock = $this->getMockBuilder(ResultSet::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->priceProductPriceListPageSearchFactoryMock = $this->getMockBuilder(PriceProductPriceListPageSearchFactory::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->paginationConfigBuilderInterfaceMock = $this->getMockBuilder(PaginationConfigBuilderInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->requestParameters = [

        ];

        $this->paginatedPriceProductPriceListSearchResultFormatterPlugin = new PaginatedPriceProductPriceListSearchResultFormatterPlugin();
        $this->paginatedPriceProductPriceListSearchResultFormatterPlugin->setFactory($this->priceProductPriceListPageSearchFactoryMock);
    }

    /**
     * @return void
     */
    public function testFormatSearchResult()
    {
        $reflectionMethod = self::getReflectionMethodByName('formatSearchResult');

        $this->priceProductPriceListPageSearchFactoryMock->expects($this->atLeastOnce())
            ->method('createPaginationConfigBuilder')
            ->willReturn($this->paginationConfigBuilderInterfaceMock);

        $this->paginationConfigBuilderInterfaceMock->expects($this->atLeastOnce())
            ->method('getCurrentItemsPerPage')
            ->willReturn(20);

        $this->resultSetMock->expects($this->atLeastOnce())
            ->method('getTotalHits')
            ->willReturn(10);

        $this->assertInstanceOf(PaginationSearchResultTransfer::class, $reflectionMethod->invokeArgs($this->paginatedPriceProductPriceListSearchResultFormatterPlugin, [$this->resultSetMock, $this->requestParameters]));
    }

    /**
     * @return void
     */
    public function testGetName(): void
    {
        $this->assertSame('pagination', $this->paginatedPriceProductPriceListSearchResultFormatterPlugin->getName());
    }

    /**
     * @param string $name
     *
     * @return \ReflectionMethod
     */
    protected function getReflectionMethodByName(string $name): ReflectionMethod
    {
        $reflectionClass = new ReflectionClass(PaginatedPriceProductPriceListSearchResultFormatterPlugin::class);

        $reflectionMethod = $reflectionClass->getMethod($name);
        $reflectionMethod->setAccessible(true);

        return $reflectionMethod;
    }
}

<?php

namespace FondOfSpryker\Client\PriceProductPriceListPageSearch\Plugin\Elasticsearch\ResultFormatter;

use Codeception\Test\Unit;
use Elastica\ResultSet;
use FondOfSpryker\Client\PriceProductPriceListPageSearch\Config\PaginationConfigBuilderInterface;
use FondOfSpryker\Client\PriceProductPriceListPageSearch\PriceProductPriceListPageSearchFactory;
use Generated\Shared\Transfer\PaginationSearchResultTransfer;
use ReflectionClass;

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
        $foo = self::getMethod('formatSearchResult');
        $obj = new PaginatedPriceProductPriceListSearchResultFormatterPlugin();

        $this->priceProductPriceListPageSearchFactoryMock->expects($this->atLeastOnce())
            ->method('createPaginationConfigBuilder')
            ->willReturn($this->paginationConfigBuilderInterfaceMock);

        $obj->setFactory($this->priceProductPriceListPageSearchFactoryMock);

        $this->paginationConfigBuilderInterfaceMock->expects($this->atLeastOnce())
            ->method('getCurrentItemsPerPage')
            ->willReturn(20);

        $this->resultSetMock->expects($this->atLeastOnce())
            ->method('getTotalHits')
            ->willReturn(10);

        $this->assertInstanceOf(PaginationSearchResultTransfer::class, $foo->invokeArgs($obj, [$this->resultSetMock, $this->requestParameters]));
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
     * @throws
     *
     * @return \ReflectionMethod
     */
    protected static function getMethod($name)
    {
        $class = new ReflectionClass(PaginatedPriceProductPriceListSearchResultFormatterPlugin::class);
        $method = $class->getMethod($name);
        $method->setAccessible(true);
        return $method;
    }
}

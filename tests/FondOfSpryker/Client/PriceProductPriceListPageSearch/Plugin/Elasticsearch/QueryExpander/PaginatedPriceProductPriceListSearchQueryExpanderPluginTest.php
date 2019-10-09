<?php

namespace FondOfSpryker\Client\PriceProductPriceListPageSearch\Plugin\Elasticsearch\QueryExpander;

use Codeception\Test\Unit;
use Elastica\Query;
use FondOfSpryker\Client\PriceProductPriceListPageSearch\PriceProductPriceListPageSearchFactory;
use Spryker\Client\Search\Dependency\Plugin\QueryInterface;

class PaginatedPriceProductPriceListSearchQueryExpanderPluginTest extends Unit
{
    /**
     * @var \FondOfSpryker\Client\PriceProductPriceListPageSearch\Plugin\Elasticsearch\QueryExpander\PaginatedPriceProductPriceListSearchQueryExpanderPlugin
     */
    protected $paginatedPriceProductPriceListSearchQueryExpanderPlugin;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Spryker\Client\Search\Dependency\Plugin\QueryInterface
     */
    protected $queryInterfaceMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\FondOfSpryker\Client\PriceProductPriceListPageSearch\PriceProductPriceListPageSearchFactory
     */
    protected $priceProductPriceListPageSearchFactoryMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Elastica\Query
     */
    private $queryMock;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->queryInterfaceMock = $this->getMockBuilder(QueryInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->priceProductPriceListPageSearchFactoryMock = $this->getMockBuilder(PriceProductPriceListPageSearchFactory::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->queryMock = $this->getMockBuilder(Query::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->paginatedPriceProductPriceListSearchQueryExpanderPlugin = new PaginatedPriceProductPriceListSearchQueryExpanderPlugin();
        $this->paginatedPriceProductPriceListSearchQueryExpanderPlugin->setFactory($this->priceProductPriceListPageSearchFactoryMock);
    }

    /**
     * @return void
     */
    public function testExpandQuery(): void
    {
        $this->queryInterfaceMock->expects($this->atLeastOnce())
            ->method('getSearchQuery')
            ->willReturn($this->queryMock);

        $this->queryMock->expects($this->atLeastOnce())
            ->method('setFrom')
            ->willReturn($this->queryInterfaceMock);

        $this->queryMock->expects($this->atLeastOnce())
            ->method('setSize')
            ->willReturn($this->queryMock);

        $this->assertInstanceOf(QueryInterface::class, $this->paginatedPriceProductPriceListSearchQueryExpanderPlugin->expandQuery($this->queryInterfaceMock));
    }
}

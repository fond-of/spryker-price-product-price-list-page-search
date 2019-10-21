<?php

namespace FondOfSpryker\Client\PriceProductPriceListPageSearch\Plugin\Elasticsearch\QueryExpander;

use Codeception\Test\Unit;
use Elastica\Query;
use FondOfSpryker\Client\PriceProductPriceListPageSearch\PriceProductPriceListPageSearchFactory;
use Spryker\Client\Search\Dependency\Plugin\QueryInterface;

class SortedPriceProductPriceListSearchQueryExpanderPluginTest extends Unit
{
    /**
     * @var \FondOfSpryker\Client\PriceProductPriceListPageSearch\Plugin\Elasticsearch\QueryExpander\SortedPriceProductPriceListSearchQueryExpanderPlugin
     */
    protected $sortedPriceProductPriceListSearchQueryExpanderPlugin;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Spryker\Client\Search\Dependency\Plugin\QueryInterface
     */
    protected $queryInterfaceMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Elastica\Query
     */
    protected $queryMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\FondOfSpryker\Client\PriceProductPriceListPageSearch\PriceProductPriceListPageSearchFactory
     */
    protected $priceProductPriceListPageSearchFactoryMock;

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

        $this->queryInterfaceMock = $this->getMockBuilder(QueryInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->queryMock = $this->getMockBuilder(Query::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->priceProductPriceListPageSearchFactoryMock = $this->getMockBuilder(PriceProductPriceListPageSearchFactory::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->requestParameters = [
            "sort",
        ];

        $this->sortedPriceProductPriceListSearchQueryExpanderPlugin = new SortedPriceProductPriceListSearchQueryExpanderPlugin();
        $this->sortedPriceProductPriceListSearchQueryExpanderPlugin->setFactory($this->priceProductPriceListPageSearchFactoryMock);
    }

    /**
     * @return void
     */
    public function testExpandQueryConfigTransferNull(): void
    {
        $this->queryInterfaceMock->expects($this->atLeastOnce())
            ->method('getSearchQuery')
            ->willReturn($this->queryMock);

        $this->assertInstanceOf(QueryInterface::class, $this->sortedPriceProductPriceListSearchQueryExpanderPlugin->expandQuery($this->queryInterfaceMock));
    }
}

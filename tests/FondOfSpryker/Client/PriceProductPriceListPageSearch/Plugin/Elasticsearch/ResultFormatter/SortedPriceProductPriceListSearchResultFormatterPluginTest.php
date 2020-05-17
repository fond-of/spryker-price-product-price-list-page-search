<?php

namespace FondOfSpryker\Client\PriceProductPriceListPageSearch\Plugin\Elasticsearch\ResultFormatter;

use Codeception\Test\Unit;
use Elastica\ResultSet;
use FondOfSpryker\Client\PriceProductPriceListPageSearch\PriceProductPriceListPageSearchFactory;
use Generated\Shared\Transfer\SortSearchResultTransfer;
use ReflectionClass;
use ReflectionMethod;

class SortedPriceProductPriceListSearchResultFormatterPluginTest extends Unit
{
    /**
     * @var \FondOfSpryker\Client\PriceProductPriceListPageSearch\Plugin\Elasticsearch\ResultFormatter\SortedPriceProductPriceListSearchResultFormatterPlugin
     */
    protected $sortedPriceProductPriceListSearchResultFormatterPlugin;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\FondOfSpryker\Client\PriceProductPriceListPageSearch\PriceProductPriceListPageSearchFactory
     */
    protected $priceProductPriceListPageSearchFactoryMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Elastica\ResultSet
     */
    protected $resultSetMock;

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

        $this->priceProductPriceListPageSearchFactoryMock = $this->getMockBuilder(PriceProductPriceListPageSearchFactory::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->resultSetMock = $this->getMockBuilder(ResultSet::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->requestParameters = [

        ];

        $this->sortedPriceProductPriceListSearchResultFormatterPlugin = new SortedPriceProductPriceListSearchResultFormatterPlugin();
        $this->sortedPriceProductPriceListSearchResultFormatterPlugin->setFactory($this->priceProductPriceListPageSearchFactoryMock);
    }

    /**
     * @return void
     */
    public function testGetName(): void
    {
        $this->assertSame('sort', $this->sortedPriceProductPriceListSearchResultFormatterPlugin->getName());
    }

    /**
     * @return void
     */
    public function testFormatSearchResult()
    {
        $reflectionMethod = self::getReflectionMethodByName('formatSearchResult');

        $this->assertInstanceOf(SortSearchResultTransfer::class, $reflectionMethod->invokeArgs($this->sortedPriceProductPriceListSearchResultFormatterPlugin, [$this->resultSetMock, $this->requestParameters]));
    }

    /**
     * @param string $name
     *
     * @return \ReflectionMethod
     */
    protected function getReflectionMethodByName(string $name): ReflectionMethod
    {
        $reflectionClass = new ReflectionClass(SortedPriceProductPriceListSearchResultFormatterPlugin::class);

        $reflectionMethod = $reflectionClass->getMethod($name);
        $reflectionMethod->setAccessible(true);

        return $reflectionMethod;
    }
}

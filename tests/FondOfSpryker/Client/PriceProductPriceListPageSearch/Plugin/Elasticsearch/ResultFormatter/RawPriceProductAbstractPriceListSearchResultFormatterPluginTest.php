<?php

namespace FondOfSpryker\Client\PriceProductPriceListPageSearch\Plugin\Elasticsearch\ResultFormatter;

use Codeception\Test\Unit;
use Elastica\Result;
use Elastica\ResultSet;
use ReflectionClass;
use ReflectionMethod;

class RawPriceProductAbstractPriceListSearchResultFormatterPluginTest extends Unit
{
    /**
     * @var \FondOfSpryker\Client\PriceProductPriceListPageSearch\Plugin\Elasticsearch\ResultFormatter\RawPriceProductAbstractPriceListSearchResultFormatterPlugin
     */
    protected $rawPriceProductAbstractPriceListSearchResultFormatterPlugin;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Elastica\ResultSet
     */
    protected $resultSetMock;

    /**
     * @var array
     */
    protected $requestParameters;

    /**
     * @var array
     */
    protected $results;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Elastica\Result
     */
    protected $resultMock;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->resultSetMock = $this->getMockBuilder(ResultSet::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->requestParameters = [

        ];

        $this->resultMock = $this->getMockBuilder(Result::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->results = [
            $this->resultMock,
        ];

        $this->rawPriceProductAbstractPriceListSearchResultFormatterPlugin = new RawPriceProductAbstractPriceListSearchResultFormatterPlugin();
    }

    /**
     * @return void
     */
    public function testGetName()
    {
        $this->assertSame('price_product_abstract_price_lists', $this->rawPriceProductAbstractPriceListSearchResultFormatterPlugin->getName());
    }

    /**
     * @return void
     */
    public function testFormatSearchResult()
    {
        $reflectionMethod = $this->getReflectionMethodByName('formatSearchResult');

        $this->resultSetMock->expects($this->atLeastOnce())
            ->method('getResults')
            ->willReturn($this->results);

        $this->assertIsArray($reflectionMethod->invokeArgs($this->rawPriceProductAbstractPriceListSearchResultFormatterPlugin, [$this->resultSetMock, $this->requestParameters]));
    }

    /**
     * @param string $name
     *
     * @return \ReflectionMethod
     */
    protected function getReflectionMethodByName(string $name): ReflectionMethod
    {
        $reflectionClass = new ReflectionClass(RawPriceProductAbstractPriceListSearchResultFormatterPlugin::class);

        $reflectionMethod = $reflectionClass->getMethod($name);
        $reflectionMethod->setAccessible(true);

        return $reflectionMethod;
    }
}

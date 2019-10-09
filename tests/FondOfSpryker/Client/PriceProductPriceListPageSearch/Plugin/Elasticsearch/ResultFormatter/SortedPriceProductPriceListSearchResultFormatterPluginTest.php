<?php

namespace FondOfSpryker\Client\PriceProductPriceListPageSearch\Plugin\Elasticsearch\ResultFormatter;

use Codeception\Test\Unit;
use Elastica\ResultSet;
use FondOfSpryker\Client\PriceProductPriceListPageSearch\PriceProductPriceListPageSearchFactory;
use Generated\Shared\Transfer\SortSearchResultTransfer;
use ReflectionClass;

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
        $foo = self::getMethod('formatSearchResult');
        $obj = new SortedPriceProductPriceListSearchResultFormatterPlugin();

        $obj->setFactory($this->priceProductPriceListPageSearchFactoryMock);

        $this->assertInstanceOf(SortSearchResultTransfer::class, $foo->invokeArgs($obj, [$this->resultSetMock, $this->requestParameters]));
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
        $class = new ReflectionClass(SortedPriceProductPriceListSearchResultFormatterPlugin::class);
        $method = $class->getMethod($name);
        $method->setAccessible(true);
        return $method;
    }
}

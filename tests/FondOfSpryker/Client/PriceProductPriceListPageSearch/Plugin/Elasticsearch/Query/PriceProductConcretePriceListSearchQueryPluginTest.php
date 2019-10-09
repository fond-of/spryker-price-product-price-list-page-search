<?php

namespace FondOfSpryker\Client\PriceProductPriceListPageSearch\Plugin\Elasticsearch\Query;

use Codeception\Test\Unit;
use Elastica\Query;

class PriceProductConcretePriceListSearchQueryPluginTest extends Unit
{
    /**
     * @var \FondOfSpryker\Client\PriceProductPriceListPageSearch\Plugin\Elasticsearch\Query\PriceProductConcretePriceListSearchQueryPlugin
     */
    protected $priceProductConcretePriceListSearchQueryPlugin;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->priceProductConcretePriceListSearchQueryPlugin = new PriceProductConcretePriceListSearchQueryPlugin();
    }

    /**
     * @return void
     */
    public function testGetSearchQuery(): void
    {
        $this->assertInstanceOf(Query::class, $this->priceProductConcretePriceListSearchQueryPlugin->getSearchQuery());
    }

    /**
     * @return void
     */
    public function testSearchString(): void
    {
        $this->priceProductConcretePriceListSearchQueryPlugin->setSearchString("");

        $this->assertSame("", $this->priceProductConcretePriceListSearchQueryPlugin->getSearchString());
    }
}

<?php

namespace FondOfSpryker\Client\PriceProductPriceListPageSearch;

use Codeception\Test\Unit;
use Spryker\Client\Kernel\Container;

class PriceProductPriceListPageSearchDependencyProviderTest extends Unit
{
    /**
     * @var \FondOfSpryker\Client\PriceProductPriceListPageSearch\PriceProductPriceListPageSearchDependencyProvider
     */
    protected $priceProductPriceListPageSearchDependencyProvider;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Spryker\Client\Kernel\Container
     */
    protected $containerMock;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->containerMock = $this->getMockBuilder(Container::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->priceProductPriceListPageSearchDependencyProvider = new PriceProductPriceListPageSearchDependencyProvider();
    }

    /**
     * @return void
     */
    public function testProvideServiceLayerDependencies(): void
    {
        $this->assertInstanceOf(Container::class, $this->priceProductPriceListPageSearchDependencyProvider->provideServiceLayerDependencies($this->containerMock));
    }
}

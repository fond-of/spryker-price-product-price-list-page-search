<?php

namespace FondOfSpryker\Zed\PriceProductPriceListPageSearch\Business\Model;

use FondOfSpryker\Zed\PriceProductPriceListPageSearch\Dependency\Facade\PriceProductPriceListPageSearchToStoreFacadeInterface;

class PriceProductAbstractSearchMapper extends AbstractPriceProductSearchMapper
{
    /**
     * @var \FondOfSpryker\Zed\PriceProductPriceListPageSearchExtension\Dependency\Plugin\PriceProductAbstractPriceListPageSearchDataExpanderPluginInterface[]
     */
    protected $priceProductAbstractPriceListPageDataExpanderPlugins;

    /**
     * @param \FondOfSpryker\Zed\PriceProductPriceListPageSearch\Dependency\Facade\PriceProductPriceListPageSearchToStoreFacadeInterface $storeFacade
     * @param \FondOfSpryker\Zed\PriceProductPriceListPageSearchExtension\Dependency\Plugin\PriceProductAbstractPriceListPageSearchDataExpanderPluginInterface[] $priceProductAbstractPriceListPageDataExpanderPlugins
     */
    public function __construct(
        PriceProductPriceListPageSearchToStoreFacadeInterface $storeFacade,
        array $priceProductAbstractPriceListPageDataExpanderPlugins
    ) {
        parent::__construct($storeFacade);

        $this->priceProductAbstractPriceListPageDataExpanderPlugins = $priceProductAbstractPriceListPageDataExpanderPlugins;
    }

    /**
     * @param array $data
     * @param array $searchData
     *
     * @return array
     */
    protected function expandSearchData(array $data, array $searchData): array
    {
        foreach ($this->priceProductAbstractPriceListPageDataExpanderPlugins as $priceProductAbstractPriceListPageDataExpanderPlugin) {
            $searchData = $priceProductAbstractPriceListPageDataExpanderPlugin->expand($data, $searchData);
        }

        return $searchData;
    }
}

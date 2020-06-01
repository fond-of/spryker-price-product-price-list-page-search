<?php

namespace FondOfSpryker\Zed\PriceProductPriceListPageSearch\Business\Model;

use FondOfSpryker\Zed\PriceProductPriceListPageSearch\Dependency\Facade\PriceProductPriceListPageSearchToStoreFacadeInterface;

class PriceProductConcreteSearchMapper extends AbstractPriceProductSearchMapper
{
    /**
     * @var \FondOfSpryker\Zed\PriceProductPriceListPageSearchExtension\Dependency\Plugin\PriceProductConcretePriceListPageSearchDataExpanderPluginInterface[]
     */
    protected $priceProductConcretePriceListPageDataExpanderPlugins;

    /**
     * @param \FondOfSpryker\Zed\PriceProductPriceListPageSearch\Dependency\Facade\PriceProductPriceListPageSearchToStoreFacadeInterface $storeFacade
     * @param \FondOfSpryker\Zed\PriceProductPriceListPageSearchExtension\Dependency\Plugin\PriceProductConcretePriceListPageSearchDataExpanderPluginInterface[] $priceProductConcretePriceListPageDataExpanderPlugins
     */
    public function __construct(
        PriceProductPriceListPageSearchToStoreFacadeInterface $storeFacade,
        array $priceProductConcretePriceListPageDataExpanderPlugins
    ) {
        parent::__construct($storeFacade);

        $this->priceProductConcretePriceListPageDataExpanderPlugins = $priceProductConcretePriceListPageDataExpanderPlugins;
    }

    /**
     * @param array $data
     * @param array $searchData
     *
     * @return array
     */
    protected function expandSearchData(array $data, array $searchData): array
    {
        foreach ($this->priceProductConcretePriceListPageDataExpanderPlugins as $priceProductConcretePriceListPageDataExpanderPlugin) {
            $searchData = $priceProductConcretePriceListPageDataExpanderPlugin->expand($data, $searchData);
        }

        return $searchData;
    }
}

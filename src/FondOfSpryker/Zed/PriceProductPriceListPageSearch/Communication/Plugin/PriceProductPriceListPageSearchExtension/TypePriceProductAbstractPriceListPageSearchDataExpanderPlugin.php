<?php

namespace FondOfSpryker\Zed\PriceProductPriceListPageSearch\Communication\Plugin\PriceProductPriceListPageSearchExtension;

use FondOfSpryker\Zed\PriceProductPriceListPageSearchExtension\Dependency\Plugin\PriceProductAbstractPriceListPageSearchDataExpanderPluginInterface;
use Generated\Shared\Search\PriceProductPriceListIndexMap;
use Spryker\Zed\Kernel\Communication\AbstractPlugin;

/**
 * @method \FondOfSpryker\Zed\PriceProductPriceListPageSearch\PriceProductPriceListPageSearchConfig getConfig()
 * @method \FondOfSpryker\Zed\PriceProductPriceListPageSearch\Persistence\PriceProductPriceListPageSearchQueryContainerInterface getQueryContainer()
 * @method \FondOfSpryker\Zed\PriceProductPriceListPageSearch\Business\PriceProductPriceListPageSearchFacadeInterface getFacade()
 * @method \FondOfSpryker\Zed\PriceProductPriceListPageSearch\Communication\PriceProductPriceListPageSearchCommunicationFactory getFactory()
 */
class TypePriceProductAbstractPriceListPageSearchDataExpanderPlugin extends AbstractPlugin implements PriceProductAbstractPriceListPageSearchDataExpanderPluginInterface
{
    /**
     * Specification:
     * - Expands the mapped search data.
     *
     * @api
     *
     * @param array $data
     * @param array $searchData
     *
     * @return array
     */
    public function expand(array $data, array $searchData): array
    {
        $searchData[PriceProductPriceListIndexMap::TYPE] = 'abstract';

        return $searchData;
    }
}

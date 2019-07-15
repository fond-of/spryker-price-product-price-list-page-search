<?php

namespace FondOfSpryker\Zed\PriceProductPriceListPageSearch\Communication\Plugin\Event;

use FondOfSpryker\Shared\PriceProductPriceListPageSearch\PriceProductPriceListPageSearchConstants;
use FondOfSpryker\Zed\PriceProductPriceList\Dependency\PriceProductPriceListEvents;
use Orm\Zed\PriceList\Persistence\Map\FosPriceListTableMap;
use Propel\Runtime\ActiveQuery\ModelCriteria;
use Spryker\Zed\EventBehavior\Dependency\Plugin\EventResourceQueryContainerPluginInterface;
use Spryker\Zed\Kernel\Communication\AbstractPlugin;

/**
 * @method \FondOfSpryker\Zed\PriceProductPriceListPageSearch\PriceProductPriceListPageSearchConfig getConfig()
 * @method \FondOfSpryker\Zed\PriceProductPriceListPageSearch\Business\PriceProductPriceListPageSearchFacadeInterface getFacade()
 * @method \FondOfSpryker\Zed\PriceProductPriceListPageSearch\Communication\PriceProductPriceListPageSearchCommunicationFactory getFactory()
 * @method \FondOfSpryker\Zed\PriceProductPriceListPageSearch\Persistence\PriceProductPriceListPageSearchQueryContainerInterface getQueryContainer()
 */
class PriceProductAbstractPriceListPageSearchEventResourceQueryContainerPlugin extends AbstractPlugin implements EventResourceQueryContainerPluginInterface
{
    /**
     * {@inheritdoc}
     *
     * @api
     *
     * @return string
     */
    public function getResourceName(): string
    {
        return PriceProductPriceListPageSearchConstants::PRICE_PRODUCT_ABSTRACT_PRICE_LIST_RESOURCE_NAME;
    }

    /**
     * {@inheritdoc}
     *
     * @api
     *
     * @return string
     */
    public function getEventName(): string
    {
        return PriceProductPriceListEvents::PRICE_ABSTRACT_PUBLISH;
    }

    /**
     * {@inheritdoc}
     *
     * @api
     *
     * @return string|null
     */
    public function getIdColumnName(): ?string
    {
        return FosPriceListTableMap::COL_ID_PRICE_LIST;
    }

    /**
     * {@inheritdoc}
     *
     * @api
     *
     * @param int[] $ids
     *
     * @return \Propel\Runtime\ActiveQuery\ModelCriteria|null
     */
    public function queryData(array $ids = []): ?ModelCriteria
    {
        return $this->getQueryContainer()->queryPriceProductAbstractPriceList($ids);
    }
}

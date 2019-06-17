<?php

namespace FondOfSpryker\Zed\PriceProductPriceListPageSearch\Communication\Plugin\Event\Listener;

use Spryker\Zed\Event\Dependency\Plugin\EventBulkHandlerInterface;
use Spryker\Zed\Kernel\Communication\AbstractPlugin;

/**
 * @method \FondOfSpryker\Zed\PriceProductPriceListPageSearch\PriceProductPriceListPageSearchConfig getConfig()
 * @method \FondOfSpryker\Zed\PriceProductPriceListPageSearch\Business\PriceProductPriceListPageSearchFacadeInterface getFacade()
 * @method \FondOfSpryker\Zed\PriceProductPriceListPageSearch\Communication\PriceProductPriceListPageSearchCommunicationFactory getFactory()
 */
class PriceProductPriceListConcreteDeleteListener extends AbstractPlugin implements EventBulkHandlerInterface
{
    protected const COL_FK_PRODUCT = 'fos_price_product_price_list.fk_product';

    /**
     * {@inheritdoc}
     *
     * @api
     *
     * @param \Spryker\Shared\Kernel\Transfer\TransferInterface[] $transfers
     * @param string $eventName
     *
     * @return void
     */
    public function handleBulk(array $transfers, $eventName): void
    {
        $productIds = $this->getFactory()
            ->getEventBehaviorFacade()
            ->getEventTransferForeignKeys(
                $transfers,
                static::COL_FK_PRODUCT
            );

        if (empty($productIds)) {
            return;
        }

        $this->getFacade()
            ->publishConcretePriceProductByProductIds($productIds);
    }
}

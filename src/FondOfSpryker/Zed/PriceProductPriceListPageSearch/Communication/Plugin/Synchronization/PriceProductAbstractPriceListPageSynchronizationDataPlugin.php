<?php

namespace FondOfSpryker\Zed\PriceProductPriceListPageSearch\Communication\Plugin\Synchronization;

use FondOfSpryker\Shared\PriceProductPriceListPageSearch\PriceProductPriceListPageSearchConstants;
use Generated\Shared\Transfer\FilterTransfer;
use Generated\Shared\Transfer\SynchronizationDataTransfer;
use Spryker\Zed\Kernel\Communication\AbstractPlugin;
use Spryker\Zed\SynchronizationExtension\Dependency\Plugin\SynchronizationDataBulkRepositoryPluginInterface;

/**
 * @method \FondOfSpryker\Zed\PriceProductPriceListPageSearch\PriceProductPriceListPageSearchConfig getConfig()
 * @method \FondOfSpryker\Zed\PriceProductPriceListPageSearch\Business\PriceProductPriceListPageSearchFacadeInterface getFacade()
 * @method \FondOfSpryker\Zed\PriceProductPriceListPageSearch\Communication\PriceProductPriceListPageSearchCommunicationFactory getFactory()
 * @method \FondOfSpryker\Zed\PriceProductPriceListPageSearch\Persistence\PriceProductPriceListPageSearchRepositoryInterface getRepository()
 */
class PriceProductAbstractPriceListPageSynchronizationDataPlugin extends AbstractPlugin implements SynchronizationDataBulkRepositoryPluginInterface
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
     * @return bool
     */
    public function hasStore(): bool
    {
        return false;
    }

    /**
     * {@inheritdoc}
     *
     * @api
     *
     * @return array
     */
    public function getParams(): array
    {
        return ['type' => 'page'];
    }

    /**
     * {@inheritdoc}
     *
     * @api
     *
     * @return string
     */
    public function getQueueName(): string
    {
        return PriceProductPriceListPageSearchConstants::PRICE_PRODUCT_PRICE_LIST_SYNC_SEARCH_QUEUE;
    }

    /**
     * {@inheritdoc}
     *
     * @api
     *
     * @return string|null
     */
    public function getSynchronizationQueuePoolName(): ?string
    {
        return $this->getConfig()->getPriceProductAbstractPriceListSynchronizationPoolName();
    }

    /**
     * {@inheritdoc}
     *
     * @api
     *
     * @param int $offset
     * @param int $limit
     * @param int[] $ids
     *
     * @return \Generated\Shared\Transfer\SynchronizationDataTransfer[]
     */
    public function getData(int $offset, int $limit, array $ids = []): array
    {
        $data = [];
        $filterTransfer = $this->createFilterTransfer($offset, $limit);

        $priceProductConcretePriceListPageSearchEntityTransfers = $this->getRepository()
            ->findFilteredPriceProductAbstractPriceListPageSearchEntities($filterTransfer, $ids);

        foreach ($priceProductConcretePriceListPageSearchEntityTransfers as $priceProductConcretePriceListPageSearchEntityTransfer) {
            $synchronizationDataTransfer = new SynchronizationDataTransfer();
            $synchronizationDataTransfer->setData($priceProductConcretePriceListPageSearchEntityTransfer->getData());
            $synchronizationDataTransfer->setKey($priceProductConcretePriceListPageSearchEntityTransfer->getKey());

            $data[] = $synchronizationDataTransfer;
        }

        return $data;
    }

    /**
     * {@inheritdoc}
     *
     * @param int $offset
     * @param int $limit
     *
     * @return \Generated\Shared\Transfer\FilterTransfer
     */
    protected function createFilterTransfer(int $offset, int $limit): FilterTransfer
    {
        return (new FilterTransfer())
            ->setOffset($offset)
            ->setLimit($limit);
    }
}

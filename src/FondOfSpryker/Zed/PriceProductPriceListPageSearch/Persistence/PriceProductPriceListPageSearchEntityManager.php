<?php

namespace FondOfSpryker\Zed\PriceProductPriceListPageSearch\Persistence;

use Generated\Shared\Transfer\PriceProductPriceListPageSearchTransfer;
use Orm\Zed\PriceProductPriceListPageSearch\Persistence\FosPriceProductAbstractPriceListPageSearch;
use Orm\Zed\PriceProductPriceListPageSearch\Persistence\FosPriceProductConcretePriceListPageSearch;
use Spryker\Zed\Kernel\Persistence\AbstractEntityManager;

/**
 * @method \FondOfSpryker\Zed\PriceProductPriceListPageSearch\Persistence\PriceProductPriceListPageSearchPersistenceFactory getFactory()
 */
class PriceProductPriceListPageSearchEntityManager extends AbstractEntityManager implements PriceProductPriceListPageSearchEntityManagerInterface
{
    /**
     * @param \Generated\Shared\Transfer\PriceProductPriceListPageSearchTransfer $priceProductPriceListPageSearchTransfer
     * @param \Orm\Zed\PriceProductPriceListPageSearch\Persistence\FosPriceProductAbstractPriceListPageSearch $priceProductAbstractPriceListPageSearchEntity
     *
     * @return void
     */
    public function updatePriceProductAbstract(
        PriceProductPriceListPageSearchTransfer $priceProductPriceListPageSearchTransfer,
        FosPriceProductAbstractPriceListPageSearch $priceProductAbstractPriceListPageSearchEntity
    ): void {
        $priceProductAbstractPriceListPageSearchEntity
            ->setData($priceProductPriceListPageSearchTransfer->getData())
            ->setStructuredData($priceProductPriceListPageSearchTransfer->getStructuredData())
            ->setIsSendingToQueue($this->getFactory()->getConfig()->isSendingToQueue())
            ->save();
    }

    /**
     * @param \Generated\Shared\Transfer\PriceProductPriceListPageSearchTransfer $priceProductPriceListPageSearchTransfer
     *
     * @return void
     */
    public function createPriceProductAbstract(
        PriceProductPriceListPageSearchTransfer $priceProductPriceListPageSearchTransfer
    ): void {
        (new FosPriceProductAbstractPriceListPageSearch())
            ->setFkProductAbstract($priceProductPriceListPageSearchTransfer->getIdProduct())
            ->setFkPriceList($priceProductPriceListPageSearchTransfer->getIdPriceList())
            ->setPriceKey($priceProductPriceListPageSearchTransfer->getPriceKey())
            ->setData($priceProductPriceListPageSearchTransfer->getData())
            ->setStructuredData($priceProductPriceListPageSearchTransfer->getStructuredData())
            ->setIsSendingToQueue($this->getFactory()->getConfig()->isSendingToQueue())
            ->save();
    }

    /**
     * @param \Orm\Zed\PriceProductPriceListPageSearch\Persistence\FosPriceProductAbstractPriceListPageSearch[] $priceProductAbstractPriceListPageSearchEntities
     *
     * @return void
     */
    public function deletePriceProductAbstractEntities(array $priceProductAbstractPriceListPageSearchEntities): void
    {
        foreach ($priceProductAbstractPriceListPageSearchEntities as $priceProductAbstractPriceListPageSearchEntity) {
            $priceProductAbstractPriceListPageSearchEntity->delete();
        }
    }

    /**
     * @param \Generated\Shared\Transfer\PriceProductPriceListPageSearchTransfer $priceProductPriceListPageSearchTransfer
     * @param \Orm\Zed\PriceProductPriceListPageSearch\Persistence\FosPriceProductConcretePriceListPageSearch $priceProductConcretePriceListPageSearchEntity
     *
     * @return void
     */
    public function updatePriceProductConcrete(
        PriceProductPriceListPageSearchTransfer $priceProductPriceListPageSearchTransfer,
        FosPriceProductConcretePriceListPageSearch $priceProductConcretePriceListPageSearchEntity
    ): void {
        $priceProductConcretePriceListPageSearchEntity
            ->setData($priceProductPriceListPageSearchTransfer->getData())
            ->setStructuredData($priceProductPriceListPageSearchTransfer->getStructuredData())
            ->setIsSendingToQueue($this->getFactory()->getConfig()->isSendingToQueue())
            ->save();
    }

    /**
     * @param \Generated\Shared\Transfer\PriceProductPriceListPageSearchTransfer $priceProductPriceListPageSearchTransfer
     *
     * @return void
     */
    public function createPriceProductConcrete(
        PriceProductPriceListPageSearchTransfer $priceProductPriceListPageSearchTransfer
    ): void {
        (new FosPriceProductConcretePriceListPageSearch())
            ->setFkProduct($priceProductPriceListPageSearchTransfer->getIdProduct())
            ->setFkPriceList($priceProductPriceListPageSearchTransfer->getIdPriceList())
            ->setPriceKey($priceProductPriceListPageSearchTransfer->getPriceKey())
            ->setData($priceProductPriceListPageSearchTransfer->getData())
            ->setStructuredData($priceProductPriceListPageSearchTransfer->getStructuredData())
            ->setIsSendingToQueue($this->getFactory()->getConfig()->isSendingToQueue())
            ->save();
    }

    /**
     * @param \Orm\Zed\PriceProductPriceListPageSearch\Persistence\FosPriceProductConcretePriceListPageSearch[] $priceProductConcretePriceListPageSearchEntities
     *
     * @return void
     */
    public function deletePriceProductConcreteEntities(array $priceProductConcretePriceListPageSearchEntities): void
    {
        foreach ($priceProductConcretePriceListPageSearchEntities as $priceProductConcretePriceListPageSearchEntity) {
            $priceProductConcretePriceListPageSearchEntity->delete();
        }
    }
}

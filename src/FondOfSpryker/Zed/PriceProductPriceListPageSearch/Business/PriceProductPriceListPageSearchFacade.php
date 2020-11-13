<?php

namespace FondOfSpryker\Zed\PriceProductPriceListPageSearch\Business;

use Spryker\Zed\Kernel\Business\AbstractFacade;

/**
 * @method \FondOfSpryker\Zed\PriceProductPriceListPageSearch\Business\PriceProductPriceListPageSearchBusinessFactory getFactory()
 * @method \FondOfSpryker\Zed\PriceProductPriceListPageSearch\Persistence\PriceProductPriceListPageSearchEntityManagerInterface getEntityManager()
 * @method \FondOfSpryker\Zed\PriceProductPriceListPageSearch\Persistence\PriceProductPriceListPageSearchRepositoryInterface getRepository()
 */
class PriceProductPriceListPageSearchFacade extends AbstractFacade implements PriceProductPriceListPageSearchFacadeInterface
{
    /**
     * {@inheritDoc}
     *
     * @api
     *
     * @param int[] $priceProductPriceListIds
     *
     * @return void
     */
    public function publishAbstractPriceProductPriceList(array $priceProductPriceListIds): void
    {
        $this->getFactory()->createPriceProductAbstractSearchWriter()
            ->publishAbstractPriceProductPriceList($priceProductPriceListIds);
    }

    /**
     * {@inheritDoc}
     *
     * @api
     *
     * @param int[] $productAbstractIds
     *
     * @return void
     */
    public function publishAbstractPriceProductByByProductAbstractIds(array $productAbstractIds): void
    {
        $this->getFactory()->createPriceProductAbstractSearchWriter()
            ->publishAbstractPriceProductByByProductAbstractIds($productAbstractIds);
    }

    /**
     * {@inheritDoc}
     *
     * @api
     *
     * @param int[] $productIds
     *
     * @return void
     */
    public function publishConcretePriceProductByProductIds(array $productIds): void
    {
        $this->getFactory()->createPriceProductConcreteSearchWriter()
            ->publishConcretePriceProductByProductIds($productIds);
    }

    /**
     * {@inheritDoc}
     *
     * @api
     *
     * @param int[] $priceProductPriceListIds
     *
     * @return void
     */
    public function publishConcretePriceProductPriceList(array $priceProductPriceListIds): void
    {
        $this->getFactory()->createPriceProductConcreteSearchWriter()
            ->publishConcretePriceProductPriceList($priceProductPriceListIds);
    }

    /**
     * {@inheritDoc}
     *
     * @api
     *
     * @param int $idPriceList
     *
     * @return void
     */
    public function publishAbstractPriceProductPriceListByIdPriceList(int $idPriceList): void
    {
        $this->getFactory()->createPriceProductAbstractSearchWriter()
            ->publishAbstractPriceProductPriceListByIdPriceList($idPriceList);
    }

    /**
     * {@inheritDoc}
     *
     * @api
     *
     * @param int $idPriceList
     *
     * @return void
     */
    public function publishConcretePriceProductPriceListByIdPriceList(int $idPriceList): void
    {
        $this->getFactory()->createPriceProductConcreteSearchWriter()
            ->publishConcretePriceProductPriceListByIdPriceList($idPriceList);
    }
}

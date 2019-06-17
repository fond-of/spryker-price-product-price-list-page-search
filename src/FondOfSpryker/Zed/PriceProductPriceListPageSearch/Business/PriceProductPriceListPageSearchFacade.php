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
     * {@inheritdoc}
     *
     * @param int[] $priceProductPriceListIds
     *
     * @return void
     *
     * @api
     *
     */
    public function publishAbstractPriceProductPriceList(array $priceProductPriceListIds): void
    {
        $this->getFactory()->createPriceProductAbstractSearchWriter()
            ->publishAbstractPriceProductPriceList($priceProductPriceListIds);
    }

    /**
     * {@inheritdoc}
     *
     * @param int[] $productAbstractIds
     *
     * @return void
     *
     * @api
     */
    public function publishAbstractPriceProductByByProductAbstractIds(array $productAbstractIds): void
    {
        $this->getFactory()->createPriceProductAbstractSearchWriter()
            ->publishAbstractPriceProductByByProductAbstractIds($productAbstractIds);
    }

    /**
     * Specification:
     *  - Publish merchant relationship prices for product concretes.
     *  - Uses the given concrete product IDs.
     *  - Refreshes the prices data for product concretes for all business units and merchant relationships.
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
     * Specification:
     *  - Publish price list prices for products.
     *  - Uses the given IDs of the `fos_price_product_price_list` table.
     *  - Merges created or updated prices to the existing ones.
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
}

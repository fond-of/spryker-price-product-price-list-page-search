<?php

namespace FondOfSpryker\Zed\PriceProductPriceListPageSearch\Business\Model;

use Generated\Shared\Transfer\PriceProductPriceListPageSearchTransfer;

class PriceProductAbstractSearchWriter extends AbstractPriceProductSearchWriter implements PriceProductAbstractSearchWriterInterface
{
    /**
     * @param int[] $priceProductPriceListIds
     *
     * @return void
     */
    public function publishAbstractPriceProductPriceList(array $priceProductPriceListIds): void
    {
        $priceProductPriceListPageSearchTransfers = $this->repository
            ->findPriceProductPriceListByIds($priceProductPriceListIds);

        if (empty($priceProductPriceListPageSearchTransfers)) {
            return;
        }

        $priceKeys = array_map(
            function (PriceProductPriceListPageSearchTransfer $priceProductPriceListPageSearchTransfer) {
                return $priceProductPriceListPageSearchTransfer->getPriceKey();
            },
            $priceProductPriceListPageSearchTransfers
        );

        $existingPageSearchEntities = $this->repository
            ->findExistingPriceProductAbstractPriceListEntitiesByPriceKeys($priceKeys);

        $this->write($priceProductPriceListPageSearchTransfers, $existingPageSearchEntities, true);
    }

    /**
     * @param int[] $productAbstractIds
     *
     * @return void
     */
    public function publishAbstractPriceProductByByProductAbstractIds(array $productAbstractIds): void
    {
        $priceProductPriceListPageSearchTransfers = $this->repository
            ->findPriceListProductAbstractPricesDataByProductAbstractIds($productAbstractIds);

        $existingPageSearchEntities = $this->repository
            ->findExistingPriceProductAbstractPriceListEntitiesByProductAbstractIds($productAbstractIds);

        $this->write($priceProductPriceListPageSearchTransfers, $existingPageSearchEntities);
    }

    /**
     * @param \Generated\Shared\Transfer\PriceProductPriceListPageSearchTransfer[] $priceProductPriceListPageSearchTransfers
     * @param \Orm\Zed\PriceProductPriceListPageSearch\Persistence\FosPriceProductAbstractPriceListPageSearch[] $existingPageSearchEntities
     * @param bool $mergePrices
     *
     * @return void
     */
    protected function write(
        array $priceProductPriceListPageSearchTransfers,
        array $existingPageSearchEntities = [],
        bool $mergePrices = false
    ): void {
        $existingPageSearchEntities = $this->mapPageSearchEntitiesByPriceKey($existingPageSearchEntities);

        foreach ($priceProductPriceListPageSearchTransfers as $priceProductPriceListPageSearchTransfer) {
            $priceProductPriceListPageSearchTransfer = $this->groupPrices(
                $priceProductPriceListPageSearchTransfer,
                $existingPageSearchEntities,
                $mergePrices
            );

            // Skip if no prices, the price entity will be deleted at the end
            if (empty($priceProductPriceListPageSearchTransfer->getPrices())) {
                continue;
            }

            $this->addDataAttributes($priceProductPriceListPageSearchTransfer);

            if (isset($existingPageSearchEntities[$priceProductPriceListPageSearchTransfer->getPriceKey()])) {
                $this->entityManager->updatePriceProductAbstract(
                    $priceProductPriceListPageSearchTransfer,
                    $existingPageSearchEntities[$priceProductPriceListPageSearchTransfer->getPriceKey()]
                );
                unset($existingPageSearchEntities[$priceProductPriceListPageSearchTransfer->getPriceKey()]);
                continue;
            }

            $this->entityManager->createPriceProductAbstract(
                $priceProductPriceListPageSearchTransfer
            );

            unset($existingPageSearchEntities[$priceProductPriceListPageSearchTransfer->getPriceKey()]);
        }

        // Delete the rest of the entities
        $this->entityManager->deletePriceProductAbstractEntities($existingPageSearchEntities);
    }
}

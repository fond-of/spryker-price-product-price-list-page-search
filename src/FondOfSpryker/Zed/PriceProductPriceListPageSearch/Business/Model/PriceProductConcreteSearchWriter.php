<?php

namespace FondOfSpryker\Zed\PriceProductPriceListPageSearch\Business\Model;

use FondOfSpryker\Zed\PriceProductPriceListPageSearch\Dependency\Service\PriceProductPriceListPageSearchToUtilEncodingServiceInterface;
use FondOfSpryker\Zed\PriceProductPriceListPageSearch\Persistence\PriceProductPriceListPageSearchEntityManagerInterface;
use FondOfSpryker\Zed\PriceProductPriceListPageSearch\Persistence\PriceProductPriceListPageSearchRepositoryInterface;
use Generated\Shared\Transfer\PriceProductPriceListPageSearchTransfer;

class PriceProductConcreteSearchWriter extends AbstractPriceProductSearchWriter implements PriceProductConcreteSearchWriterInterface
{
    /**
     * @var \FondOfSpryker\Zed\PriceProductPriceListPageSearch\Business\Model\PriceProductConcreteSearchExpanderInterface
     */
    protected $priceProductConcreteSearchExpander;

    /**
     * @param \FondOfSpryker\Zed\PriceProductPriceListPageSearch\Business\Model\PriceGrouperInterface $priceGrouper
     * @param \FondOfSpryker\Zed\PriceProductPriceListPageSearch\Business\Model\PriceProductSearchMapperInterface $priceProductSearchMapper
     * @param \FondOfSpryker\Zed\PriceProductPriceListPageSearch\Dependency\Service\PriceProductPriceListPageSearchToUtilEncodingServiceInterface $utilEncodingService
     * @param \FondOfSpryker\Zed\PriceProductPriceListPageSearch\Persistence\PriceProductPriceListPageSearchRepositoryInterface $repository
     * @param \FondOfSpryker\Zed\PriceProductPriceListPageSearch\Persistence\PriceProductPriceListPageSearchEntityManagerInterface $entityManager
     * @param \FondOfSpryker\Zed\PriceProductPriceListPageSearch\Business\Model\PriceProductConcreteSearchExpanderInterface $priceProductConcreteSearchExpander
     */
    public function __construct(
        PriceGrouperInterface $priceGrouper,
        PriceProductSearchMapperInterface $priceProductSearchMapper,
        PriceProductPriceListPageSearchToUtilEncodingServiceInterface $utilEncodingService,
        PriceProductPriceListPageSearchRepositoryInterface $repository,
        PriceProductPriceListPageSearchEntityManagerInterface $entityManager,
        PriceProductConcreteSearchExpanderInterface $priceProductConcreteSearchExpander
    ) {
        parent::__construct(
            $priceGrouper,
            $priceProductSearchMapper,
            $utilEncodingService,
            $repository,
            $entityManager
        );

        $this->priceProductConcreteSearchExpander = $priceProductConcreteSearchExpander;
    }

    /**
     * @param int[] $priceProductPriceListIds
     *
     * @return void
     */
    public function publishConcretePriceProductPriceList(array $priceProductPriceListIds): void
    {
        $priceProductPriceListPageSearchTransfers = $this->repository
            ->findPriceListProductConcretePricesDataByIds($priceProductPriceListIds);

        if (empty($priceProductPriceListPageSearchTransfers)) {
            return;
        }

        $priceKeys = array_map(
            static function (PriceProductPriceListPageSearchTransfer $priceProductPriceListPageSearchTransfer) {
                return $priceProductPriceListPageSearchTransfer->getPriceKey();
            },
            $priceProductPriceListPageSearchTransfers
        );

        $existingPageSearchEntities = $this->repository
            ->findExistingPriceProductConcretePriceListEntitiesByPriceKeys($priceKeys);

        $this->write($priceProductPriceListPageSearchTransfers, $existingPageSearchEntities, true);
    }

    /**
     * @param int[] $productIds
     *
     * @return void
     */
    public function publishConcretePriceProductByProductIds(array $productIds): void
    {
        $priceProductPriceListPageSearchTransfers = $this->repository
            ->findPriceListProductConcretePricesDataByProductIds($productIds);

        $existingPageSearchEntities = $this->repository
            ->findExistingPriceProductConcretePriceListEntitiesByProductIds($productIds);

        $this->write($priceProductPriceListPageSearchTransfers, $existingPageSearchEntities);
    }

    /**
     * @param \Generated\Shared\Transfer\PriceProductPriceListPageSearchTransfer[] $priceProductPriceListPageSearchTransfers
     * @param \Orm\Zed\PriceProductPriceListPageSearch\Persistence\FosPriceProductConcretePriceListPageSearch[] $existingPageSearchEntities
     * @param bool $mergePrices
     *
     * @return void
     */
    protected function write(
        array $priceProductPriceListPageSearchTransfers,
        array $existingPageSearchEntities,
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
                $this->entityManager->updatePriceProductConcrete(
                    $priceProductPriceListPageSearchTransfer,
                    $existingPageSearchEntities[$priceProductPriceListPageSearchTransfer->getPriceKey()]
                );

                unset($existingPageSearchEntities[$priceProductPriceListPageSearchTransfer->getPriceKey()]);

                continue;
            }

            $this->entityManager->createPriceProductConcrete(
                $priceProductPriceListPageSearchTransfer
            );

            unset($existingPageSearchEntities[$priceProductPriceListPageSearchTransfer->getPriceKey()]);
        }

        // Delete the rest of the entities
        $this->entityManager->deletePriceProductConcreteEntities($existingPageSearchEntities);
    }
}

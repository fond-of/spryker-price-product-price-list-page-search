<?php

namespace FondOfSpryker\Zed\PriceProductPriceListPageSearch\Business\Model;

use FondOfSpryker\Shared\PriceProductPriceListPageSearch\PriceProductPriceListPageSearchConstants;
use FondOfSpryker\Zed\PriceProductPriceListPageSearch\Dependency\Service\PriceProductPriceListPageSearchToUtilEncodingServiceInterface;
use FondOfSpryker\Zed\PriceProductPriceListPageSearch\Persistence\PriceProductPriceListPageSearchEntityManagerInterface;
use FondOfSpryker\Zed\PriceProductPriceListPageSearch\Persistence\PriceProductPriceListPageSearchRepositoryInterface;
use Generated\Shared\Transfer\PriceProductPriceListPageSearchTransfer;

class PriceProductConcreteSearchWriter implements PriceProductConcreteSearchWriterInterface
{
    /**
     * @var \FondOfSpryker\Zed\PriceProductPriceListPageSearch\Business\Model\PriceGrouperInterface
     */
    protected $priceGrouper;

    /**
     * @var \FondOfSpryker\Zed\PriceProductPriceListPageSearch\Persistence\PriceProductPriceListPageSearchRepositoryInterface
     */
    protected $repository;

    /**
     * @var \FondOfSpryker\Zed\PriceProductPriceListPageSearch\Persistence\PriceProductPriceListPageSearchEntityManagerInterface
     */
    protected $entityManager;

    /**
     * @var \FondOfSpryker\Zed\PriceProductPriceListPageSearch\Business\Model\PriceProductSearchMapperInterface
     */
    protected $priceProductSearchMapper;

    /**
     * @var \FondOfSpryker\Zed\PriceProductPriceListPageSearch\Dependency\Service\PriceProductPriceListPageSearchToUtilEncodingServiceInterface
     */
    protected $utilEncodingService;

    /**
     * @param \FondOfSpryker\Zed\PriceProductPriceListPageSearch\Business\Model\PriceGrouperInterface $priceGrouper
     * @param \FondOfSpryker\Zed\PriceProductPriceListPageSearch\Business\Model\PriceProductSearchMapperInterface $priceProductSearchMapper
     * @param \FondOfSpryker\Zed\PriceProductPriceListPageSearch\Dependency\Service\PriceProductPriceListPageSearchToUtilEncodingServiceInterface $utilEncodingService
     * @param \FondOfSpryker\Zed\PriceProductPriceListPageSearch\Persistence\PriceProductPriceListPageSearchRepositoryInterface $repository
     * @param \FondOfSpryker\Zed\PriceProductPriceListPageSearch\Persistence\PriceProductPriceListPageSearchEntityManagerInterface $entityManager
     */
    public function __construct(
        PriceGrouperInterface $priceGrouper,
        PriceProductSearchMapperInterface $priceProductSearchMapper,
        PriceProductPriceListPageSearchToUtilEncodingServiceInterface $utilEncodingService,
        PriceProductPriceListPageSearchRepositoryInterface $repository,
        PriceProductPriceListPageSearchEntityManagerInterface $entityManager
    ) {
        $this->priceGrouper = $priceGrouper;
        $this->priceProductSearchMapper = $priceProductSearchMapper;
        $this->utilEncodingService = $utilEncodingService;
        $this->repository = $repository;
        $this->entityManager = $entityManager;
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
            function (PriceProductPriceListPageSearchTransfer $priceProductPriceListPageSearchTransfer) {
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

    /**
     * @param \Orm\Zed\PriceProductPriceListPageSearch\Persistence\FosPriceProductAbstractPriceListPageSearch[] $priceProductAbstractPriceListPageSearchEntities
     *
     * @return array
     */
    protected function mapPageSearchEntitiesByPriceKey(array $priceProductAbstractPriceListPageSearchEntities): array
    {
        $mappedPriceProductAbstractPriceListPageSearchEntities = [];

        foreach ($priceProductAbstractPriceListPageSearchEntities as $priceProductAbstractPriceListPageSearchEntity) {
            $mappedPriceProductAbstractPriceListPageSearchEntities[$priceProductAbstractPriceListPageSearchEntity->getPriceKey()] = $priceProductAbstractPriceListPageSearchEntity;
        }

        return $mappedPriceProductAbstractPriceListPageSearchEntities;
    }

    /**
     * @param \Generated\Shared\Transfer\PriceProductPriceListPageSearchTransfer $priceProductPriceListPageSearchTransfer
     * @param \Orm\Zed\PriceProductPriceListPageSearch\Persistence\FosPriceProductAbstractPriceListPageSearch[] $existingPageSearchEntities
     * @param bool $mergePrices
     *
     * @return \Generated\Shared\Transfer\PriceProductPriceListPageSearchTransfer
     */
    protected function groupPrices(
        PriceProductPriceListPageSearchTransfer $priceProductPriceListPageSearchTransfer,
        array $existingPageSearchEntities = [],
        bool $mergePrices = false
    ): PriceProductPriceListPageSearchTransfer {
        $priceProductPriceListPageSearchTransfer = $this->priceGrouper
            ->groupPricesData($priceProductPriceListPageSearchTransfer);

        if (!$mergePrices) {
            return $priceProductPriceListPageSearchTransfer;
        }

        return $this->priceGrouper->groupPricesData(
            $priceProductPriceListPageSearchTransfer,
            $this->getExistingPricesDataForPriceKey($existingPageSearchEntities, $priceProductPriceListPageSearchTransfer->getPriceKey())
        );
    }

    /**
     * @param \Orm\Zed\PriceProductPriceListPageSearch\Persistence\FosPriceProductAbstractPriceListPageSearch[] $existingPageSearchEntities
     * @param string $priceKey
     *
     * @return array
     */
    protected function getExistingPricesDataForPriceKey(array $existingPageSearchEntities, string $priceKey): array
    {
        if (isset($existingPageSearchEntities[$priceKey])) {
            return $existingPageSearchEntities[$priceKey]->getData();
        }

        return [];
    }

    /**
     * @param \Generated\Shared\Transfer\PriceProductPriceListPageSearchTransfer $priceProductPriceListPageSearchTransfer
     *
     * @return \Generated\Shared\Transfer\PriceProductPriceListPageSearchTransfer
     */
    protected function addDataAttributes(
        PriceProductPriceListPageSearchTransfer $priceProductPriceListPageSearchTransfer
    ): PriceProductPriceListPageSearchTransfer {
        $structuredData = $this->utilEncodingService->encodeJson($priceProductPriceListPageSearchTransfer->toArray());
        $data = $this->priceProductSearchMapper->mapTransferToSearchData(
            $priceProductPriceListPageSearchTransfer,
            PriceProductPriceListPageSearchConstants::PRICE_PRODUCT_CONCRETE_PRICE_LIST_RESOURCE_NAME
        );

        $priceProductPriceListPageSearchTransfer->setStructuredData($structuredData)
            ->setData($data);

        return $priceProductPriceListPageSearchTransfer;
    }
}

<?php

namespace FondOfSpryker\Zed\PriceProductPriceListPageSearch\Business\Model;

use FondOfSpryker\Zed\PriceProductPriceListPageSearch\Dependency\Service\PriceProductPriceListPageSearchToUtilEncodingServiceInterface;
use FondOfSpryker\Zed\PriceProductPriceListPageSearch\Persistence\PriceProductPriceListPageSearchEntityManagerInterface;
use FondOfSpryker\Zed\PriceProductPriceListPageSearch\Persistence\PriceProductPriceListPageSearchRepositoryInterface;
use Generated\Shared\Transfer\PriceProductPriceListPageSearchTransfer;

abstract class AbstractPriceProductSearchWriter
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
     * @param \Generated\Shared\Transfer\PriceProductPriceListPageSearchTransfer $priceProductPriceListPageSearchTransfer
     *
     * @return \Generated\Shared\Transfer\PriceProductPriceListPageSearchTransfer
     */
    protected function addDataAttributes(
        PriceProductPriceListPageSearchTransfer $priceProductPriceListPageSearchTransfer
    ): PriceProductPriceListPageSearchTransfer {
        $data = $priceProductPriceListPageSearchTransfer->toArray();

        $structuredData = $this->utilEncodingService->encodeJson($data);
        $searchData = $this->priceProductSearchMapper->mapDataToSearchData($data);

        $priceProductPriceListPageSearchTransfer->setStructuredData($structuredData)
            ->setData($searchData);

        return $priceProductPriceListPageSearchTransfer;
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
}

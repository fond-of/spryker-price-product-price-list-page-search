<?php

namespace FondOfSpryker\Zed\PriceProductPriceListPageSearch\Business;

use FondOfSpryker\Zed\PriceProductPriceListPageSearch\Business\Model\PriceGrouper;
use FondOfSpryker\Zed\PriceProductPriceListPageSearch\Business\Model\PriceGrouperInterface;
use FondOfSpryker\Zed\PriceProductPriceListPageSearch\Business\Model\PriceProductAbstractSearchWriter;
use FondOfSpryker\Zed\PriceProductPriceListPageSearch\Business\Model\PriceProductAbstractSearchWriterInterface;
use FondOfSpryker\Zed\PriceProductPriceListPageSearch\Business\Model\PriceProductConcreteSearchWriter;
use FondOfSpryker\Zed\PriceProductPriceListPageSearch\Business\Model\PriceProductConcreteSearchWriterInterface;
use FondOfSpryker\Zed\PriceProductPriceListPageSearch\Business\Model\PriceProductSearchMapper;
use FondOfSpryker\Zed\PriceProductPriceListPageSearch\Business\Model\PriceProductSearchMapperInterface;
use FondOfSpryker\Zed\PriceProductPriceListPageSearch\Dependency\Facade\PriceProductPriceListPageSearchToSearchFacadeInterface;
use FondOfSpryker\Zed\PriceProductPriceListPageSearch\Dependency\Service\PriceProductPriceListPageSearchToUtilEncodingServiceInterface;
use FondOfSpryker\Zed\PriceProductPriceListPageSearch\PriceProductPriceListPageSearchDependencyProvider;
use Spryker\Zed\Kernel\Business\AbstractBusinessFactory;

/**
 * @method \FondOfSpryker\Zed\PriceProductPriceListPageSearch\Persistence\PriceProductPriceListPageSearchEntityManagerInterface getEntityManager()
 * @method \FondOfSpryker\Zed\PriceProductPriceListPageSearch\PriceProductPriceListPageSearchConfig getConfig()
 * @method \FondOfSpryker\Zed\PriceProductPriceListPageSearch\Persistence\PriceProductPriceListPageSearchRepositoryInterface getRepository()
 */
class PriceProductPriceListPageSearchBusinessFactory extends AbstractBusinessFactory
{
    /**
     * @return \FondOfSpryker\Zed\PriceProductPriceListPageSearch\Business\Model\PriceProductAbstractSearchWriterInterface
     */
    public function createPriceProductAbstractSearchWriter(): PriceProductAbstractSearchWriterInterface
    {
        return new PriceProductAbstractSearchWriter(
            $this->createPriceGrouper(),
            $this->createPriceProductSearchMapper(),
            $this->getUtilEncodingService(),
            $this->getRepository(),
            $this->getEntityManager()
        );
    }

    /**
     * @return \FondOfSpryker\Zed\PriceProductPriceListPageSearch\Business\Model\PriceGrouperInterface
     */
    protected function createPriceGrouper(): PriceGrouperInterface
    {
        return new PriceGrouper();
    }

    /**
     * @return \FondOfSpryker\Zed\PriceProductPriceListPageSearch\Business\Model\PriceProductSearchMapperInterface
     */
    protected function createPriceProductSearchMapper(): PriceProductSearchMapperInterface
    {
        return new PriceProductSearchMapper($this->getSearchFacade());
    }

    /**
     * @throws
     *
     * @return \FondOfSpryker\Zed\PriceProductPriceListPageSearch\Dependency\Service\PriceProductPriceListPageSearchToUtilEncodingServiceInterface
     */
    protected function getUtilEncodingService(): PriceProductPriceListPageSearchToUtilEncodingServiceInterface
    {
        return $this->getProvidedDependency(PriceProductPriceListPageSearchDependencyProvider::SERVICE_UTIL_ENCODING);
    }

    /**
     * @throws
     *
     * @return \FondOfSpryker\Zed\PriceProductPriceListPageSearch\Dependency\Facade\PriceProductPriceListPageSearchToSearchFacadeInterface
     */
    protected function getSearchFacade(): PriceProductPriceListPageSearchToSearchFacadeInterface
    {
        return $this->getProvidedDependency(PriceProductPriceListPageSearchDependencyProvider::FACADE_SEARCH);
    }

    /**
     * @return \FondOfSpryker\Zed\PriceProductPriceListPageSearch\Business\Model\PriceProductConcreteSearchWriterInterface
     */
    public function createPriceProductConcreteSearchWriter(): PriceProductConcreteSearchWriterInterface
    {
        return new PriceProductConcreteSearchWriter(
            $this->createPriceGrouper(),
            $this->createPriceProductSearchMapper(),
            $this->getUtilEncodingService(),
            $this->getRepository(),
            $this->getEntityManager()
        );
    }
}

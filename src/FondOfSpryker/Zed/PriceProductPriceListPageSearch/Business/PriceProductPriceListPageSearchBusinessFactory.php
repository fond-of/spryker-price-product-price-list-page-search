<?php

namespace FondOfSpryker\Zed\PriceProductPriceListPageSearch\Business;

use FondOfSpryker\Zed\PriceProductPriceListPageSearch\Business\Model\PriceGrouper;
use FondOfSpryker\Zed\PriceProductPriceListPageSearch\Business\Model\PriceGrouperInterface;
use FondOfSpryker\Zed\PriceProductPriceListPageSearch\Business\Model\PriceProductAbstractSearchExpander;
use FondOfSpryker\Zed\PriceProductPriceListPageSearch\Business\Model\PriceProductAbstractSearchExpanderInterface;
use FondOfSpryker\Zed\PriceProductPriceListPageSearch\Business\Model\PriceProductAbstractSearchMapper;
use FondOfSpryker\Zed\PriceProductPriceListPageSearch\Business\Model\PriceProductAbstractSearchWriter;
use FondOfSpryker\Zed\PriceProductPriceListPageSearch\Business\Model\PriceProductAbstractSearchWriterInterface;
use FondOfSpryker\Zed\PriceProductPriceListPageSearch\Business\Model\PriceProductConcreteSearchExpander;
use FondOfSpryker\Zed\PriceProductPriceListPageSearch\Business\Model\PriceProductConcreteSearchExpanderInterface;
use FondOfSpryker\Zed\PriceProductPriceListPageSearch\Business\Model\PriceProductConcreteSearchMapper;
use FondOfSpryker\Zed\PriceProductPriceListPageSearch\Business\Model\PriceProductConcreteSearchWriter;
use FondOfSpryker\Zed\PriceProductPriceListPageSearch\Business\Model\PriceProductConcreteSearchWriterInterface;
use FondOfSpryker\Zed\PriceProductPriceListPageSearch\Business\Model\PriceProductSearchMapperInterface;
use FondOfSpryker\Zed\PriceProductPriceListPageSearch\Dependency\Facade\PriceProductPriceListPageSearchToStoreFacadeInterface;
use FondOfSpryker\Zed\PriceProductPriceListPageSearch\Dependency\Service\PriceProductPriceListPageSearchToUtilEncodingServiceInterface;
use FondOfSpryker\Zed\PriceProductPriceListPageSearch\PriceProductPriceListPageSearchDependencyProvider;
use Spryker\Zed\Kernel\Business\AbstractBusinessFactory;

/**
 * @method \FondOfSpryker\Zed\PriceProductPriceListPageSearch\Persistence\PriceProductPriceListPageSearchEntityManagerInterface getEntityManager()
 * @method \FondOfSpryker\Zed\PriceProductPriceListPageSearch\PriceProductPriceListPageSearchConfig getConfig()
 * @method \FondOfSpryker\Zed\PriceProductPriceListPageSearch\Persistence\PriceProductPriceListPageSearchRepositoryInterface getRepository()
 * @method \FondOfSpryker\Zed\PriceProductPriceListPageSearch\Persistence\PriceProductPriceListPageSearchQueryContainerInterface getQueryContainer()
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
            $this->createPriceProductAbstractSearchMapper(),
            $this->getUtilEncodingService(),
            $this->getRepository(),
            $this->getEntityManager(),
            $this->createPriceProductAbstractSearchExpander()
        );
    }

    /**
     * @return \FondOfSpryker\Zed\PriceProductPriceListPageSearch\Business\Model\PriceProductConcreteSearchWriterInterface
     */
    public function createPriceProductConcreteSearchWriter(): PriceProductConcreteSearchWriterInterface
    {
        return new PriceProductConcreteSearchWriter(
            $this->createPriceGrouper(),
            $this->createPriceProductConcreteSearchMapper(),
            $this->getUtilEncodingService(),
            $this->getRepository(),
            $this->getEntityManager(),
            $this->createPriceProductConcreteSearchExpander()
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
    protected function createPriceProductAbstractSearchMapper(): PriceProductSearchMapperInterface
    {
        return new PriceProductAbstractSearchMapper(
            $this->getStoreFacade(),
            $this->getPriceProductAbstractPriceListPageSearchDataExpanderPlugins()
        );
    }

    /**
     * @return \FondOfSpryker\Zed\PriceProductPriceListPageSearch\Business\Model\PriceProductSearchMapperInterface
     */
    protected function createPriceProductConcreteSearchMapper(): PriceProductSearchMapperInterface
    {
        return new PriceProductConcreteSearchMapper(
            $this->getStoreFacade(),
            $this->getPriceProductConcretePriceListPageSearchDataExpanderPlugins()
        );
    }

    /**
     * @return \FondOfSpryker\Zed\PriceProductPriceListPageSearch\Business\Model\PriceProductAbstractSearchExpanderInterface
     */
    protected function createPriceProductAbstractSearchExpander(): PriceProductAbstractSearchExpanderInterface
    {
        return new PriceProductAbstractSearchExpander(
            $this->getPriceProductAbstractPriceListPageDataExpanderPlugins()
        );
    }

    /**
     * @return \FondOfSpryker\Zed\PriceProductPriceListPageSearch\Business\Model\PriceProductConcreteSearchExpanderInterface
     */
    protected function createPriceProductConcreteSearchExpander(): PriceProductConcreteSearchExpanderInterface
    {
        return new PriceProductConcreteSearchExpander(
            $this->getPriceProductConcretePriceListPageDataExpanderPlugins()
        );
    }

    /**
     * @return \FondOfSpryker\Zed\PriceProductPriceListPageSearchExtension\Dependency\Plugin\PriceProductConcretePriceListPageDataExpanderPluginInterface[]
     */
    protected function getPriceProductConcretePriceListPageDataExpanderPlugins(): array
    {
        return $this->getProvidedDependency(PriceProductPriceListPageSearchDependencyProvider::PLUGINS_PRICE_PRODUCT_CONCRETE_PRICE_LIST_PAGE_DATA_EXPANDER);
    }

    /**
     * @return \FondOfSpryker\Zed\PriceProductPriceListPageSearchExtension\Dependency\Plugin\PriceProductAbstractPriceListPageDataExpanderPluginInterface[]
     */
    protected function getPriceProductAbstractPriceListPageDataExpanderPlugins(): array
    {
        return $this->getProvidedDependency(PriceProductPriceListPageSearchDependencyProvider::PLUGINS_PRICE_PRODUCT_ABSTRACT_PRICE_LIST_PAGE_DATA_EXPANDER);
    }

    /**
     * @return \FondOfSpryker\Zed\PriceProductPriceListPageSearchExtension\Dependency\Plugin\PriceProductConcretePriceListPageSearchDataExpanderPluginInterface[]
     */
    protected function getPriceProductConcretePriceListPageSearchDataExpanderPlugins(): array
    {
        return $this->getProvidedDependency(PriceProductPriceListPageSearchDependencyProvider::PLUGINS_PRICE_PRODUCT_CONCRETE_PRICE_LIST_PAGE_SEARCH_DATA_EXPANDER);
    }

    /**
     * @return \FondOfSpryker\Zed\PriceProductPriceListPageSearchExtension\Dependency\Plugin\PriceProductAbstractPriceListPageSearchDataExpanderPluginInterface[]
     */
    protected function getPriceProductAbstractPriceListPageSearchDataExpanderPlugins(): array
    {
        return $this->getProvidedDependency(PriceProductPriceListPageSearchDependencyProvider::PLUGINS_PRICE_PRODUCT_ABSTRACT_PRICE_LIST_PAGE_SEARCH_DATA_EXPANDER);
    }

    /**
     * @return \FondOfSpryker\Zed\PriceProductPriceListPageSearch\Dependency\Service\PriceProductPriceListPageSearchToUtilEncodingServiceInterface
     */
    protected function getUtilEncodingService(): PriceProductPriceListPageSearchToUtilEncodingServiceInterface
    {
        return $this->getProvidedDependency(PriceProductPriceListPageSearchDependencyProvider::SERVICE_UTIL_ENCODING);
    }

    /**
     * @return \FondOfSpryker\Zed\PriceProductPriceListPageSearch\Dependency\Facade\PriceProductPriceListPageSearchToStoreFacadeInterface
     */
    protected function getStoreFacade(): PriceProductPriceListPageSearchToStoreFacadeInterface
    {
        return $this->getProvidedDependency(PriceProductPriceListPageSearchDependencyProvider::FACADE_STORE);
    }
}

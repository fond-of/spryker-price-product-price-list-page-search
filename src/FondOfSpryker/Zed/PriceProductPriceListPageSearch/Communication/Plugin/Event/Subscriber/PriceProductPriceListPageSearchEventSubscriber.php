<?php

namespace FondOfSpryker\Zed\PriceProductPriceListPageSearch\Communication\Plugin\Event\Subscriber;

use FondOfSpryker\Zed\PriceProductPriceList\Dependency\PriceProductPriceListEvents;
use FondOfSpryker\Zed\PriceProductPriceListPageSearch\Communication\Plugin\Event\Listener\PriceProductPriceListAbstractDeleteListener;
use FondOfSpryker\Zed\PriceProductPriceListPageSearch\Communication\Plugin\Event\Listener\PriceProductPriceListAbstractListener;
use FondOfSpryker\Zed\PriceProductPriceListPageSearch\Communication\Plugin\Event\Listener\PriceProductPriceListConcreteDeleteListener;
use FondOfSpryker\Zed\PriceProductPriceListPageSearch\Communication\Plugin\Event\Listener\PriceProductPriceListConcreteListener;
use Spryker\Zed\Event\Dependency\EventCollectionInterface;
use Spryker\Zed\Event\Dependency\Plugin\EventSubscriberInterface;
use Spryker\Zed\Kernel\Communication\AbstractPlugin;

/**
 * @method \FondOfSpryker\Zed\PriceProductPriceListPageSearch\PriceProductPriceListPageSearchConfig getConfig()
 * @method \FondOfSpryker\Zed\PriceProductPriceListPageSearch\Business\PriceProductPriceListPageSearchFacadeInterface getFacade()
 * @method \FondOfSpryker\Zed\PriceProductPriceListPageSearch\Communication\PriceProductPriceListPageSearchCommunicationFactory getFactory()
 * @method \FondOfSpryker\Zed\PriceProductPriceListPageSearch\Persistence\PriceProductPriceListPageSearchQueryContainerInterface getQueryContainer()
 */
class PriceProductPriceListPageSearchEventSubscriber extends AbstractPlugin implements EventSubscriberInterface
{
    /**
     * @api
     *
     * @param \Spryker\Zed\Event\Dependency\EventCollectionInterface $eventCollection
     *
     * @return \Spryker\Zed\Event\Dependency\EventCollectionInterface
     */
    public function getSubscribedEvents(EventCollectionInterface $eventCollection): EventCollectionInterface
    {
        $this->addAbstractPriceProductPriceListCreateListener($eventCollection);
        $this->addAbstractPriceProductPriceListUpdateListener($eventCollection);
        $this->addAbstractPriceProductPriceListDeleteListener($eventCollection);
        $this->addAbstractPriceProductPriceListPublishListener($eventCollection);

        $this->addConcretePriceProductPriceListCreateListener($eventCollection);
        $this->addConcretePriceProductPriceListUpdateListener($eventCollection);
        $this->addConcretePriceProductPriceListDeleteListener($eventCollection);
        $this->addConcretePriceProductPriceListPublishListener($eventCollection);

        return $eventCollection;
    }

    /**
     * @param \Spryker\Zed\Event\Dependency\EventCollectionInterface $eventCollection
     *
     * @return $this
     */
    protected function addConcretePriceProductPriceListCreateListener(EventCollectionInterface $eventCollection)
    {
        $eventCollection->addListenerQueued(
            PriceProductPriceListEvents::ENTITY_FOS_PRICE_PRODUCT_PRICE_LIST_CREATE,
            new PriceProductPriceListConcreteListener()
        );

        return $this;
    }

    /**
     * @param \Spryker\Zed\Event\Dependency\EventCollectionInterface $eventCollection
     *
     * @return $this
     */
    protected function addConcretePriceProductPriceListUpdateListener(EventCollectionInterface $eventCollection)
    {
        $eventCollection->addListenerQueued(
            PriceProductPriceListEvents::ENTITY_FOS_PRICE_PRODUCT_PRICE_LIST_UPDATE,
            new PriceProductPriceListConcreteListener()
        );

        return $this;
    }

    /**
     * @param \Spryker\Zed\Event\Dependency\EventCollectionInterface $eventCollection
     *
     * @return $this
     */
    protected function addConcretePriceProductPriceListDeleteListener(EventCollectionInterface $eventCollection)
    {
        $eventCollection->addListenerQueued(
            PriceProductPriceListEvents::ENTITY_FOS_PRICE_PRODUCT_PRICE_LIST_DELETE,
            new PriceProductPriceListConcreteDeleteListener()
        );

        return $this;
    }

    /**
     * @param \Spryker\Zed\Event\Dependency\EventCollectionInterface $eventCollection
     *
     * @return $this
     */
    protected function addAbstractPriceProductPriceListCreateListener(EventCollectionInterface $eventCollection)
    {
        $eventCollection->addListenerQueued(
            PriceProductPriceListEvents::ENTITY_FOS_PRICE_PRODUCT_PRICE_LIST_CREATE,
            new PriceProductPriceListAbstractListener()
        );

        return $this;
    }

    /**
     * @param \Spryker\Zed\Event\Dependency\EventCollectionInterface $eventCollection
     *
     * @return $this
     */
    protected function addAbstractPriceProductPriceListUpdateListener(EventCollectionInterface $eventCollection)
    {
        $eventCollection->addListenerQueued(
            PriceProductPriceListEvents::ENTITY_FOS_PRICE_PRODUCT_PRICE_LIST_UPDATE,
            new PriceProductPriceListAbstractListener()
        );

        return $this;
    }

    /**
     * @param \Spryker\Zed\Event\Dependency\EventCollectionInterface $eventCollection
     *
     * @return $this
     */
    protected function addAbstractPriceProductPriceListDeleteListener(EventCollectionInterface $eventCollection)
    {
        $eventCollection->addListenerQueued(
            PriceProductPriceListEvents::ENTITY_FOS_PRICE_PRODUCT_PRICE_LIST_DELETE,
            new PriceProductPriceListAbstractDeleteListener()
        );

        return $this;
    }

    /**
     * @param \Spryker\Zed\Event\Dependency\EventCollectionInterface $eventCollection
     *
     * @return $this
     */
    protected function addAbstractPriceProductPriceListPublishListener(EventCollectionInterface $eventCollection)
    {
        $eventCollection->addListenerQueued(
            PriceProductPriceListEvents::PRICE_ABSTRACT_PUBLISH,
            new PriceProductPriceListAbstractListener()
        );

        return $this;
    }

    /**
     * @param \Spryker\Zed\Event\Dependency\EventCollectionInterface $eventCollection
     *
     * @return $this
     */
    protected function addConcretePriceProductPriceListPublishListener(EventCollectionInterface $eventCollection)
    {
        $eventCollection->addListenerQueued(
            PriceProductPriceListEvents::PRICE_CONCRETE_PUBLISH,
            new PriceProductPriceListAbstractListener()
        );

        return $this;
    }
}

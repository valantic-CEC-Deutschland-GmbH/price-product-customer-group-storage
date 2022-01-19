<?php

declare(strict_types = 1);

namespace ValanticSpryker\Zed\PriceProductCustomerGroupStorage\Communication\Plugin\Event\Subscriber;

use Spryker\Zed\Event\Dependency\EventCollectionInterface;
use Spryker\Zed\Event\Dependency\Plugin\EventSubscriberInterface;
use Spryker\Zed\Kernel\Communication\AbstractPlugin;
use ValanticSpryker\Zed\PriceProductCustomerGroup\Dependency\PriceProductCustomerGroupEvents;
use ValanticSpryker\Zed\PriceProductCustomerGroupStorage\Communication\Plugin\Event\Listener\PriceProductCustomerGroupAbstractDeleteListener;
use ValanticSpryker\Zed\PriceProductCustomerGroupStorage\Communication\Plugin\Event\Listener\PriceProductCustomerGroupAbstractListener;
use ValanticSpryker\Zed\PriceProductCustomerGroupStorage\Communication\Plugin\Event\Listener\PriceProductCustomerGroupConcreteDeleteListener;
use ValanticSpryker\Zed\PriceProductCustomerGroupStorage\Communication\Plugin\Event\Listener\PriceProductCustomerGroupConcreteListener;

/**
 * @method \ValanticSpryker\Zed\PriceProductCustomerGroupStorage\Business\PriceProductCustomerGroupStorageFacadeInterface getFacade()
 * @method \ValanticSpryker\Zed\PriceProductCustomerGroupStorage\Communication\PriceProductCustomerGroupStorageCommunicationFactory getFactory()
 * @method \ValanticSpryker\Zed\PriceProductCustomerGroupStorage\PriceProductCustomerGroupStorageConfig getConfig()
 */
class PriceProductCustomerGroupStorageEventSubscriber extends AbstractPlugin implements EventSubscriberInterface
{
    /**
     * {@inheritDoc}
     *
     * @api
     *
     * @param \Spryker\Zed\Event\Dependency\EventCollectionInterface $eventCollection
     *
     * @return \Spryker\Zed\Event\Dependency\EventCollectionInterface
     */
    public function getSubscribedEvents(EventCollectionInterface $eventCollection): EventCollectionInterface
    {
        $this
            ->addConcretePriceProductCustomerGroupCreateListener($eventCollection)
            ->addConcretePriceProductCustomerGroupUpdateListener($eventCollection)
            ->addConcretePriceProductCustomerGroupDeleteListener($eventCollection)
            ->addAbstractPriceProductCustomerGroupCreateListener($eventCollection)
            ->addAbstractPriceProductCustomerGroupUpdateListener($eventCollection)
            ->addAbstractPriceProductCustomerGroupDeleteListener($eventCollection)
            ->addConcretePriceProductCustomerGroupPublishListener($eventCollection)
            ->addAbstractPriceProductCustomerGroupPublishListener($eventCollection)
            ->addConcretePriceProductCustomerGroupUnpublishListener($eventCollection)
            ->addAbstractPriceProductCustomerGroupUnpublishListener($eventCollection);

        return $eventCollection;
    }

    /**
     * @param \Spryker\Zed\Event\Dependency\EventCollectionInterface $eventCollection
     *
     * @return $this
     */
    protected function addConcretePriceProductCustomerGroupCreateListener(EventCollectionInterface $eventCollection)
    {
        $eventCollection->addListenerQueued(PriceProductCustomerGroupEvents::ENTITY_VSY_PRICE_PRODUCT_CUSTOMER_GROUP_CREATE, new PriceProductCustomerGroupConcreteListener(), 0, null, $this->getConfig()->getPriceProductConcreteCustomerGroupEventQueueName());

        return $this;
    }

    /**
     * @param \Spryker\Zed\Event\Dependency\EventCollectionInterface $eventCollection
     *
     * @return $this
     */
    protected function addConcretePriceProductCustomerGroupUpdateListener(EventCollectionInterface $eventCollection)
    {
        $eventCollection->addListenerQueued(PriceProductCustomerGroupEvents::ENTITY_VSY_PRICE_PRODUCT_CUSTOMER_GROUP_UPDATE, new PriceProductCustomerGroupConcreteListener(), 0, null, $this->getConfig()->getPriceProductConcreteCustomerGroupEventQueueName());

        return $this;
    }

    /**
     * @param \Spryker\Zed\Event\Dependency\EventCollectionInterface $eventCollection
     *
     * @return $this
     */
    protected function addConcretePriceProductCustomerGroupDeleteListener(EventCollectionInterface $eventCollection)
    {
        $eventCollection->addListenerQueued(PriceProductCustomerGroupEvents::ENTITY_VSY_PRICE_PRODUCT_CUSTOMER_GROUP_DELETE, new PriceProductCustomerGroupConcreteDeleteListener(), 0, null, $this->getConfig()->getPriceProductConcreteCustomerGroupEventQueueName());

        return $this;
    }

    /**
     * @param \Spryker\Zed\Event\Dependency\EventCollectionInterface $eventCollection
     *
     * @return $this
     */
    protected function addAbstractPriceProductCustomerGroupCreateListener(EventCollectionInterface $eventCollection)
    {
        $eventCollection->addListenerQueued(PriceProductCustomerGroupEvents::ENTITY_VSY_PRICE_PRODUCT_CUSTOMER_GROUP_CREATE, new PriceProductCustomerGroupAbstractListener(), 0, null, $this->getConfig()->getPriceProductConcreteCustomerGroupEventQueueName());

        return $this;
    }

    /**
     * @param \Spryker\Zed\Event\Dependency\EventCollectionInterface $eventCollection
     *
     * @return $this
     */
    protected function addAbstractPriceProductCustomerGroupUpdateListener(EventCollectionInterface $eventCollection)
    {
        $eventCollection->addListenerQueued(PriceProductCustomerGroupEvents::ENTITY_VSY_PRICE_PRODUCT_CUSTOMER_GROUP_UPDATE, new PriceProductCustomerGroupAbstractListener(), 0, null, $this->getConfig()->getPriceProductConcreteCustomerGroupEventQueueName());

        return $this;
    }

    /**
     * @param \Spryker\Zed\Event\Dependency\EventCollectionInterface $eventCollection
     *
     * @return $this
     */
    protected function addAbstractPriceProductCustomerGroupDeleteListener(EventCollectionInterface $eventCollection)
    {
        $eventCollection->addListenerQueued(PriceProductCustomerGroupEvents::ENTITY_VSY_PRICE_PRODUCT_CUSTOMER_GROUP_DELETE, new PriceProductCustomerGroupAbstractDeleteListener(), 0, null, $this->getConfig()->getPriceProductConcreteCustomerGroupEventQueueName());

        return $this;
    }

    /**
     * @param \Spryker\Zed\Event\Dependency\EventCollectionInterface $eventCollection
     *
     * @return $this
     */
    protected function addConcretePriceProductCustomerGroupPublishListener(EventCollectionInterface $eventCollection)
    {
        $eventCollection->addListenerQueued(PriceProductCustomerGroupEvents::PRICE_CONCRETE_PUBLISH, new PriceProductCustomerGroupConcreteListener(), 0, null, $this->getConfig()->getPriceProductConcreteCustomerGroupEventQueueName());

        return $this;
    }

    /**
     * @param \Spryker\Zed\Event\Dependency\EventCollectionInterface $eventCollection
     *
     * @return $this
     */
    protected function addAbstractPriceProductCustomerGroupPublishListener(EventCollectionInterface $eventCollection)
    {
        $eventCollection->addListenerQueued(PriceProductCustomerGroupEvents::PRICE_ABSTRACT_PUBLISH, new PriceProductCustomerGroupAbstractListener(), 0, null, $this->getConfig()->getPriceProductConcreteCustomerGroupEventQueueName());

        return $this;
    }

    /**
     * @param \Spryker\Zed\Event\Dependency\EventCollectionInterface $eventCollection
     *
     * @return $this
     */
    protected function addConcretePriceProductCustomerGroupUnpublishListener(EventCollectionInterface $eventCollection)
    {
        $eventCollection->addListenerQueued(PriceProductCustomerGroupEvents::PRICE_CONCRETE_UNPUBLISH, new PriceProductCustomerGroupConcreteDeleteListener(), 0, null, $this->getConfig()->getPriceProductConcreteCustomerGroupEventQueueName());

        return $this;
    }

    /**
     * @param \Spryker\Zed\Event\Dependency\EventCollectionInterface $eventCollection
     *
     * @return $this
     */
    protected function addAbstractPriceProductCustomerGroupUnpublishListener(EventCollectionInterface $eventCollection)
    {
        $eventCollection->addListenerQueued(PriceProductCustomerGroupEvents::PRICE_ABSTRACT_UNPUBLISH, new PriceProductCustomerGroupAbstractDeleteListener(), 0, null, $this->getConfig()->getPriceProductConcreteCustomerGroupEventQueueName());

        return $this;
    }
}

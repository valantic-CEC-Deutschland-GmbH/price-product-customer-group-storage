<?php

declare(strict_types = 1);

namespace ValanticSpryker\Zed\PriceProductCustomerGroupStorage\Communication;

use Spryker\Zed\Kernel\Communication\AbstractCommunicationFactory;
use ValanticSpryker\Zed\PriceProductCustomerGroupStorage\Dependency\Facade\PriceProductCustomerGroupStorageToEventBehaviorFacadeInterface;
use ValanticSpryker\Zed\PriceProductCustomerGroupStorage\PriceProductCustomerGroupStorageDependencyProvider;

class PriceProductCustomerGroupStorageCommunicationFactory extends AbstractCommunicationFactory
{
    /**
     * @return \ValanticSpryker\Zed\PriceProductCustomerGroupStorage\Dependency\Facade\PriceProductCustomerGroupStorageToEventBehaviorFacadeInterface
     */
    public function getEventBehaviorFacade(): PriceProductCustomerGroupStorageToEventBehaviorFacadeInterface
    {
        return $this->getProvidedDependency(PriceProductCustomerGroupStorageDependencyProvider::FACADE_EVENT_BEHAVIOR);
    }
}

<?php

declare(strict_types = 1);

namespace ValanticSpryker\Zed\PriceProductCustomerGroupStorage\Communication;

use Spryker\Zed\Kernel\Communication\AbstractCommunicationFactory;
use ValanticSpryker\Zed\PriceProductCustomerGroupStorage\Dependency\Facade\PriceProductCustomerGroupStorageToEventBehaviorFacadeInterface;
use ValanticSpryker\Zed\PriceProductCustomerGroupStorage\PriceProductCustomerGroupStorageDependencyProvider;

/**
 * @method \ValanticSpryker\Zed\PriceProductCustomerGroupStorage\PriceProductCustomerGroupStorageConfig getConfig()
 * @method \ValanticSpryker\Zed\PriceProductCustomerGroupStorage\Persistence\PriceProductCustomerGroupStorageEntityManagerInterface getEntityManager()
 * @method \ValanticSpryker\Zed\PriceProductCustomerGroupStorage\Persistence\PriceProductCustomerGroupStorageRepositoryInterface getRepository()
 * @method \ValanticSpryker\Zed\PriceProductCustomerGroupStorage\Business\PriceProductCustomerGroupStorageFacadeInterface getFacade()
 */
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

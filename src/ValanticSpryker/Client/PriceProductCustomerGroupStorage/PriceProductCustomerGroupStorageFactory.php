<?php

declare(strict_types = 1);

namespace ValanticSpryker\Client\PriceProductCustomerGroupStorage;

use Spryker\Client\Kernel\AbstractFactory;
use ValanticSpryker\Client\PriceProductCustomerGroupStorage\CustomerGroupFinder\CustomerGroupFinder;
use ValanticSpryker\Client\PriceProductCustomerGroupStorage\CustomerGroupFinder\CustomerGroupFinderInterface;
use ValanticSpryker\Client\PriceProductCustomerGroupStorage\Dependency\Client\PriceProductCustomerGroupStorageToCustomerClientInterface;
use ValanticSpryker\Client\PriceProductCustomerGroupStorage\Dependency\Client\PriceProductCustomerGroupStorageToStorageClientInterface;
use ValanticSpryker\Client\PriceProductCustomerGroupStorage\Dependency\Client\PriceProductCustomerGroupStorageToStoreClientInterface;
use ValanticSpryker\Client\PriceProductCustomerGroupStorage\Dependency\Service\PriceProductCustomerGroupStorageToPriceProductServiceInterface;
use ValanticSpryker\Client\PriceProductCustomerGroupStorage\Dependency\Service\PriceProductCustomerGroupToSynchronizationServiceInterface;
use ValanticSpryker\Client\PriceProductCustomerGroupStorage\Storage\PriceProductCustomerGroupAbstractReader;
use ValanticSpryker\Client\PriceProductCustomerGroupStorage\Storage\PriceProductCustomerGroupAbstractReaderInterface;
use ValanticSpryker\Client\PriceProductCustomerGroupStorage\Storage\PriceProductCustomerGroupConcreteReader;
use ValanticSpryker\Client\PriceProductCustomerGroupStorage\Storage\PriceProductCustomerGroupConcreteReaderInterface;
use ValanticSpryker\Client\PriceProductCustomerGroupStorage\Storage\PriceProductCustomerGroupKeyGenerator;
use ValanticSpryker\Client\PriceProductCustomerGroupStorage\Storage\PriceProductCustomerGroupKeyGeneratorInterface;
use ValanticSpryker\Client\PriceProductCustomerGroupStorage\Storage\PriceProductMapper;
use ValanticSpryker\Client\PriceProductCustomerGroupStorage\Storage\PriceProductMapperInterface;

/**
 * @method \ValanticSpryker\Client\PriceProductCustomerGroupStorage\PriceProductCustomerGroupStorageConfig getConfig()
 */
class PriceProductCustomerGroupStorageFactory extends AbstractFactory
{
    /**
     * @return \ValanticSpryker\Client\PriceProductCustomerGroupStorage\Storage\PriceProductCustomerGroupAbstractReaderInterface
     */
    public function createPriceProductCustomerGroupAbstractReader(): PriceProductCustomerGroupAbstractReaderInterface
    {
        return new PriceProductCustomerGroupAbstractReader(
            $this->getStorageClient(),
            $this->createPriceProductCustomerGroupKeyGenerator(),
            $this->createPriceProductMapper(),
        );
    }

    /**
     * @return \ValanticSpryker\Client\PriceProductCustomerGroupStorage\Storage\PriceProductCustomerGroupConcreteReaderInterface
     */
    public function createPriceProductCustomerGroupConcreteReader(): PriceProductCustomerGroupConcreteReaderInterface
    {
        return new PriceProductCustomerGroupConcreteReader(
            $this->getStorageClient(),
            $this->createPriceProductCustomerGroupKeyGenerator(),
            $this->createPriceProductMapper(),
        );
    }

    /**
     * @return \ValanticSpryker\Client\PriceProductCustomerGroupStorage\CustomerGroupFinder\CustomerGroupFinderInterface
     */
    public function createCustomerGroupFinder(): CustomerGroupFinderInterface
    {
        return new CustomerGroupFinder($this->getCustomerClient());
    }

    /**
     * @return \ValanticSpryker\Client\PriceProductCustomerGroupStorage\Storage\PriceProductCustomerGroupKeyGeneratorInterface
     */
    public function createPriceProductCustomerGroupKeyGenerator(): PriceProductCustomerGroupKeyGeneratorInterface
    {
        return new PriceProductCustomerGroupKeyGenerator(
            $this->getSynchronizationService(),
            $this->getStoreClient(),
        );
    }

    /**
     * @return \ValanticSpryker\Client\PriceProductCustomerGroupStorage\Dependency\Client\PriceProductCustomerGroupStorageToCustomerClientInterface
     */
    public function getCustomerClient(): PriceProductCustomerGroupStorageToCustomerClientInterface
    {
        return $this->getProvidedDependency(PriceProductCustomerGroupStorageDependencyProvider::CLIENT_CUSTOMER);
    }

    /**
     * @return \ValanticSpryker\Client\PriceProductCustomerGroupStorage\Dependency\Client\PriceProductCustomerGroupStorageToStorageClientInterface
     */
    public function getStorageClient(): PriceProductCustomerGroupStorageToStorageClientInterface
    {
        return $this->getProvidedDependency(PriceProductCustomerGroupStorageDependencyProvider::CLIENT_STORAGE);
    }

    /**
     * @return \ValanticSpryker\Client\PriceProductCustomerGroupStorage\Dependency\Service\PriceProductCustomerGroupStorageToPriceProductServiceInterface
     */
    public function getPriceProductService(): PriceProductCustomerGroupStorageToPriceProductServiceInterface
    {
        return $this->getProvidedDependency(PriceProductCustomerGroupStorageDependencyProvider::SERVICE_PRICE_PRODUCT);
    }

    /**
     * @return \ValanticSpryker\Client\PriceProductCustomerGroupStorage\Dependency\Client\PriceProductCustomerGroupStorageToStoreClientInterface
     */
    public function getStoreClient(): PriceProductCustomerGroupStorageToStoreClientInterface
    {
        return $this->getProvidedDependency(PriceProductCustomerGroupStorageDependencyProvider::CLIENT_STORE);
    }

    /**
     * @return \ValanticSpryker\Client\PriceProductCustomerGroupStorage\Dependency\Service\PriceProductCustomerGroupToSynchronizationServiceInterface
     */
    public function getSynchronizationService(): PriceProductCustomerGroupToSynchronizationServiceInterface
    {
        return $this->getProvidedDependency(PriceProductCustomerGroupStorageDependencyProvider::SERVICE_SYNCHRONIZATION);
    }

    /**
     * @return \ValanticSpryker\Client\PriceProductCustomerGroupStorage\PriceProductCustomerGroupStorageConfig
     */
    public function getPriceProductCustomerGroupStorageConfig(): PriceProductCustomerGroupStorageConfig
    {
        return $this->getConfig();
    }

    /**
     * @return \ValanticSpryker\Client\PriceProductCustomerGroupStorage\Storage\PriceProductMapperInterface
     */
    public function createPriceProductMapper(): PriceProductMapperInterface
    {
        return new PriceProductMapper(
            $this->getConfig(),
            $this->getPriceProductService(),
        );
    }
}

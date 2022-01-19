<?php

declare(strict_types = 1);

namespace ValanticSpryker\Zed\PriceProductCustomerGroupStorage\Business;

use Spryker\Zed\Kernel\Business\AbstractBusinessFactory;
use ValanticSpryker\Zed\PriceProductCustomerGroupStorage\Business\Model\PriceGrouper;
use ValanticSpryker\Zed\PriceProductCustomerGroupStorage\Business\Model\PriceGrouperInterface;
use ValanticSpryker\Zed\PriceProductCustomerGroupStorage\Business\Model\PriceProductAbstractStorageWriter;
use ValanticSpryker\Zed\PriceProductCustomerGroupStorage\Business\Model\PriceProductAbstractStorageWriterInterface;
use ValanticSpryker\Zed\PriceProductCustomerGroupStorage\Business\Model\PriceProductConcreteStorageWriter;
use ValanticSpryker\Zed\PriceProductCustomerGroupStorage\Business\Model\PriceProductConcreteStorageWriterInterface;
use ValanticSpryker\Zed\PriceProductCustomerGroupStorage\PriceProductCustomerGroupStorageDependencyProvider;

/**
 * @method \ValanticSpryker\Zed\PriceProductCustomerGroupStorage\Persistence\PriceProductCustomerGroupStorageEntityManagerInterface getEntityManager()
 * @method \ValanticSpryker\Zed\PriceProductCustomerGroupStorage\Persistence\PriceProductCustomerGroupStorageRepositoryInterface getRepository()
 * @method \ValanticSpryker\Zed\PriceProductCustomerGroupStorage\PriceProductCustomerGroupStorageConfig getConfig()
 */
class PriceProductCustomerGroupStorageBusinessFactory extends AbstractBusinessFactory
{
    /**
     * @return \ValanticSpryker\Zed\PriceProductCustomerGroupStorage\Business\Model\PriceProductAbstractStorageWriterInterface
     */
    public function createPriceProductAbstractStorageWriter(): PriceProductAbstractStorageWriterInterface
    {
        return new PriceProductAbstractStorageWriter(
            $this->getEntityManager(),
            $this->getRepository(),
            $this->createPriceGrouper(),
            $this->getPriceProductCustomerGroupStorageFilterPlugins(),
        );
    }

    /**
     * @return \ValanticSpryker\Zed\PriceProductCustomerGroupStorage\Business\Model\PriceProductConcreteStorageWriterInterface
     */
    public function createPriceProductConcreteStorageWriter(): PriceProductConcreteStorageWriterInterface
    {
        return new PriceProductConcreteStorageWriter(
            $this->getEntityManager(),
            $this->getRepository(),
            $this->createPriceGrouper(),
            $this->getPriceProductCustomerGroupStorageFilterPlugins(),
        );
    }

    /**
     * @return \ValanticSpryker\Zed\PriceProductCustomerGroupStorage\Business\Model\PriceGrouperInterface
     */
    public function createPriceGrouper(): PriceGrouperInterface
    {
        return new PriceGrouper();
    }

    /**
     * @return array<\ValanticSpryker\Zed\PriceProductCustomerGroupStorageExtension\Dependency\Plugin\PriceProductCustomerGroupStorageFilterPluginInterface>
     */
    public function getPriceProductCustomerGroupStorageFilterPlugins(): array
    {
        return $this->getProvidedDependency(PriceProductCustomerGroupStorageDependencyProvider::PLUGINS_PRICE_PRODUCT_CUSTOMER_GROUP_STORAGE_FILTER);
    }
}

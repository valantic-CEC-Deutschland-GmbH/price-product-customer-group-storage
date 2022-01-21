<?php

declare(strict_types = 1);

namespace ValanticSpryker\Zed\PriceProductCustomerGroupStorage\Persistence;

use Orm\Zed\PriceProductCustomerGroup\Persistence\VsyPriceProductCustomerGroupQuery;
use Orm\Zed\PriceProductCustomerGroupStorage\Persistence\VsyPriceProductAbstractCustomerGroupStorageQuery;
use Orm\Zed\PriceProductCustomerGroupStorage\Persistence\VsyPriceProductConcreteCustomerGroupStorageQuery;
use Spryker\Zed\Kernel\Persistence\AbstractPersistenceFactory;
use ValanticSpryker\Zed\PriceProductCustomerGroupStorage\Persistence\Mapper\CustomerGroupPriceProductMapper;
use ValanticSpryker\Zed\PriceProductCustomerGroupStorage\Persistence\Mapper\CustomerGroupPriceProductMapperInterface;
use ValanticSpryker\Zed\PriceProductCustomerGroupStorage\Persistence\Mapper\PriceProductCustomerGroup\PriceProductCustomerGroupMapper;
use ValanticSpryker\Zed\PriceProductCustomerGroupStorage\PriceProductCustomerGroupStorageDependencyProvider;

/**
 * @method \ValanticSpryker\Zed\PriceProductCustomerGroupStorage\PriceProductCustomerGroupStorageConfig getConfig()
 * @method \ValanticSpryker\Zed\PriceProductCustomerGroupStorage\Persistence\PriceProductCustomerGroupStorageEntityManagerInterface getEntityManager()
 * @method \ValanticSpryker\Zed\PriceProductCustomerGroupStorage\Persistence\PriceProductCustomerGroupStorageRepositoryInterface getRepository()
 */
class PriceProductCustomerGroupStoragePersistenceFactory extends AbstractPersistenceFactory
{
    /**
     * @return \ValanticSpryker\Zed\PriceProductCustomerGroupStorage\Persistence\Mapper\CustomerGroupPriceProductMapperInterface
     */
    public function createCustomerGroupPriceProductMapper(): CustomerGroupPriceProductMapperInterface
    {
        return new CustomerGroupPriceProductMapper();
    }

    /**
     * @return \Orm\Zed\PriceProductCustomerGroupStorage\Persistence\VsyPriceProductCustomerGroupQuery
     */
    public function getPropelPriceProductCustomerGroupQuery(): VsyPriceProductCustomerGroupQuery
    {
        return $this->getProvidedDependency(PriceProductCustomerGroupStorageDependencyProvider::PROPEL_QUERY_PRICE_PRODUCT_CUSTOMER_GROUP);
    }

    /**
     * @return \Orm\Zed\PriceProductCustomerGroupStorage\Persistence\VsyPriceProductConcreteCustomerGroupStorageQuery
     */
    public function createPriceProductConcreteCustomerGroupStorageQuery(): VsyPriceProductConcreteCustomerGroupStorageQuery
    {
        return VsyPriceProductConcreteCustomerGroupStorageQuery::create();
    }

    /**
     * @return \Orm\Zed\PriceProductCustomerGroupStorage\Persistence\VsyPriceProductAbstractCustomerGroupStorageQuery
     */
    public function createPriceProductAbstractCustomerGroupStorageQuery(): VsyPriceProductAbstractCustomerGroupStorageQuery
    {
        return VsyPriceProductAbstractCustomerGroupStorageQuery::create();
    }

    /**
     * @return \ValanticSpryker\Zed\PriceProductCustomerGroupStorage\Persistence\Mapper\PriceProductCustomerGroup\PriceProductCustomerGroupMapper
     */
    public function createPriceProductCustomerGroupMapper(): PriceProductCustomerGroupMapper
    {
        return new PriceProductCustomerGroupMapper();
    }
}

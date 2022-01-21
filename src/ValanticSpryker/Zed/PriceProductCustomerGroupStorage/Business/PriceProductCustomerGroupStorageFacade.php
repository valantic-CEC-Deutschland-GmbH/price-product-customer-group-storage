<?php

declare(strict_types = 1);

namespace ValanticSpryker\Zed\PriceProductCustomerGroupStorage\Business;

use Spryker\Zed\Kernel\Business\AbstractFacade;

/**
 * @method \ValanticSpryker\Zed\PriceProductCustomerGroupStorage\Persistence\PriceProductCustomerGroupStorageEntityManagerInterface getEntityManager()
 * @method \ValanticSpryker\Zed\PriceProductCustomerGroupStorage\Business\PriceProductCustomerGroupStorageBusinessFactory getFactory()
 * @method \ValanticSpryker\Zed\PriceProductCustomerGroupStorage\Persistence\PriceProductCustomerGroupStorageRepositoryInterface getRepository()
 */
class PriceProductCustomerGroupStorageFacade extends AbstractFacade implements PriceProductCustomerGroupStorageFacadeInterface
{
    /**
     * {@inheritDoc}
     *
     * @api
     *
     * @param array<int> $customerGroupIds
     *
     * @return void
     */
    public function publishAbstractPriceProductByCustomerGroups(array $customerGroupIds): void
    {
        $this->getFactory()
            ->createPriceProductAbstractStorageWriter()
            ->publishByCustomerGroupIds($customerGroupIds);
    }

    /**
     * {@inheritDoc}
     *
     * @api
     *
     * @param array<int> $customerGroupIds
     *
     * @return void
     */
    public function publishConcretePriceProductByCustomerGroups(array $customerGroupIds): void
    {
        $this->getFactory()
            ->createPriceProductConcreteStorageWriter()
            ->publishByCustomerGroupIds($customerGroupIds);
    }

    /**
     * {@inheritDoc}
     *
     * @api
     *
     * @param array<int> $priceProductCustomerGroupIds
     *
     * @return void
     */
    public function publishAbstractPriceProductCustomerGroup(array $priceProductCustomerGroupIds): void
    {
        $this->getFactory()
            ->createPriceProductAbstractStorageWriter()
            ->publishAbstractPriceProductCustomerGroup($priceProductCustomerGroupIds);
    }

    /**
     * {@inheritDoc}
     *
     * @api
     *
     * @param array<int> $productAbstractIds
     *
     * @return void
     */
    public function publishAbstractPriceProductByProductAbstractIds(array $productAbstractIds): void
    {
        $this->getFactory()
            ->createPriceProductAbstractStorageWriter()
            ->publishAbstractPriceProductByProductAbstractIds($productAbstractIds);
    }

    /**
     * {@inheritDoc}
     *
     * @api
     *
     * @param array<int> $priceProductCustomerGroupIds
     *
     * @return void
     */
    public function publishConcretePriceProductCustomerGroup(array $priceProductCustomerGroupIds): void
    {
        $this->getFactory()
            ->createPriceProductConcreteStorageWriter()
            ->publishConcretePriceProductCustomerGroup($priceProductCustomerGroupIds);
    }

    /**
     * {@inheritDoc}
     *
     * @api
     *
     * @param array<int> $productIds
     *
     * @return void
     */
    public function publishConcretePriceProductByProductIds(array $productIds): void
    {
        $this->getFactory()
            ->createPriceProductConcreteStorageWriter()
            ->publishConcretePriceProductByProductIds($productIds);
    }
}

<?php

declare(strict_types = 1);

namespace ValanticSpryker\Zed\PriceProductCustomerGroupStorage\Business;

/**
 * @method \ValanticSpryker\Zed\PriceProductCustomerGroupStorage\Persistence\PriceProductCustomerGroupStorageEntityManagerInterface getEntityManager()
 * @method \ValanticSpryker\Zed\PriceProductCustomerGroupStorage\Business\PriceProductCustomerGroupStorageBusinessFactory getFactory()
 */
interface PriceProductCustomerGroupStorageFacadeInterface
{
    /**
     * Specification:
     *  - Publish customer group prices for product abstracts.
     *  - Uses the given customer group IDs.
     *  - Refreshes the prices data for customer group for all product abstracts.
     *  - Executes `PriceProductCustomerGroupStorageFilterPluginInterface` plugin stack.
     *
     * @api
     *
     * @param array<int> $customerGroupIds
     *
     * @return void
     */
    public function publishAbstractPriceProductByCustomerGroups(array $customerGroupIds): void;

    /**
     * Specification:
     *  - Publish customer group prices for product concretes.
     *  - Uses the given customer group IDs.
     *  - Refreshes the prices data for customer group for all product concretes.
     *  - Executes `PriceProductCustomerGroupStorageFilterPluginInterface` plugin stack.
     *
     * @api
     *
     * @param array<int> $customerGroupIds
     *
     * @return void
     */
    public function publishConcretePriceProductByCustomerGroups(array $customerGroupIds): void;

    /**
     * Specification:
     *  - Publish customer group prices for product abstracts.
     *  - Uses the given IDs of the `vsy_price_product_customer_group` table.
     *  - Merges created or updated prices to the existing ones.
     *  - Executes `PriceProductCustomerGroupStorageFilterPluginInterface` plugin stack.
     *
     * @api
     *
     * @param array<int> $priceProductCustomerGroupIds
     *
     * @return void
     */
    public function publishAbstractPriceProductCustomerGroup(array $priceProductCustomerGroupIds): void;

    /**
     * Specification:
     *  - Publish customer group prices for product abstracts.
     *  - Uses the given abstract product IDs.
     *  - Refreshes the prices data for product abstracts for all customer groups.
     *  - Executes `PriceProductCustomerGroupStorageFilterPluginInterface` plugin stack.
     *
     * @api
     *
     * @param array<int> $productAbstractIds
     *
     * @return void
     */
    public function publishAbstractPriceProductByProductAbstractIds(array $productAbstractIds): void;

    /**
     * Specification:
     *  - Publish customer group prices for product concretes.
     *  - Uses the given IDs of the `vsy_price_product_customer_group` table.
     *  - Merges created or updated prices to the existing ones.
     *  - Executes `PriceProductCustomerGroupStorageFilterPluginInterface` plugin stack.
     *
     * @api
     *
     * @param array<int> $priceProductCustomerGroupIds
     *
     * @return void
     */
    public function publishConcretePriceProductCustomerGroup(array $priceProductCustomerGroupIds): void;

    /**
     * Specification:
     *  - Publish customer group prices for product concretes.
     *  - Uses the given concrete product IDs.
     *  - Refreshes the prices data for product concretes for all customer groups.
     *  - Executes `PriceProductCustomerGroupStorageFilterPluginInterface` plugin stack.
     *
     * @api
     *
     * @param array<int> $productIds
     *
     * @return void
     */
    public function publishConcretePriceProductByProductIds(array $productIds): void;
}

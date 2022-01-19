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
     *  - Uses the given customer group unit IDs.
     *  - Refreshes the prices data for customer groups for all product abstracts and customer groups.
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
     *  - Uses the given company business unit IDs.
     *  - Refreshes the prices data for business units for all product concretes and customer groups.
     *  - Executes `PriceProductCustomerGroupStorageFilterPluginInterface` plugin stack.
     *
     * @api
     *
     * @param array<int> $customerGroupIds
     *
     * @return void
     */
    public function publishConcretePriceProductByBusinessUnits(array $customerGroupIds): void;

    /**
     * Specification:
     *  - Publish customer group prices for product abstracts.
     *  - Uses the given IDs of the `spy_price_product_merchant_relationship` table.
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
     *  - Refreshes the prices data for product abstracts for all business units and customer groups.
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
     *  - Uses the given IDs of the `spy_price_product_merchant_relationship` table.
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
     *  - Refreshes the prices data for product concretes for all business units and customer groups.
     *  - Executes `PriceProductCustomerGroupStorageFilterPluginInterface` plugin stack.
     *
     * @api
     *
     * @param array<int> $productIds
     *
     * @return void
     */
    public function publishConcretePriceProductByProductIds(array $productIds): void;

    /**
     * Specification:
     *  - Publishes customer group prices for product concretes and abstracts when merchant active changing.
     *  - Refreshes the prices data for products for business units, customer groups and merchants from eventEntityTransfers.
     *  - Deletes the product prices from storage for business units, customer groups if merchant is deactivated.
     *  - Executes `PriceProductCustomerGroupStorageFilterPluginInterface` plugin stack.
     *
     * @api
     *
     * @param array<\Generated\Shared\Transfer\EventEntityTransfer> $eventEntityTransfers
     *
     * @return void
     */
    public function writeCollectionByMerchantEvents(array $eventEntityTransfers): void;
}

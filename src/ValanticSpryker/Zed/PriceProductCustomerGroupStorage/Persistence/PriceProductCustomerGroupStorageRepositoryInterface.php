<?php

declare(strict_types = 1);

namespace ValanticSpryker\Zed\PriceProductCustomerGroupStorage\Persistence;

use Generated\Shared\Transfer\FilterTransfer;

/**
 * @method \ValanticSpryker\Zed\PriceProductCustomerGroupStorage\Persistence\PriceProductCustomerGroupStoragePersistenceFactory getFactory()
 */
interface PriceProductCustomerGroupStorageRepositoryInterface
{
    /**
     * @param array<int> $customerGroupIds
     *
     * @return array<\Generated\Shared\Transfer\PriceProductCustomerGroupStorageTransfer>
     */
    public function findCustomerGroupProductAbstractPricesDataByCustomerGroupIds(array $customerGroupIds): array;

    /**
     * @param array<int> $customerGroupIds
     *
     * @return array<\Generated\Shared\Transfer\PriceProductCustomerGroupStorageTransfer>
     */
    public function findCustomerGroupProductConcretePricesDataByCustomerGroupIds(array $customerGroupIds): array;

    /**
     * @param array<int> $priceProductCustomerGroupIds
     *
     * @return array<\Generated\Shared\Transfer\PriceProductCustomerGroupStorageTransfer>
     */
    public function findCustomerGroupProductConcretePricesDataByIds(array $priceProductCustomerGroupIds): array;

    /**
     * @param array<int> $productIds
     *
     * @return array<\Generated\Shared\Transfer\PriceProductCustomerGroupStorageTransfer>
     */
    public function findCustomerGroupProductConcretePricesDataByProductIds(array $productIds): array;

    /**
     * @param array<int> $priceProductCustomerGroupIds
     *
     * @return array<\Generated\Shared\Transfer\PriceProductCustomerGroupStorageTransfer>
     */
    public function findCustomerGroupProductAbstractPricesByIds(array $priceProductCustomerGroupIds): array;

    /**
     * @param array<int> $productAbstractIds
     *
     * @return array<\Generated\Shared\Transfer\PriceProductCustomerGroupStorageTransfer>
     */
    public function findCustomerGroupProductAbstractPricesDataByProductAbstractIds(array $productAbstractIds): array;

    /**
     * @param array<int> $customerGroupIds
     *
     * @return array<\Orm\Zed\PriceProductCustomerGroupStorage\Persistence\VsyPriceProductAbstractCustomerGroupStorage>
     */
    public function findExistingPriceProductAbstractCustomerGroupEntitiesByCustomerGroupIds(array $customerGroupIds): array;

    /**
     * @param array<string> $priceKeys
     *
     * @return array<\Orm\Zed\PriceProductCustomerGroupStorage\Persistence\VsyPriceProductAbstractCustomerGroupStorage>
     */
    public function findExistingPriceProductAbstractCustomerGroupEntitiesByPriceKeys(array $priceKeys): array;

    /**
     * @param array<int> $productAbstractIds
     *
     * @return array<\Orm\Zed\PriceProductCustomerGroupStorage\Persistence\VsyPriceProductAbstractCustomerGroupStorage>
     */
    public function findExistingPriceProductAbstractCustomerGroupEntitiesByProductAbstractIds(array $productAbstractIds): array;

    /**
     * @param array<int> $customerGroupIds
     *
     * @return array<\Orm\Zed\PriceProductCustomerGroupStorage\Persistence\VsyPriceProductConcreteCustomerGroupStorage>
     */
    public function findExistingPriceProductConcreteCustomerGroupEntitiesByCustomerGroupIds(array $customerGroupIds): array;

    /**
     * @param array<string> $priceKeys
     *
     * @return array<\Orm\Zed\PriceProductCustomerGroupStorage\Persistence\VsyPriceProductConcreteCustomerGroupStorage>
     */
    public function findExistingPriceProductConcreteCustomerGroupEntitiesByPriceKeys(array $priceKeys): array;

    /**
     * @param array<int> $productIds
     *
     * @return array<\Orm\Zed\PriceProductCustomerGroupStorage\Persistence\VsyPriceProductConcreteCustomerGroupStorage>
     */
    public function findExistingPriceProductConcreteCustomerGroupEntitiesByProductIds(array $productIds): array;

    /**
     * @return array
     */
    public function findAllPriceProductConcreteCustomerGroupStorageEntities(): array;

    /**
     * @param array $priceProductConcreteCustomerGroupStorageEntityIds
     *
     * @return array
     */
    public function findPriceProductConcreteCustomerGroupStorageEntitiesByIds(array $priceProductConcreteCustomerGroupStorageEntityIds): array;

    /**
     * @return array
     */
    public function findAllPriceProductAbstractCustomerGroupStorageEntities(): array;

    /**
     * @param array $priceProductAbstractCustomerGroupStorageEntityIds
     *
     * @return array
     */
    public function findPriceProductAbstractCustomerGroupStorageEntitiesByIds(array $priceProductAbstractCustomerGroupStorageEntityIds): array;

    /**
     * @param \Generated\Shared\Transfer\FilterTransfer $filterTransfer
     * @param array<int> $priceProductConcreteCustomerGroupStorageIds
     *
     * @return array<\Generated\Shared\Transfer\VsyPriceProductConcreteCustomerGroupStorageEntityTransfer>
     */
    public function findFilteredPriceProductConcreteCustomerGroupStorageEntities(
        FilterTransfer $filterTransfer,
        array $priceProductConcreteCustomerGroupStorageIds = []
    ): array;

    /**
     * @param \Generated\Shared\Transfer\FilterTransfer $filterTransfer
     * @param array<int> $priceProductAbstractCustomerGroupStorageIds
     *
     * @return array<\Generated\Shared\Transfer\VsyPriceProductAbstractCustomerGroupStorageEntityTransfer>
     */
    public function findFilteredPriceProductAbstractCustomerGroupStorageEntities(
        FilterTransfer $filterTransfer,
        array $priceProductAbstractCustomerGroupStorageIds = []
    ): array;

    /**
     * @param \Generated\Shared\Transfer\FilterTransfer $filterTransfer
     *
     * @return array<\Generated\Shared\Transfer\PriceProductCustomerGroupTransfer>
     */
    public function getFilteredPriceProductConcreteCustomerGroups(FilterTransfer $filterTransfer): array;

    /**
     * @param \Generated\Shared\Transfer\FilterTransfer $filterTransfer
     *
     * @return array<\Generated\Shared\Transfer\PriceProductCustomerGroupTransfer>
     */
    public function getFilteredPriceProductAbstractCustomerGroups(FilterTransfer $filterTransfer): array;
}

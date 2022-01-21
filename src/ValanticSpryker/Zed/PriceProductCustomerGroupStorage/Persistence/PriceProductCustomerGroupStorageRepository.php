<?php

declare(strict_types = 1);

namespace ValanticSpryker\Zed\PriceProductCustomerGroupStorage\Persistence;

use Generated\Shared\Transfer\FilterTransfer;
use Orm\Zed\PriceProductCustomerGroup\Persistence\VsyPriceProductCustomerGroupQuery;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveQuery\ModelCriteria;
use Spryker\Zed\Kernel\Persistence\AbstractRepository;
use Spryker\Zed\PropelOrm\Business\Model\Formatter\PropelArraySetFormatter;

/**
 * @method \ValanticSpryker\Zed\PriceProductCustomerGroupStorage\Persistence\PriceProductCustomerGroupStoragePersistenceFactory getFactory()
 */
class PriceProductCustomerGroupStorageRepository extends AbstractRepository implements PriceProductCustomerGroupStorageRepositoryInterface
{
    /**
     * @param array<int> $customerGroupIds
     *
     * @return array<\Generated\Shared\Transfer\PriceProductCustomerGroupStorageTransfer>
     */
    public function findCustomerGroupProductAbstractPricesDataBycustomerGroupIds(array $customerGroupIds): array
    {
        $priceProductCustomerGroupsQuery = $this->queryPriceProductCustomerGroup($customerGroupIds)
            ->filterByFkProductAbstract(null, Criteria::ISNOTNULL);

        $priceProductCustomerGroups = $this->withPriceProductAbstractData($priceProductCustomerGroupsQuery)
            ->setFormatter(new PropelArraySetFormatter())
            ->find();

        return $this->getFactory()
            ->createCustomerGroupPriceProductMapper()
            ->mapPriceProductCustomerGroupArrayToTransfers(
                $priceProductCustomerGroups,
            );
    }

    /**
     * @param array<int> $customerGroupIds
     *
     * @return array<\Generated\Shared\Transfer\PriceProductCustomerGroupStorageTransfer>
     */
    public function findCustomerGroupProductConcretePricesDataBycustomerGroupIds(array $customerGroupIds): array
    {
        $priceProductCustomerGroupsQuery = $this->queryPriceProductCustomerGroup($customerGroupIds)
            ->filterByFkProduct(null, Criteria::ISNOTNULL);

        $priceProductCustomerGroups = $this->withPriceProductConcreteData($priceProductCustomerGroupsQuery)
            ->setFormatter(new PropelArraySetFormatter())
            ->find();

        return $this->getFactory()
            ->createcustomerGroupPriceProductMapper()
            ->mapPriceProductCustomerGroupArrayToTransfers(
                $priceProductCustomerGroups,
            );
    }

    /**
     * @param array<int> $priceProductCustomerGroupIds
     *
     * @return array<\Generated\Shared\Transfer\PriceProductCustomerGroupStorageTransfer>
     */
    public function findCustomerGroupProductConcretePricesDataByIds(array $priceProductCustomerGroupIds): array
    {
        $priceProductCustomerGroupsQuery = $this->queryPriceProductCustomerGroup()
            ->filterByIdPriceProductCustomerGroup_In($priceProductCustomerGroupIds)
            ->filterByFkProduct(null, Criteria::ISNOTNULL);

        $priceProductCustomerGroups = $this->withPriceProductConcreteData($priceProductCustomerGroupsQuery)
            ->setFormatter(new PropelArraySetFormatter())
            ->find();

        return $this->getFactory()
            ->createcustomerGroupPriceProductMapper()
            ->mapPriceProductCustomerGroupArrayToTransfers(
                $priceProductCustomerGroups,
            );
    }

    /**
     * @param array<int> $productIds
     *
     * @return array<\Generated\Shared\Transfer\PriceProductCustomerGroupStorageTransfer>
     */
    public function findCustomerGroupProductConcretePricesDataByProductIds(array $productIds): array
    {
        $priceProductCustomerGroupsQuery = $this->queryPriceProductCustomerGroup()
            ->filterByFkProduct_In($productIds);

        $priceProductCustomerGroups = $this->withPriceProductConcreteData($priceProductCustomerGroupsQuery)
            ->setFormatter(new PropelArraySetFormatter())
            ->find();

        return $this->getFactory()
            ->createcustomerGroupPriceProductMapper()
            ->mapPriceProductCustomerGroupArrayToTransfers(
                $priceProductCustomerGroups,
            );
    }

    /**
     * @param array<int> $priceProductCustomerGroupIds
     *
     * @return array<\Generated\Shared\Transfer\PriceProductCustomerGroupStorageTransfer>
     */
    public function findCustomerGroupProductAbstractPricesByIds(array $priceProductCustomerGroupIds): array
    {
        $priceProductCustomerGroupsQuery = $this->queryPriceProductCustomerGroup()
            ->filterByIdPriceProductCustomerGroup_In($priceProductCustomerGroupIds)
            ->filterByFkProductAbstract(null, Criteria::ISNOTNULL);

        $priceProductCustomerGroups = $this->withPriceProductAbstractData($priceProductCustomerGroupsQuery)
            ->setFormatter(new PropelArraySetFormatter())
            ->find();

        return $this->getFactory()
            ->createcustomerGroupPriceProductMapper()
            ->mapPriceProductCustomerGroupArrayToTransfers(
                $priceProductCustomerGroups,
            );
    }

    /**
     * @param array<int> $productAbstractIds
     *
     * @return array<\Generated\Shared\Transfer\PriceProductCustomerGroupStorageTransfer>
     */
    public function findCustomerGroupProductAbstractPricesDataByProductAbstractIds(array $productAbstractIds): array
    {
        $priceProductCustomerGroupsQuery = $this->queryPriceProductCustomerGroup()
            ->filterByFkProductAbstract_In($productAbstractIds);

        $priceProductCustomerGroups = $this->withPriceProductAbstractData($priceProductCustomerGroupsQuery)
            ->setFormatter(new PropelArraySetFormatter())
            ->find();

        return $this->getFactory()
            ->createcustomerGroupPriceProductMapper()
            ->mapPriceProductCustomerGroupArrayToTransfers(
                $priceProductCustomerGroups,
            );
    }

    /**
     * @param array<int> $customerGroupIds
     *
     * @return array<\Orm\Zed\PriceProductCustomerGroupStorage\Persistence\VsyPriceProductAbstractCustomerGroupStorage>
     */
    public function findExistingPriceProductAbstractCustomerGroupEntitiesBycustomerGroupIds(array $customerGroupIds): array
    {
        return $this->getFactory()
            ->createPriceProductAbstractCustomerGroupStorageQuery()
            ->filterByFkCustomerGroup_In($customerGroupIds)
            ->find()
            ->getData();
    }

    /**
     * @param array<string> $priceKeys
     *
     * @return array<\Orm\Zed\PriceProductCustomerGroupStorage\Persistence\VsyPriceProductAbstractCustomerGroupStorage>
     */
    public function findExistingPriceProductAbstractCustomerGroupEntitiesByPriceKeys(array $priceKeys): array
    {
        return $this->getFactory()
            ->createPriceProductAbstractCustomerGroupStorageQuery()
            ->filterByPriceKey_In($priceKeys)
            ->find()
            ->getData();
    }

    /**
     * @param array<int> $productAbstractIds
     *
     * @return array<\Orm\Zed\PriceProductCustomerGroupStorage\Persistence\VsyPriceProductAbstractCustomerGroupStorage>
     */
    public function findExistingPriceProductAbstractCustomerGroupEntitiesByProductAbstractIds(array $productAbstractIds): array
    {
        return $this->getFactory()
            ->createPriceProductAbstractCustomerGroupStorageQuery()
            ->filterByFkProductAbstract_In($productAbstractIds)
            ->find()
            ->getData();
    }

    /**
     * @param array<int> $customerGroupIds
     *
     * @return array<\Orm\Zed\PriceProductCustomerGroupStorage\Persistence\VsyPriceProductConcreteCustomerGroupStorage>
     */
    public function findExistingPriceProductConcreteCustomerGroupEntitiesBycustomerGroupIds(array $customerGroupIds): array
    {
        return $this->getFactory()
            ->createPriceProductConcreteCustomerGroupStorageQuery()
            ->filterByFkCustomerGroup_In($customerGroupIds)
            ->find()
            ->getData();
    }

    /**
     * @param array<string> $priceKeys
     *
     * @return array<\Orm\Zed\PriceProductCustomerGroupStorage\Persistence\VsyPriceProductConcreteCustomerGroupStorage>
     */
    public function findExistingPriceProductConcreteCustomerGroupEntitiesByPriceKeys(array $priceKeys): array
    {
        return $this->getFactory()
            ->createPriceProductConcreteCustomerGroupStorageQuery()
            ->filterByPriceKey_In($priceKeys)
            ->find()
            ->getData();
    }

    /**
     * @param array<int> $productIds
     *
     * @return array<\Orm\Zed\PriceProductCustomerGroupStorage\Persistence\VsyPriceProductConcreteCustomerGroupStorage>
     */
    public function findExistingPriceProductConcreteCustomerGroupEntitiesByProductIds(array $productIds): array
    {
        return $this->getFactory()
            ->createPriceProductConcreteCustomerGroupStorageQuery()
            ->filterByFkProduct_In($productIds)
            ->find()
            ->getData();
    }

    /**
     * @return array<\Orm\Zed\PriceProductCustomerGroupStorage\Persistence\VsyPriceProductConcreteCustomerGroupStorage>
     */
    public function findAllPriceProductConcreteCustomerGroupStorageEntities(): array
    {
        return $this->getFactory()
            ->createPriceProductConcreteCustomerGroupStorageQuery()
            ->find()
            ->getArrayCopy();
    }

    /**
     * @param array $priceProductConcreteCustomerGroupStorageEntityIds
     *
     * @return array<\Orm\Zed\PriceProductCustomerGroupStorage\Persistence\VsyPriceProductConcreteCustomerGroupStorage>
     */
    public function findPriceProductConcreteCustomerGroupStorageEntitiesByIds(array $priceProductConcreteCustomerGroupStorageEntityIds): array
    {
        return $this->getFactory()
            ->createPriceProductConcreteCustomerGroupStorageQuery()
            ->filterByIdPriceProductConcreteCustomerGroupStorage_In($priceProductConcreteCustomerGroupStorageEntityIds)
            ->find()
            ->getArrayCopy();
    }

    /**
     * @return array<\Orm\Zed\PriceProductCustomerGroupStorage\Persistence\VsyPriceProductAbstractCustomerGroupStorage>
     */
    public function findAllPriceProductAbstractCustomerGroupStorageEntities(): array
    {
        return $this->getFactory()
            ->createPriceProductAbstractCustomerGroupStorageQuery()
            ->find()
            ->getArrayCopy();
    }

    /**
     * @param array $priceProductAbstractCustomerGroupStorageEntityIds
     *
     * @return array<\Orm\Zed\PriceProductCustomerGroupStorage\Persistence\VsyPriceProductAbstractCustomerGroupStorage>
     */
    public function findPriceProductAbstractCustomerGroupStorageEntitiesByIds(array $priceProductAbstractCustomerGroupStorageEntityIds): array
    {
        return $this->getFactory()
            ->createPriceProductAbstractCustomerGroupStorageQuery()
            ->filterByIdPriceProductAbstractCustomerGroupStorage_In($priceProductAbstractCustomerGroupStorageEntityIds)
            ->find()
            ->getArrayCopy();
    }

    /**
     * @module Store
     * @module Currency
     * @module PriceProduct
     * @module CustomerGroup
     * @module PriceProductCustomerGroup
     *
     * @param array $filterBycustomerGroupIds
     *
     * @return \Orm\Zed\PriceProductCustomerGroup\Persistence\VsyPriceProductCustomerGroupQuery
     */
    protected function queryPriceProductCustomerGroup(array $filterBycustomerGroupIds = []): VsyPriceProductCustomerGroupQuery
    {
        return $this->getFactory()
            ->getPropelPriceProductCustomerGroupQuery()
            ->usePriceProductStoreQuery()
            ->innerJoinStore()
            ->innerJoinCurrency()
            ->usePriceProductQuery()
            ->innerJoinPriceType()
            ->endUse()
            ->endUse()
            ->useCustomerGroupQuery()
            ->useSpyCustomerGroupToCustomerQuery()
            ->_if((bool)$filterBycustomerGroupIds)
            ->filterByFkCustomerGroup_In($filterBycustomerGroupIds)
            ->_endif()
            ->endUse()
            ->endUse();
    }

    /**
     * @param \Propel\Runtime\ActiveQuery\ModelCriteria $modelCriteria
     *
     * @return \Propel\Runtime\ActiveQuery\ModelCriteria
     */
    protected function withPriceProductAbstractData(ModelCriteria $modelCriteria): ModelCriteria
    {
        return $this->withPriceProductData($modelCriteria)
            ->withColumn(VsyPriceProductCustomerGroupTableMap::COL_FK_PRODUCT_ABSTRACT, PriceProductCustomerGroupStorageTransfer::ID_PRODUCT)
            ->withColumn(VsyCustomerGroupTableMap::COL_FK_MERCHANT, PriceProductCustomerGroupValueTransfer::FK_MERCHANT);
    }

    /**
     * @param \Propel\Runtime\ActiveQuery\ModelCriteria $modelCriteria
     *
     * @return \Propel\Runtime\ActiveQuery\ModelCriteria
     */
    protected function withPriceProductConcreteData(ModelCriteria $modelCriteria): ModelCriteria
    {
        return $this->withPriceProductData($modelCriteria)
            ->withColumn(VsyPriceProductCustomerGroupTableMap::COL_FK_PRODUCT, PriceProductCustomerGroupStorageTransfer::ID_PRODUCT)
            ->withColumn(VsyCustomerGroupTableMap::COL_FK_MERCHANT, PriceProductCustomerGroupValueTransfer::FK_MERCHANT);
    }

    /**
     * @module Store
     * @module Currency
     * @module PriceProduct
     * @module CustomerGroup
     * @module PriceProductCustomerGroup
     *
     * @param \Propel\Runtime\ActiveQuery\ModelCriteria $modelCriteria
     *
     * @return \Propel\Runtime\ActiveQuery\ModelCriteria
     */
    protected function withPriceProductData(ModelCriteria $modelCriteria): ModelCriteria
    {
        return $modelCriteria
            ->withColumn(VsyStoreTableMap::COL_NAME, PriceProductCustomerGroupStorageTransfer::STORE_NAME)
            ->withColumn(VsyCurrencyTableMap::COL_CODE, PriceProductCustomerGroupValueTransfer::CURRENCY_CODE)
            ->withColumn(VsyCustomerGroupTocustomerGroupTableMap::COL_FK_COMPANY_BUSINESS_UNIT, PriceProductCustomerGroupStorageTransfer::ID_COMPANY_BUSINESS_UNIT)
            ->withColumn(VsyCustomerGroupTocustomerGroupTableMap::COL_FK_MERCHANT_RELATIONSHIP, PriceProductCustomerGroupValueTransfer::ID_MERCHANT_RELATIONSHIP)
            ->withColumn(VsyPriceTypeTableMap::COL_NAME, PriceProductCustomerGroupValueTransfer::PRICE_TYPE)
            ->withColumn(VsyPriceProductStoreTableMap::COL_PRICE_DATA, PriceProductCustomerGroupValueTransfer::PRICE_DATA)
            ->withColumn(VsyPriceProductStoreTableMap::COL_GROSS_PRICE, PriceProductCustomerGroupValueTransfer::GROSS_PRICE)
            ->withColumn(VsyPriceProductStoreTableMap::COL_NET_PRICE, PriceProductCustomerGroupValueTransfer::NET_PRICE);
    }

    /**
     * @param \Generated\Shared\Transfer\FilterTransfer $filterTransfer
     * @param array<int> $priceProductConcreteCustomerGroupStorageIds
     *
     * @return array<\Generated\Shared\Transfer\VsyPriceProductConcreteCustomerGroupStorageEntityTransfer>
     */
    public function findFilteredPriceProductConcreteCustomerGroupStorageEntities(
        FilterTransfer $filterTransfer,
        array $priceProductConcreteCustomerGroupStorageIds = []
    ): array {
        $query = $this->getFactory()->createPriceProductConcreteCustomerGroupStorageQuery();

        if ($priceProductConcreteCustomerGroupStorageIds) {
            $query->filterByIdPriceProductConcreteCustomerGroupStorage_In($priceProductConcreteCustomerGroupStorageIds);
        }

        return $this->buildQueryFromCriteria($query, $filterTransfer)->find();
    }

    /**
     * @param \Generated\Shared\Transfer\FilterTransfer $filterTransfer
     * @param array<int> $priceProductAbstractCustomerGroupStorageIds
     *
     * @return array<\Generated\Shared\Transfer\VsyPriceProductAbstractCustomerGroupStorageEntityTransfer>
     */
    public function findFilteredPriceProductAbstractCustomerGroupStorageEntities(
        FilterTransfer $filterTransfer,
        array $priceProductAbstractCustomerGroupStorageIds = []
    ): array {
        $query = $this->getFactory()->createPriceProductAbstractCustomerGroupStorageQuery();

        if ($priceProductAbstractCustomerGroupStorageIds) {
            $query->filterByIdPriceProductAbstractCustomerGroupStorage_In($priceProductAbstractCustomerGroupStorageIds);
        }

        return $this->buildQueryFromCriteria($query, $filterTransfer)->find();
    }

    /**
     * @param \Generated\Shared\Transfer\FilterTransfer $filterTransfer
     *
     * @return array<\Generated\Shared\Transfer\PriceProductCustomerGroupTransfer>
     */
    public function getFilteredPriceProductConcreteCustomerGroups(FilterTransfer $filterTransfer): array
    {
        $priceProductCustomerGroupQuery = $this->queryPriceProductCustomerGroup()
            ->filterByFkProduct(null, Criteria::ISNOTNULL);

        $priceProductCustomerGroupEntityTransfers = $this->buildQueryFromCriteria($priceProductCustomerGroupQuery, $filterTransfer)
            ->setFormatter(ModelCriteria::FORMAT_OBJECT)
            ->find();

        return $this->getFactory()
            ->createPriceProductCustomerGroupMapper()
            ->mapEntitiesToPriceProductCustomerGroupTransferCollection(
                $priceProductCustomerGroupEntityTransfers->getData(),
            );
    }

    /**
     * @param \Generated\Shared\Transfer\FilterTransfer $filterTransfer
     *
     * @return array<\Generated\Shared\Transfer\PriceProductCustomerGroupTransfer>
     */
    public function getFilteredPriceProductAbstractCustomerGroups(FilterTransfer $filterTransfer): array
    {
        $priceProductCustomerGroupQuery = $this->queryPriceProductCustomerGroup()
            ->filterByFkProductAbstract(null, Criteria::ISNOTNULL);

        $priceProductCustomerGroupEntityTransfers = $this->buildQueryFromCriteria($priceProductCustomerGroupQuery, $filterTransfer)
            ->setFormatter(ModelCriteria::FORMAT_OBJECT)
            ->find();

        return $this->getFactory()
            ->createPriceProductCustomerGroupMapper()
            ->mapEntitiesToPriceProductCustomerGroupTransferCollection(
                $priceProductCustomerGroupEntityTransfers->getData(),
            );
    }
}

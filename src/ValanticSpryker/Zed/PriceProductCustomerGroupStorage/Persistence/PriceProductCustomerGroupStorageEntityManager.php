<?php

declare(strict_types = 1);

namespace ValanticSpryker\Zed\PriceProductCustomerGroupStorage\Persistence;

/**
 * @method \ValanticSpryker\Zed\PriceProductCustomerGroupStorage\Persistence\PriceProductCustomerGroupStoragePersistenceFactory getFactory()
 */
class PriceProductCustomerGroupStorageEntityManager implements PriceProductCustomerGroupStorageEntityManagerInterface
{
    /**
     * @param \Generated\Shared\Transfer\PriceProductCustomerGroupStorageTransfer $priceProductCustomerGroupStorageTransfer
     * @param \Orm\Zed\PriceProductCustomerGroupStorage\Persistence\VsyPriceProductAbstractCustomerGroupStorage $priceProductAbstractCustomerGroupStorageEntity
     *
     * @return void
     */
    public function updatePriceProductAbstract(
        PriceProductCustomerGroupStorageTransfer $priceProductCustomerGroupStorageTransfer,
        VsyPriceProductAbstractCustomerGroupStorage $priceProductAbstractCustomerGroupStorageEntity
    ): void {
        $priceProductAbstractCustomerGroupStorageEntity
            ->setData($priceProductCustomerGroupStorageTransfer->getPrices())
            ->setIsSendingToQueue($this->getFactory()->getConfig()->isSendingToQueue())
            ->save();
    }

    /**
     * @param \Generated\Shared\Transfer\PriceProductCustomerGroupStorageTransfer $priceProductCustomerGroupStorageTransfer
     *
     * @return void
     */
    public function createPriceProductAbstract(
        PriceProductCustomerGroupStorageTransfer $priceProductCustomerGroupStorageTransfer
    ): void {
        (new VsyPriceProductAbstractCustomerGroupStorage())
            ->setFkProductAbstract($priceProductCustomerGroupStorageTransfer->getIdProduct())
            ->setFkCustomerGroup($priceProductCustomerGroupStorageTransfer->getIdCustomerGroup())
            ->setPriceKey($priceProductCustomerGroupStorageTransfer->getPriceKey())
            ->setData($priceProductCustomerGroupStorageTransfer->getPrices())
            ->setIsSendingToQueue($this->getFactory()->getConfig()->isSendingToQueue())
            ->save();
    }

    /**
     * @param array<\Orm\Zed\PriceProductCustomerGroupStorage\Persistence\VsyPriceProductAbstractCustomerGroupStorage> $priceProductAbstractCustomerGroupStorageEntities
     *
     * @return void
     */
    public function deletePriceProductAbstractEntities(
        array $priceProductAbstractCustomerGroupStorageEntities
    ): void {
        $storageEntityIds = [];
        foreach ($priceProductAbstractCustomerGroupStorageEntities as $priceProductAbstractCustomerGroupStorageEntity) {
            $storageEntityIds[] = $priceProductAbstractCustomerGroupStorageEntity->getIdPriceProductAbstractCustomerGroupStorage();
        }

        $this->getFactory()
            ->createPriceProductAbstractCustomerGroupStorageQuery()
            ->filterByIdPriceProductAbstractCustomerGroupStorage_In($storageEntityIds)
            ->find()
            ->delete();
    }

    /**
     * @param \Generated\Shared\Transfer\PriceProductCustomerGroupStorageTransfer $priceProductCustomerGroupStorageTransfer
     * @param \Orm\Zed\PriceProductCustomerGroupStorage\Persistence\VsyPriceProductConcreteCustomerGroupStorage $priceProductConcreteCustomerGroupStorageEntity
     *
     * @return void
     */
    public function updatePriceProductConcrete(
        PriceProductCustomerGroupStorageTransfer $priceProductCustomerGroupStorageTransfer,
        VsyPriceProductConcreteCustomerGroupStorage $priceProductConcreteCustomerGroupStorageEntity
    ): void {
        $priceProductConcreteCustomerGroupStorageEntity
            ->setData($priceProductCustomerGroupStorageTransfer->getPrices())
            ->setIsSendingToQueue($this->getFactory()->getConfig()->isSendingToQueue())
            ->save();
    }

    /**
     * @param \Generated\Shared\Transfer\PriceProductCustomerGroupStorageTransfer $priceProductCustomerGroupStorageTransfer
     *
     * @return void
     */
    public function createPriceProductConcrete(
        PriceProductCustomerGroupStorageTransfer $priceProductCustomerGroupStorageTransfer
    ): void {
        (new VsyPriceProductConcreteCustomerGroupStorage())
            ->setFkProduct($priceProductCustomerGroupStorageTransfer->getIdProduct())
            ->setFkCustomerGroup($priceProductCustomerGroupStorageTransfer->getIdCustomerGroup())
            ->setPriceKey($priceProductCustomerGroupStorageTransfer->getPriceKey())
            ->setData($priceProductCustomerGroupStorageTransfer->getPrices())
            ->setIsSendingToQueue($this->getFactory()->getConfig()->isSendingToQueue())
            ->save();
    }

    /**
     * @param array<\Orm\Zed\PriceProductCustomerGroupStorage\Persistence\VsyPriceProductConcreteCustomerGroupStorage> $priceProductConcreteCustomerGroupStorageEntities
     *
     * @return void
     */
    public function deletePriceProductConcreteEntities(
        array $priceProductConcreteCustomerGroupStorageEntities
    ): void {
        $storageEntityIds = [];
        foreach ($priceProductConcreteCustomerGroupStorageEntities as $priceProductConcreteCustomerGroupStorageEntity) {
            $storageEntityIds[] = $priceProductConcreteCustomerGroupStorageEntity->getIdPriceProductConcreteCustomerGroupStorage();
        }

        $this->getFactory()
            ->createPriceProductConcreteCustomerGroupStorageQuery()
            ->filterByIdPriceProductConcreteCustomerGroupStorage_In($storageEntityIds)
            ->find()
            ->delete();
    }
}

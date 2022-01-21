<?php

declare(strict_types = 1);

namespace ValanticSpryker\Zed\PriceProductCustomerGroupStorage\Persistence;

use Generated\Shared\Transfer\PriceProductCustomerGroupStorageTransfer;
use Orm\Zed\PriceProductCustomerGroupStorage\Persistence\VsyPriceProductAbstractCustomerGroupStorage;
use Orm\Zed\PriceProductCustomerGroupStorage\Persistence\VsyPriceProductConcreteCustomerGroupStorage;

interface PriceProductCustomerGroupStorageEntityManagerInterface
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
    ): void;

    /**
     * @param \Generated\Shared\Transfer\PriceProductCustomerGroupStorageTransfer $priceProductCustomerGroupStorageTransfer
     *
     * @return void
     */
    public function createPriceProductAbstract(
        PriceProductCustomerGroupStorageTransfer $priceProductCustomerGroupStorageTransfer
    ): void;

    /**
     * @param array<\Orm\Zed\PriceProductCustomerGroupStorage\Persistence\VsyPriceProductAbstractCustomerGroupStorage> $priceProductAbstractCustomerGroupStorageEntities
     *
     * @return void
     */
    public function deletePriceProductAbstractEntities(
        array $priceProductAbstractCustomerGroupStorageEntities
    ): void;

    /**
     * @param \Generated\Shared\Transfer\PriceProductCustomerGroupStorageTransfer $priceProductCustomerGroupStorageTransfer
     * @param \Orm\Zed\PriceProductCustomerGroupStorage\Persistence\VsyPriceProductConcreteCustomerGroupStorage $priceProductConcreteCustomerGroupStorageEntity
     *
     * @return void
     */
    public function updatePriceProductConcrete(
        PriceProductCustomerGroupStorageTransfer $priceProductCustomerGroupStorageTransfer,
        VsyPriceProductConcreteCustomerGroupStorage $priceProductConcreteCustomerGroupStorageEntity
    ): void;

    /**
     * @param \Generated\Shared\Transfer\PriceProductCustomerGroupStorageTransfer $priceProductCustomerGroupStorageTransfer
     *
     * @return void
     */
    public function createPriceProductConcrete(
        PriceProductCustomerGroupStorageTransfer $priceProductCustomerGroupStorageTransfer
    ): void;

    /**
     * @param array<\Orm\Zed\PriceProductCustomerGroupStorage\Persistence\VsyPriceProductConcreteCustomerGroupStorage> $priceProductConcreteCustomerGroupStorageEntities
     *
     * @return void
     */
    public function deletePriceProductConcreteEntities(
        array $priceProductConcreteCustomerGroupStorageEntities
    ): void;
}

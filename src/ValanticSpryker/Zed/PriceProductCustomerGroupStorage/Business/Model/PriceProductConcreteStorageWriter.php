<?php

declare(strict_types = 1);

namespace ValanticSpryker\Zed\PriceProductCustomerGroupStorage\Business\Model;

class PriceProductConcreteStorageWriter extends AbstractPriceProductCustomerGroupStorageWriter implements PriceProductConcreteStorageWriterInterface
{
    /**
     * @param array<int> $customerGroupIds
     *
     * @return void
     */
    public function publishByCustomerGroupIds(array $customerGroupIds): void
    {
        $priceProductCustomerGroupStorageTransfers = $this->priceProductCustomerGroupStorageRepository
            ->findCustomerGroupProductConcretePricesDataByCustomerGroupIds($customerGroupIds);

        $existingStorageEntities = $this->priceProductCustomerGroupStorageRepository
            ->findExistingPriceProductConcreteCustomerGroupEntitiesByCustomerGroupIds($customerGroupIds);

        $this->write($priceProductCustomerGroupStorageTransfers, $existingStorageEntities);
    }

    /**
     * @param array<int> $priceProductCustomerGroupIds
     *
     * @return void
     */
    public function publishConcretePriceProductCustomerGroup(array $priceProductCustomerGroupIds): void
    {
        $priceProductCustomerGroupStorageTransfers = $this->priceProductCustomerGroupStorageRepository
            ->findCustomerGroupProductConcretePricesDataByIds($priceProductCustomerGroupIds);

        $priceKeys = array_map(function (PriceProductCustomerGroupStorageTransfer $priceProductCustomerGroupStorageTransfer) {
            return $priceProductCustomerGroupStorageTransfer->getPriceKey();
        }, $priceProductCustomerGroupStorageTransfers);

        $existingStorageEntities = $this->priceProductCustomerGroupStorageRepository
            ->findExistingPriceProductConcreteCustomerGroupEntitiesByPriceKeys($priceKeys);

        $this->write($priceProductCustomerGroupStorageTransfers, $existingStorageEntities, true);
    }

    /**
     * @param array<int> $productIds
     *
     * @return void
     */
    public function publishConcretePriceProductByProductIds(array $productIds): void
    {
        $priceProductCustomerGroupStorageTransfers = $this->priceProductCustomerGroupStorageRepository
            ->findCustomerGroupProductConcretePricesDataByProductIds($productIds);

        $existingStorageEntities = $this->priceProductCustomerGroupStorageRepository
            ->findExistingPriceProductConcreteCustomerGroupEntitiesByProductIds($productIds);

        $this->write($priceProductCustomerGroupStorageTransfers, $existingStorageEntities);
    }

    /**
     * @param array<\Generated\Shared\Transfer\PriceProductCustomerGroupStorageTransfer> $priceProductCustomerGroupStorageTransfers
     * @param array<\Orm\Zed\PriceProductCustomerGroupStorage\Persistence\VsyPriceProductConcreteCustomerGroupStorage> $existingStorageEntities
     * @param bool $mergePrices
     *
     * @return void
     */
    protected function write(
        array $priceProductCustomerGroupStorageTransfers,
        array $existingStorageEntities = [],
        bool $mergePrices = false
    ): void {
        $existingStorageEntities = $this->mapStorageEntitiesByPriceKey($existingStorageEntities);
        $priceProductCustomerGroupStorageTransfers = $this->executePriceProductCustomerGroupStorageFilterPlugins($priceProductCustomerGroupStorageTransfers);

        foreach ($priceProductCustomerGroupStorageTransfers as $priceProductCustomerGroupStorageTransfer) {
            $priceProductCustomerGroupStorageTransfer = $this->groupPrices(
                $priceProductCustomerGroupStorageTransfer,
                $existingStorageEntities,
                $mergePrices,
            );

            // Skip if no prices, the price entity will be deleted at the end
            if (!$priceProductCustomerGroupStorageTransfer->getPrices()) {
                continue;
            }

            if (isset($existingStorageEntities[$priceProductCustomerGroupStorageTransfer->getPriceKey()])) {
                $this->priceProductCustomerGroupStorageEntityManager->updatePriceProductConcrete(
                    $priceProductCustomerGroupStorageTransfer,
                    $existingStorageEntities[$priceProductCustomerGroupStorageTransfer->getPriceKey()],
                );

                unset($existingStorageEntities[$priceProductCustomerGroupStorageTransfer->getPriceKey()]);

                continue;
            }

            $this->priceProductCustomerGroupStorageEntityManager->createPriceProductConcrete(
                $priceProductCustomerGroupStorageTransfer,
            );

            unset($existingStorageEntities[$priceProductCustomerGroupStorageTransfer->getPriceKey()]);
        }

        // Delete the rest of the entities
        $this->priceProductCustomerGroupStorageEntityManager
            ->deletePriceProductConcreteEntities($existingStorageEntities);
    }

    /**
     * @param array<\Orm\Zed\PriceProductCustomerGroupStorage\Persistence\VsyPriceProductConcreteCustomerGroupStorage> $priceProductCustomerGroupStorageEntities
     *
     * @return array
     */
    protected function mapStorageEntitiesByPriceKey(array $priceProductCustomerGroupStorageEntities): array
    {
        $mappedPriceProductConcreteCustomerGroupStorageEntities = [];
        foreach ($priceProductCustomerGroupStorageEntities as $priceProductCustomerGroupStorageEntity) {
            $mappedPriceProductConcreteCustomerGroupStorageEntities[$priceProductCustomerGroupStorageEntity->getPriceKey()] = $priceProductCustomerGroupStorageEntity;
        }

        return $mappedPriceProductConcreteCustomerGroupStorageEntities;
    }

    /**
     * @param \Generated\Shared\Transfer\PriceProductCustomerGroupStorageTransfer $priceProductCustomerGroupStorageTransfer
     * @param array<\Orm\Zed\PriceProductCustomerGroupStorage\Persistence\VsyPriceProductConcreteCustomerGroupStorage> $existingStorageEntities
     * @param bool $mergePrices
     *
     * @return \Generated\Shared\Transfer\PriceProductCustomerGroupStorageTransfer
     */
    protected function groupPrices(
        PriceProductCustomerGroupStorageTransfer $priceProductCustomerGroupStorageTransfer,
        array $existingStorageEntities = [],
        bool $mergePrices = false
    ): PriceProductCustomerGroupStorageTransfer {
        $priceProductCustomerGroupStorageTransfer = $this->priceGrouper->groupPricesData($priceProductCustomerGroupStorageTransfer);

        if (!$mergePrices) {
            return $priceProductCustomerGroupStorageTransfer;
        }

        return $this->priceGrouper->groupPricesData(
            $priceProductCustomerGroupStorageTransfer,
            $this->getExistingPricesDataForPriceKey($existingStorageEntities, $priceProductCustomerGroupStorageTransfer->getPriceKey()),
        );
    }

    /**
     * @param array<\Orm\Zed\PriceProductCustomerGroupStorage\Persistence\VsyPriceProductConcreteCustomerGroupStorage> $existingStorageEntities
     * @param string $priceKey
     *
     * @return array
     */
    protected function getExistingPricesDataForPriceKey(array $existingStorageEntities, string $priceKey): array
    {
        if (isset($existingStorageEntities[$priceKey])) {
            return $existingStorageEntities[$priceKey]->getData();
        }

        return [];
    }
}

<?php

declare(strict_types = 1);

namespace ValanticSpryker\Zed\PriceProductCustomerGroupStorage\Business\Model;

use Generated\Shared\Transfer\PriceProductCustomerGroupStorageTransfer;

class PriceProductAbstractStorageWriter extends AbstractPriceProductCustomerGroupStorageWriter implements PriceProductAbstractStorageWriterInterface
{
    /**
     * @param array<int> $companyBusinessUnitIds
     *
     * @return void
     */
    public function publishByCustomerGroupIds(array $companyBusinessUnitIds): void
    {
        $priceProductCustomerGroupStorageTransfers = $this->priceProductCustomerGroupStorageRepository
            ->findCustomerGroupProductAbstractPricesDataByCustomerGroupIds($companyBusinessUnitIds);

        $existingStorageEntities = $this->priceProductCustomerGroupStorageRepository
            ->findExistingPriceProductAbstractCustomerGroupEntitiesByCustomerGroupIds($companyBusinessUnitIds);

        $this->write($priceProductCustomerGroupStorageTransfers, $existingStorageEntities);
    }

    /**
     * @param array<int> $priceProductCustomerGroupIds
     *
     * @return void
     */
    public function publishAbstractPriceProductCustomerGroup(array $priceProductCustomerGroupIds): void
    {
        $priceProductCustomerGroupStorageTransfers = $this->priceProductCustomerGroupStorageRepository
            ->findCustomerGroupProductAbstractPricesByIds($priceProductCustomerGroupIds);

        $priceKeys = array_map(function (PriceProductCustomerGroupStorageTransfer $priceProductCustomerGroupStorageTransfer) {
            return $priceProductCustomerGroupStorageTransfer->getPriceKey();
        }, $priceProductCustomerGroupStorageTransfers);

        $existingStorageEntities = $this->priceProductCustomerGroupStorageRepository
            ->findExistingPriceProductAbstractCustomerGroupEntitiesByPriceKeys($priceKeys);

        $this->write($priceProductCustomerGroupStorageTransfers, $existingStorageEntities, true);
    }

    /**
     * @param array<int> $productAbstractIds
     *
     * @return void
     */
    public function publishAbstractPriceProductByProductAbstractIds(array $productAbstractIds): void
    {
        $priceProductCustomerGroupStorageTransfers = $this->priceProductCustomerGroupStorageRepository
            ->findCustomerGroupProductAbstractPricesDataByProductAbstractIds($productAbstractIds);

        $existingStorageEntities = $this->priceProductCustomerGroupStorageRepository
            ->findExistingPriceProductAbstractCustomerGroupEntitiesByProductAbstractIds($productAbstractIds);

        $this->write($priceProductCustomerGroupStorageTransfers, $existingStorageEntities);
    }

    /**
     * @param array<\Generated\Shared\Transfer\PriceProductCustomerGroupStorageTransfer> $priceProductCustomerGroupStorageTransfers
     * @param array<\Orm\Zed\PriceProductCustomerGroupStorage\Persistence\VsyPriceProductAbstractCustomerGroupStorage> $existingStorageEntities
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
                $this->priceProductCustomerGroupStorageEntityManager->updatePriceProductAbstract(
                    $priceProductCustomerGroupStorageTransfer,
                    $existingStorageEntities[$priceProductCustomerGroupStorageTransfer->getPriceKey()],
                );

                unset($existingStorageEntities[$priceProductCustomerGroupStorageTransfer->getPriceKey()]);

                continue;
            }

            $this->priceProductCustomerGroupStorageEntityManager->createPriceProductAbstract(
                $priceProductCustomerGroupStorageTransfer,
            );

            unset($existingStorageEntities[$priceProductCustomerGroupStorageTransfer->getPriceKey()]);
        }

        // Delete the rest of the entities
        $this->priceProductCustomerGroupStorageEntityManager
            ->deletePriceProductAbstractEntities($existingStorageEntities);
    }

    /**
     * @param array<\Orm\Zed\PriceProductCustomerGroupStorage\Persistence\VsyPriceProductAbstractCustomerGroupStorage> $priceProductCustomerGroupStorageEntities
     *
     * @return array
     */
    protected function mapStorageEntitiesByPriceKey(array $priceProductCustomerGroupStorageEntities): array
    {
        $mappedPriceProductAbstractCustomerGroupStorageEntities = [];
        foreach ($priceProductCustomerGroupStorageEntities as $priceProductCustomerGroupStorageEntity) {
            $mappedPriceProductAbstractCustomerGroupStorageEntities[$priceProductCustomerGroupStorageEntity->getPriceKey()] = $priceProductCustomerGroupStorageEntity;
        }

        return $mappedPriceProductAbstractCustomerGroupStorageEntities;
    }

    /**
     * @param \Generated\Shared\Transfer\PriceProductCustomerGroupStorageTransfer $priceProductCustomerGroupStorageTransfer
     * @param array<\Orm\Zed\PriceProductCustomerGroupStorage\Persistence\VsyPriceProductAbstractCustomerGroupStorage> $existingStorageEntities
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
     * @param array<\Orm\Zed\PriceProductCustomerGroupStorage\Persistence\VsyPriceProductAbstractCustomerGroupStorage> $existingStorageEntities
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

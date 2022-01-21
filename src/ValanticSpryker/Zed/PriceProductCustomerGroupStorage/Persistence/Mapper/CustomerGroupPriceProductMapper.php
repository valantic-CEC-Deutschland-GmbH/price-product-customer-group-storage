<?php

declare(strict_types = 1);

namespace ValanticSpryker\Zed\PriceProductCustomerGroupStorage\Persistence\Mapper;

use Generated\Shared\Transfer\PriceProductCustomerGroupStorageTransfer;
use Generated\Shared\Transfer\PriceProductCustomerGroupValueTransfer;

class CustomerGroupPriceProductMapper implements CustomerGroupPriceProductMapperInterface
{
    /**
     * @var string
     */
    protected const PRICE_KEY_SEPARATOR = ':';

    /**
     * @param array $priceProductCustomerGroupsData
     *
     * @return array<\Generated\Shared\Transfer\PriceProductCustomerGroupStorageTransfer>
     */
    public function mapPriceProductCustomerGroupArrayToTransfers(array $priceProductCustomerGroupsData): array
    {
        $pricesByKey = [];
        foreach ($priceProductCustomerGroupsData as $priceProductCustomerGroupData) {
            $uniquePriceIndex = $this->createUniquePriceIndex($priceProductCustomerGroupData);
            if (!isset($pricesByKey[$uniquePriceIndex])) {
                $pricesByKey[$uniquePriceIndex] = $this->createPriceProductCustomerGroupStorageTransfer(
                    $priceProductCustomerGroupData,
                    $uniquePriceIndex,
                );
            }

            $this->addUngroupedPrice(
                $pricesByKey[$uniquePriceIndex],
                $priceProductCustomerGroupData,
            );
        }

        return $pricesByKey;
    }

    /**
     * @param array $priceProductCustomerGroupData
     * @param string $uniquePriceIndex
     *
     * @return \Generated\Shared\Transfer\PriceProductCustomerGroupStorageTransfer
     */
    protected function createPriceProductCustomerGroupStorageTransfer(
        array $priceProductCustomerGroupData,
        string $uniquePriceIndex
    ): PriceProductCustomerGroupStorageTransfer {
        return (new PriceProductCustomerGroupStorageTransfer())
            ->fromArray($priceProductCustomerGroupData, true)
            ->setPriceKey($uniquePriceIndex);
    }

    /**
     * @param array $priceProductCustomerGroupData
     *
     * @return string
     */
    protected function createUniquePriceIndex(array $priceProductCustomerGroupData): string
    {
        return implode(static::PRICE_KEY_SEPARATOR, [
            $priceProductCustomerGroupData[PriceProductCustomerGroupStorageTransfer::STORE_NAME],
            $priceProductCustomerGroupData[PriceProductCustomerGroupStorageTransfer::ID_PRODUCT],
            $priceProductCustomerGroupData[PriceProductCustomerGroupStorageTransfer::ID_CUSTOMER_GROUP],
        ]);
    }

    /**
     * @param \Generated\Shared\Transfer\PriceProductCustomerGroupStorageTransfer $customerGroupStorageTransfer
     * @param array $priceProductCustomerGroupData
     *
     * @return void
     */
    protected function addUngroupedPrice(
        PriceProductCustomerGroupStorageTransfer $customerGroupStorageTransfer,
        array $priceProductCustomerGroupData
    ): void {
        $customerGroupStorageTransfer->addUngroupedPrice(
            (new PriceProductCustomerGroupValueTransfer())
                ->fromArray($priceProductCustomerGroupData, true),
        );
    }
}

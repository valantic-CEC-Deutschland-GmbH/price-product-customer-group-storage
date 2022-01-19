<?php

declare(strict_types = 1);

namespace ValanticSpryker\Zed\PriceProductCustomerGroupStorage\Persistence\Mapper;

interface CustomerGroupPriceProductMapperInterface
{
    /**
     * @param array $priceProductCustomerGroups
     *
     * @return array<\Generated\Shared\Transfer\PriceProductCustomerGroupStorageTransfer>
     */
    public function mapPriceProductCustomerGroupArrayToTransfers(array $priceProductCustomerGroups): array;
}

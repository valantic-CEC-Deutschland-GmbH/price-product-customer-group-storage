<?php

declare(strict_types = 1);

namespace ValanticSpryker\Zed\PriceProductCustomerGroupStorage\Persistence\Mapper\PriceProductCustomerGroup;

use Generated\Shared\Transfer\PriceProductCustomerGroupTransfer;
use Orm\Zed\PriceProductCustomerGroup\Persistence\VsyPriceProductCustomerGroup;

class PriceProductCustomerGroupMapper implements PriceProductCustomerGroupMapperInterface
{
    /**
     * @param \Orm\Zed\PriceProductCustomerGroup\Persistence\VsyPriceProductCustomerGroup $priceProductCustomerGroupEntity
     * @param \Generated\Shared\Transfer\PriceProductCustomerGroupTransfer $priceProductCustomerGroupTransfer
     *
     * @return \Generated\Shared\Transfer\PriceProductCustomerGroupTransfer
     */
    public function mapEntityToPriceProductCustomerGroupTransfer(
        VsyPriceProductCustomerGroup $priceProductCustomerGroupEntity,
        PriceProductCustomerGroupTransfer $priceProductCustomerGroupTransfer
    ): PriceProductCustomerGroupTransfer {
        return $priceProductCustomerGroupTransfer->fromArray($priceProductCustomerGroupEntity->toArray(), true);
    }

    /**
     * @param array<\Orm\Zed\PriceProductCustomerGroup\Persistence\VsyPriceProductCustomerGroup> $priceProductCustomerGroupEntities
     *
     * @return array<\Generated\Shared\Transfer\PriceProductCustomerGroupTransfer>
     */
    public function mapEntitiesToPriceProductCustomerGroupTransferCollection(array $priceProductCustomerGroupEntities): array
    {
        $priceProductCustomerGroupTransferCollection = [];

        foreach ($priceProductCustomerGroupEntities as $priceProductCustomerGroupEntity) {
            $priceProductCustomerGroupTransferCollection[] = $this->mapEntityToPriceProductCustomerGroupTransfer(
                $priceProductCustomerGroupEntity,
                new PriceProductCustomerGroupTransfer(),
            );
        }

        return $priceProductCustomerGroupTransferCollection;
    }
}

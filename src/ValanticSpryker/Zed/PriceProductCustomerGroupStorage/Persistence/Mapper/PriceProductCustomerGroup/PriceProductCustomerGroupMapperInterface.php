<?php

declare(strict_types = 1);

namespace ValanticSpryker\Zed\PriceProductCustomerGroupStorage\Persistence\Mapper\PriceProductCustomerGroup;

use Generated\Shared\Transfer\PriceProductCustomerGroupTransfer;
use Orm\Zed\PriceProductCustomerGroup\Persistence\VsyPriceProductCustomerGroup;

interface PriceProductCustomerGroupMapperInterface
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
    ): PriceProductCustomerGroupTransfer;

    /**
     * @param array<\Orm\Zed\PriceProductCustomerGroup\Persistence\VsyPriceProductCustomerGroup> $priceProductCustomerGroupEntities
     *
     * @return array<\Generated\Shared\Transfer\PriceProductCustomerGroupTransfer>
     */
    public function mapEntitiesToPriceProductCustomerGroupTransferCollection(array $priceProductCustomerGroupEntities): array;
}

<?php

declare(strict_types = 1);

namespace ValanticSpryker\Client\PriceProductCustomerGroupStorage\Storage;

interface PriceProductCustomerGroupConcreteReaderInterface
{
    /**
     * @param int $idProductAbstract
     * @param int $idCustomerGroup
     *
     * @return array<\Generated\Shared\Transfer\PriceProductTransfer>
     */
    public function findPriceCustomerGroupConcrete(int $idProductAbstract, int $idCustomerGroup): array;
}

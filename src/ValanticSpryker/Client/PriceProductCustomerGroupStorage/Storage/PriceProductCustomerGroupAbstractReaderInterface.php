<?php

declare(strict_types = 1);

namespace ValanticSpryker\Client\PriceProductCustomerGroupStorage\Storage;

interface PriceProductCustomerGroupAbstractReaderInterface
{
    /**
     * @param int $idProductAbstract
     * @param int $idCustomerGroup
     *
     * @return array<\Generated\Shared\Transfer\PriceProductTransfer>
     */
    public function findProductAbstractPrices(int $idProductAbstract, int $idCustomerGroup): array;
}

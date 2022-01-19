<?php

declare(strict_types = 1);

namespace ValanticSpryker\Client\PriceProductCustomerGroupStorage\Dependency\Service;

use Generated\Shared\Transfer\PriceProductTransfer;

interface PriceProductCustomerGroupStorageToPriceProductServiceInterface
{
    /**
     * @param \Generated\Shared\Transfer\PriceProductTransfer $priceProductTransfer
     *
     * @return string
     */
    public function buildPriceProductGroupKey(PriceProductTransfer $priceProductTransfer): string;
}

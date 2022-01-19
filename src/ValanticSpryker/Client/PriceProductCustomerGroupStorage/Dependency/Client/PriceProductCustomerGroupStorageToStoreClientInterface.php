<?php

declare(strict_types = 1);

namespace ValanticSpryker\Client\PriceProductCustomerGroupStorage\Dependency\Client;

use Generated\Shared\Transfer\StoreTransfer;

interface PriceProductCustomerGroupStorageToStoreClientInterface
{
    /**
     * @return \Generated\Shared\Transfer\StoreTransfer
     */
    public function getCurrentStore(): StoreTransfer;
}

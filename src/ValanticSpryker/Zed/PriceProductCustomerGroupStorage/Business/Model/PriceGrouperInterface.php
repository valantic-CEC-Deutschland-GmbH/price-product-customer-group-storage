<?php

declare(strict_types = 1);

namespace ValanticSpryker\Zed\PriceProductCustomerGroupStorage\Business\Model;

use Generated\Shared\Transfer\PriceProductCustomerGroupStorageTransfer;

interface PriceGrouperInterface
{
    /**
     * @see \Spryker\Zed\PriceProduct\Business\PriceProductFacadeInterface::groupPriceProductCollection()
     *
     * Specification:
     *  - Groups provided transfers by currency, price mode and price type.
     *  - Merges the grouped prices with provided existing price data (optional).
     *  - Filters empty prices.
     *
     * @param \Generated\Shared\Transfer\PriceProductCustomerGroupStorageTransfer $priceProductCustomerGroupStorageTransfer
     * @param array $pricesData
     *
     * @return \Generated\Shared\Transfer\PriceProductCustomerGroupStorageTransfer
     */
    public function groupPricesData(
        PriceProductCustomerGroupStorageTransfer $priceProductCustomerGroupStorageTransfer,
        array $pricesData = []
    ): PriceProductCustomerGroupStorageTransfer;
}

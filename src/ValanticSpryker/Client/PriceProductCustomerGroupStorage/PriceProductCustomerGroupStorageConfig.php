<?php

declare(strict_types = 1);

namespace ValanticSpryker\Client\PriceProductCustomerGroupStorage;

use Spryker\Client\Kernel\AbstractBundleConfig;

/**
 * @method \ValanticSpryker\Shared\PriceProductCustomerGroupStorage\PriceProductCustomerGroupStorageConfig getSharedConfig()
 */
class PriceProductCustomerGroupStorageConfig extends AbstractBundleConfig
{
    /**
     * @api
     *
     * @return string
     */
    public function getPriceDimensionCustomerGroup(): string
    {
        return $this->getSharedConfig()
            ->getPriceDimensionCustomerGroup();
    }
}

<?php

declare(strict_types = 1);

namespace ValanticSpryker\Shared\PriceProductCustomerGroupStorage;

use Spryker\Shared\Kernel\AbstractSharedConfig;

class PriceProductCustomerGroupStorageConfig extends AbstractSharedConfig
{
    /**
     * Price Dimension Customer Group
     *
     * @uses \ValanticSpryker\Shared\PriceProductCustomerGroup\PriceProductCustomerGroupConfig::PRICE_DIMENSION_CUSTOMER_GROUP
     *
     * @var string
     */
    protected const PRICE_DIMENSION_CUSTOMER_GROUP = 'PRICE_DIMENSION_CUSTOMER_GROUP';

    /**
     * @uses \Spryker\Shared\PriceProduct\PriceProductConfig::PRICE_MODES
     *
     * @var array<string>
     */
    public const PRICE_MODES = [
        'NET_MODE',
        'GROSS_MODE',
    ];

    /**
     * @uses \Spryker\Shared\Price\PriceConfig::PRICE_MODE_GROSS
     *
     * @var string
     */
    public const PRICE_GROSS_MODE = 'GROSS_MODE';

    /**
     * @api
     *
     * @return string
     */
    public function getPriceDimensionCustomerGroup(): string
    {
        return static::PRICE_DIMENSION_CUSTOMER_GROUP;
    }
}

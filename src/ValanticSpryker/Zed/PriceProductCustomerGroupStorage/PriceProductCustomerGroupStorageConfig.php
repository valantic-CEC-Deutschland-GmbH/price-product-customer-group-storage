<?php

declare(strict_types = 1);

namespace ValanticSpryker\Zed\PriceProductCustomerGroupStorage;

use Spryker\Zed\Kernel\AbstractBundleConfig;

/**
 * @method \ValanticSpryker\Shared\PriceProductCustomerGroupStorage\PriceProductCustomerGroupStorageConfig getSharedConfig()
 */
class PriceProductCustomerGroupStorageConfig extends AbstractBundleConfig
{
    /**
     * @var string
     */
    public const PRICE_PRODUCT_CUSTOMER_GROUP_SYNC_STORAGE_QUEUE = 'sync.storage.price';

    /**
     * @uses \Orm\Zed\PriceProductCustomerGroup\Persistence\Map\VsyPriceProductCustomerGroupTableMap::COL_FK_CUSTOMER_GROUP
     *
     * @var string
     */
    public const COL_FK_CUSTOMER_GROUP = 'vsy_price_product_customer_group.fk_customer_group';

    /**
     * @uses \Orm\Zed\PriceProductCustomerGroup\Persistence\Map\VsyPriceProductCustomerGroupTableMap::COL_FK_PRICE_PRODUCT_STORE
     *
     * @var string
     */
    public const COL_FK_PRICE_PRODUCT_STORE = 'vsy_price_product_customer_group.fk_price_product_store';

    /**
     * @uses \Orm\Zed\PriceProductCustomerGroup\Persistence\Map\VsyPriceProductCustomerGroupTableMap::COL_FK_PRODUCT
     *
     * @var string
     */
    public const COL_FK_PRODUCT = 'vsy_price_product_customer_group.fk_product';

    /**
     * @uses \Orm\Zed\PriceProductCustomerGroup\Persistence\Map\VsyPriceProductCustomerGroupTableMap::COL_FK_PRODUCT_ABSTRACT
     *
     * @var string
     */
    public const COL_FK_PRODUCT_ABSTRACT = 'vsy_price_product_customer_group.fk_product_abstract';

    /**
     * @uses \Spryker\Shared\PriceProduct\PriceProductConfig::PRICE_DATA
     *
     * @var string
     */
    public const PRICE_DATA = 'priceData';

    /**
     * @uses \Spryker\Shared\Price\PriceConfig::PRICE_MODE_GROSS
     *
     * @var string
     */
    public const PRICE_MODE_GROSS = 'GROSS_MODE';

    /**
     * @uses \Spryker\Shared\Price\PriceConfig::PRICE_MODE_NET
     *
     * @var string
     */
    public const PRICE_MODE_NET = 'NET_MODE';

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

    /**
     * @api
     *
     * @return string|null
     */
    public function getPriceProductConcreteCustomerGroupSynchronizationPoolName(): ?string
    {
        return null;
    }

    /**
     * @api
     *
     * @return string|null
     */
    public function getPriceProductAbstractCustomerGroupSynchronizationPoolName(): ?string
    {
        return null;
    }

    /**
     * @api
     *
     * @return string|null
     */
    public function getPriceProductConcreteCustomerGroupEventQueueName(): ?string
    {
        return null;
    }

    /**
     * @api
     *
     * @return string|null
     */
    public function getPriceProductAbstractCustomerGroupEventQueueName(): ?string
    {
        return null;
    }

    /**
     * @api
     *
     * @deprecated Use {@link \Spryker\Zed\SynchronizationBehavior\SynchronizationBehaviorConfig::isSynchronizationEnabled()} instead.
     *
     * @return bool
     */
    public function isSendingToQueue(): bool
    {
        return true;
    }
}

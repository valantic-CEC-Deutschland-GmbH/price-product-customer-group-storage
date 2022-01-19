<?php

declare(strict_types = 1);

namespace ValanticSpryker\Zed\PriceProductCustomerGroupStorage\Business\Model;

interface PriceProductAbstractStorageWriterInterface
{
    /**
     * @param array<int> $customerGroupIds
     *
     * @return void
     */
    public function publishByCustomerGroupIds(array $customerGroupIds): void;

    /**
     * @param array<int> $priceProductCustomerGroupIds
     *
     * @return void
     */
    public function publishAbstractPriceProductCustomerGroup(array $priceProductCustomerGroupIds): void;

    /**
     * @param array<int> $productAbstractIds
     *
     * @return void
     */
    public function publishAbstractPriceProductByProductAbstractIds(array $productAbstractIds): void;
}

<?php

declare(strict_types=1);

namespace ValanticSpryker\Zed\PriceProductCustomerGroupStorage\Business\Model;

interface PriceProductConcreteStorageWriterInterface
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
    public function publishConcretePriceProductCustomerGroup(array $priceProductCustomerGroupIds): void;

    /**
     * @param array<int> $productIds
     *
     * @return void
     */
    public function publishConcretePriceProductByProductIds(array $productIds): void;
}

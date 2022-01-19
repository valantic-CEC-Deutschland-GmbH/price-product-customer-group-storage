<?php

declare(strict_types = 1);

namespace ValanticSpryker\Client\PriceProductCustomerGroupStorage\CustomerGroupFinder;

interface CustomerGroupFinderInterface
{
    /**
     * @return int|null
     */
    public function findCurrentCustomerGroupId(): ?int;
}

<?php

declare(strict_types = 1);

namespace ValanticSpryker\Client\PriceProductCustomerGroupStorage\CustomerGroupFinder;

use Generated\Shared\Transfer\CustomerTransfer;

class CustomerGroupFinder implements CustomerGroupFinderInterface
{
    /**
     * @var \ValanticSpryker\Client\PriceProductCustomerGroupStorage\Dependency\Client\PriceProductCustomerGroupStorageToCustomerClientInterface
     */
    protected $customerClient;

    /**
     * @var \Generated\Shared\Transfer\CustomerTransfer|null
     */
    protected static $customerTransfer;

    /**
     * @var bool
     */
    protected static $customerTransferLoaded = false;

    /**
     * @param \ValanticSpryker\Client\PriceProductCustomerGroupStorage\Dependency\Client\PriceProductCustomerGroupStorageToCustomerClientInterface $customerClient
     */
    public function __construct($customerClient)
    {
        $this->customerClient = $customerClient;
    }

    /**
     * @return int|null
     */
    public function findCurrentCustomerGroupId(): ?int
    {
        $customerTransfer = $this->getCustomerTransfer();

        if ($customerTransfer === null) {
            return null;
        }

        $customerGroup = $customerTransfer->getCustomerGroup();
        if (!$customerGroup) {
            return null;
        }

        return $customerGroup->getIdCustomerGroup();
    }

    /**
     * @return \Generated\Shared\Transfer\CustomerTransfer|null
     */
    protected function getCustomerTransfer(): ?CustomerTransfer
    {
        if (static::$customerTransferLoaded === false) {
            static::$customerTransfer = $this->customerClient->getCustomer();
            static::$customerTransferLoaded = true;
        }

        return static::$customerTransfer;
    }
}

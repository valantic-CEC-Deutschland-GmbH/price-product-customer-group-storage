<?php

declare(strict_types = 1);

namespace ValanticSpryker\Client\PriceProductCustomerGroupStorage\Storage;

use Generated\Shared\Transfer\SynchronizationDataTransfer;
use ValanticSpryker\Client\PriceProductCustomerGroupStorage\Dependency\Client\PriceProductCustomerGroupStorageToStoreClientInterface;
use ValanticSpryker\Client\PriceProductCustomerGroupStorage\Dependency\Service\PriceProductCustomerGroupToSynchronizationServiceInterface;

class PriceProductCustomerGroupKeyGenerator implements PriceProductCustomerGroupKeyGeneratorInterface
{
    /**
     * @var string
     */
    protected const KEY_SEPARATOR = ':';

    /**
     * @var \ValanticSpryker\Client\PriceProductCustomerGroupStorage\Dependency\Service\PriceProductCustomerGroupToSynchronizationServiceInterface
     */
    protected $synchronizationService;

    /**
     * @var \ValanticSpryker\Client\PriceProductCustomerGroupStorage\Dependency\Client\PriceProductCustomerGroupStorageToStoreClientInterface
     */
    protected $storeClient;

    /**
     * @param \ValanticSpryker\Client\PriceProductCustomerGroupStorage\Dependency\Service\PriceProductCustomerGroupToSynchronizationServiceInterface $synchronizationService
     * @param \ValanticSpryker\Client\PriceProductCustomerGroupStorage\Dependency\Client\PriceProductCustomerGroupStorageToStoreClientInterface $storeClient
     */
    public function __construct(
        PriceProductCustomerGroupToSynchronizationServiceInterface $synchronizationService,
        PriceProductCustomerGroupStorageToStoreClientInterface $storeClient
    ) {
        $this->synchronizationService = $synchronizationService;
        $this->storeClient = $storeClient;
    }

    /**
     * @param string $resourceName
     * @param int $idProduct
     * @param int $idCustomerGroup
     *
     * @return string
     */
    public function generateKey(string $resourceName, int $idProduct, int $idCustomerGroup): string
    {
        $synchronizationDataTransfer = new SynchronizationDataTransfer();
        $synchronizationDataTransfer
            ->setStore($this->storeClient->getCurrentStore()->getName())
            ->setReference($idProduct . static::KEY_SEPARATOR . $idCustomerGroup);

        return $this->synchronizationService
            ->getStorageKeyBuilder($resourceName)
            ->generateKey($synchronizationDataTransfer);
    }
}

<?php

declare(strict_types = 1);

namespace ValanticSpryker\Client\PriceProductCustomerGroupStorage\Dependency\Service;

use Spryker\Service\Synchronization\Dependency\Plugin\SynchronizationKeyGeneratorPluginInterface;

interface PriceProductCustomerGroupToSynchronizationServiceInterface
{
    /**
     * @param string $resourceName
     *
     * @return \Spryker\Service\Synchronization\Dependency\Plugin\SynchronizationKeyGeneratorPluginInterface
     */
    public function getStorageKeyBuilder(string $resourceName): SynchronizationKeyGeneratorPluginInterface;
}

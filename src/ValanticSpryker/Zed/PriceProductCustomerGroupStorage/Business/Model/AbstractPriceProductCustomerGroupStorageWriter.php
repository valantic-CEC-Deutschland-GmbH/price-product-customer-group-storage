<?php

declare(strict_types = 1);

namespace ValanticSpryker\Zed\PriceProductCustomerGroupStorage\Business\Model;

use ValanticSpryker\Zed\PriceProductCustomerGroupStorage\Persistence\PriceProductCustomerGroupStorageEntityManagerInterface;
use ValanticSpryker\Zed\PriceProductCustomerGroupStorage\Persistence\PriceProductCustomerGroupStorageRepositoryInterface;

class AbstractPriceProductCustomerGroupStorageWriter
{
    /**
     * @var \ValanticSpryker\Zed\PriceProductCustomerGroupStorage\Persistence\PriceProductCustomerGroupStorageEntityManagerInterface
     */
    protected $priceProductCustomerGroupStorageEntityManager;

    /**
     * @var \ValanticSpryker\Zed\PriceProductCustomerGroupStorage\Persistence\PriceProductCustomerGroupStorageRepositoryInterface
     */
    protected $priceProductCustomerGroupStorageRepository;

    /**
     * @var \ValanticSpryker\Zed\PriceProductCustomerGroupStorage\Business\Model\PriceGrouperInterface
     */
    protected $priceGrouper;

    /**
     * @var array<\ValanticSpryker\Zed\PriceProductCustomerGroupStorageExtension\Dependency\Plugin\PriceProductCustomerGroupStorageFilterPluginInterface>
     */
    protected $priceProductCustomerGroupStorageFilterPlugins;

    /**
     * @param \ValanticSpryker\Zed\PriceProductCustomerGroupStorage\Persistence\PriceProductCustomerGroupStorageEntityManagerInterface $priceProductCustomerGroupStorageEntityManager
     * @param \ValanticSpryker\Zed\PriceProductCustomerGroupStorage\Persistence\PriceProductCustomerGroupStorageRepositoryInterface $priceProductCustomerGroupStorageRepository
     * @param \ValanticSpryker\Zed\PriceProductCustomerGroupStorage\Business\Model\PriceGrouperInterface $priceGrouper
     * @param array<\ValanticSpryker\Zed\PriceProductCustomerGroupStorageExtension\Dependency\Plugin\PriceProductCustomerGroupStorageFilterPluginInterface> $priceProductCustomerGroupStorageFilterPlugins
     */
    public function __construct(
        PriceProductCustomerGroupStorageEntityManagerInterface $priceProductCustomerGroupStorageEntityManager,
        PriceProductCustomerGroupStorageRepositoryInterface $priceProductCustomerGroupStorageRepository,
        PriceGrouperInterface $priceGrouper,
        array $priceProductCustomerGroupStorageFilterPlugins
    ) {
        $this->priceProductCustomerGroupStorageEntityManager = $priceProductCustomerGroupStorageEntityManager;
        $this->priceProductCustomerGroupStorageRepository = $priceProductCustomerGroupStorageRepository;
        $this->priceGrouper = $priceGrouper;
        $this->priceProductCustomerGroupStorageFilterPlugins = $priceProductCustomerGroupStorageFilterPlugins;
    }

    /**
     * @param array<\Generated\Shared\Transfer\PriceProductCustomerGroupStorageTransfer> $priceProductCustomerGroupStorageTransfers
     *
     * @return array<\Generated\Shared\Transfer\PriceProductCustomerGroupStorageTransfer>
     */
    protected function executePriceProductCustomerGroupStorageFilterPlugins(array $priceProductCustomerGroupStorageTransfers): array
    {
        foreach ($this->priceProductCustomerGroupStorageFilterPlugins as $priceProductCustomerGroupStorageFilterPlugin) {
            $priceProductCustomerGroupStorageTransfers = $priceProductCustomerGroupStorageFilterPlugin->filter($priceProductCustomerGroupStorageTransfers);
        }

        return $priceProductCustomerGroupStorageTransfers;
    }
}

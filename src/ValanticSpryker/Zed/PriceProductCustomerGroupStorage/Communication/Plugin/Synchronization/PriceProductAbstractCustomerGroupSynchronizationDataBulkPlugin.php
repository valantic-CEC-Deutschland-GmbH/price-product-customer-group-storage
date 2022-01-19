<?php

declare(strict_types = 1);

namespace ValanticSpryker\Zed\PriceProductCustomerGroupStorage\Communication\Plugin\Synchronization;

use Generated\Shared\Transfer\FilterTransfer;
use Generated\Shared\Transfer\SynchronizationDataTransfer;
use Orm\Zed\PriceProductCustomerGroupStorage\Persistence\Map\VsyPriceProductAbstractCustomerGroupStorageTableMap;
use Spryker\Zed\Kernel\Communication\AbstractPlugin;
use Spryker\Zed\SynchronizationExtension\Dependency\Plugin\SynchronizationDataBulkRepositoryPluginInterface;
use ValanticSpryker\Shared\PriceProductCustomerGroupStorage\PriceProductCustomerGroupStorageConstants;
use ValanticSpryker\Zed\PriceProductCustomerGroupStorage\PriceProductCustomerGroupStorageConfig;

/**
 * Important Note: This plugin is only compatible with Synchronization version 1.4.0 or higher.
 *
 * @method \ValanticSpryker\Zed\PriceProductCustomerGroupStorage\Business\PriceProductCustomerGroupStorageFacadeInterface getFacade()
 * @method \ValanticSpryker\Zed\PriceProductCustomerGroupStorage\Communication\PriceProductCustomerGroupStorageCommunicationFactory getFactory()
 * @method \ValanticSpryker\Zed\PriceProductCustomerGroupStorage\Persistence\PriceProductCustomerGroupStorageRepositoryInterface getRepository()
 * @method \ValanticSpryker\Zed\PriceProductCustomerGroupStorage\PriceProductCustomerGroupStorageConfig getConfig()
 */
class PriceProductAbstractCustomerGroupSynchronizationDataBulkPlugin extends AbstractPlugin implements SynchronizationDataBulkRepositoryPluginInterface
{
    /**
     * {@inheritDoc}
     *
     * @api
     *
     * @return string
     */
    public function getResourceName(): string
    {
        return PriceProductCustomerGroupStorageConstants::PRICE_PRODUCT_ABSTRACT_CUSTOMER_GROUP_RESOURCE_NAME;
    }

    /**
     * {@inheritDoc}
     *
     * @api
     *
     * @return bool
     */
    public function hasStore(): bool
    {
        return false;
    }

    /**
     * {@inheritDoc}
     *
     * @api
     *
     * @return array
     */
    public function getParams(): array
    {
        return [];
    }

    /**
     * {@inheritDoc}
     *
     * @api
     *
     * @return string
     */
    public function getQueueName(): string
    {
        return PriceProductCustomerGroupStorageConfig::PRICE_PRODUCT_CUSTOMER_GROUP_SYNC_STORAGE_QUEUE;
    }

    /**
     * {@inheritDoc}
     *
     * @api
     *
     * @return string|null
     */
    public function getSynchronizationQueuePoolName(): ?string
    {
        return $this->getConfig()
            ->getPriceProductAbstractCustomerGroupSynchronizationPoolName();
    }

    /**
     * {@inheritDoc}
     *
     * @api
     *
     * @param int $offset
     * @param int $limit
     * @param array<int> $ids
     *
     * @return array<\Generated\Shared\Transfer\SynchronizationDataTransfer>
     */
    public function getData(int $offset, int $limit, array $ids = []): array
    {
        $data = [];
        $filterTransfer = $this->createFilterTransfer($offset, $limit);

        $priceProductAbstractCustomerGroupStorageEntityTransfers = $this->getRepository()->findFilteredPriceProductAbstractCustomerGroupStorageEntities($filterTransfer, $ids);

        foreach ($priceProductAbstractCustomerGroupStorageEntityTransfers as $priceProductAbstractCustomerGroupStorageEntityTransfer) {
            $synchronizationDataTransfer = new SynchronizationDataTransfer();
            $synchronizationDataTransfer->setData($priceProductAbstractCustomerGroupStorageEntityTransfer->getData());
            $synchronizationDataTransfer->setKey($priceProductAbstractCustomerGroupStorageEntityTransfer->getKey());

            $data[] = $synchronizationDataTransfer;
        }

        return $data;
    }

    /**
     * @param int $offset
     * @param int $limit
     *
     * @return \Generated\Shared\Transfer\FilterTransfer
     */
    protected function createFilterTransfer(int $offset, int $limit): FilterTransfer
    {
        return (new FilterTransfer())
            ->setOrderBy(VsyPriceProductAbstractCustomerGroupStorageTableMap::COL_ID_PRICE_PRODUCT_ABSTRACT_CUSTOMER_GROUP_STORAGE)
            ->setOffset($offset)
            ->setLimit($limit);
    }
}

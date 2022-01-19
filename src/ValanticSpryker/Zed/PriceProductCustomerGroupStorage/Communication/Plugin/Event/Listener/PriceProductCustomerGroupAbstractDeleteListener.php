<?php

declare(strict_types = 1);

namespace ValanticSpryker\Zed\PriceProductCustomerGroupStorage\Communication\Plugin\Event\Listener;

use Spryker\Zed\Event\Dependency\Plugin\EventBulkHandlerInterface;
use Spryker\Zed\Kernel\Communication\AbstractPlugin;
use ValanticSpryker\Zed\PriceProductCustomerGroupStorage\PriceProductCustomerGroupStorageConfig;

/**
 * @method \ValanticSpryker\Zed\PriceProductCustomerGroupStorage\Business\PriceProductCustomerGroupStorageFacadeInterface getFacade()
 * @method \ValanticSpryker\Zed\PriceProductCustomerGroupStorage\Communication\PriceProductCustomerGroupStorageCommunicationFactory getFactory()
 * @method \ValanticSpryker\Zed\PriceProductCustomerGroupStorage\Persistence\PriceProductCustomerGroupStorageRepositoryInterface getRepository()
 * @method \ValanticSpryker\Zed\PriceProductCustomerGroupStorage\PriceProductCustomerGroupStorageConfig getConfig()
 */
class PriceProductCustomerGroupAbstractDeleteListener extends AbstractPlugin implements EventBulkHandlerInterface
{
    /**
     * {@inheritDoc}
     *
     * @api
     *
     * @param array<\Generated\Shared\Transfer\EventEntityTransfer> $eventEntityTransfers
     * @param string $eventName
     *
     * @return void
     */
    public function handleBulk(array $eventEntityTransfers, $eventName): void
    {
        $productAbstractIds = $this->getFactory()
            ->getEventBehaviorFacade()
            ->getEventTransferForeignKeys(
                $eventEntityTransfers,
                PriceProductCustomerGroupStorageConfig::COL_FK_PRODUCT_ABSTRACT,
            );

        if (!$productAbstractIds) {
            return;
        }

        $this->getFacade()
            ->publishAbstractPriceProductByProductAbstractIds($productAbstractIds);
    }
}

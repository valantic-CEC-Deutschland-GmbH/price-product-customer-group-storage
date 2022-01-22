<?php

declare(strict_types = 1);

namespace ValanticSpryker\Zed\PriceProductCustomerGroupStorage\Communication\Plugin\Event;

use Generated\Shared\Transfer\FilterTransfer;
use Orm\Zed\PriceProductCustomerGroup\Persistence\Map\VsyPriceProductCustomerGroupTableMap;
use Spryker\Zed\EventBehavior\Dependency\Plugin\EventResourceBulkRepositoryPluginInterface;
use Spryker\Zed\Kernel\Communication\AbstractPlugin;
use ValanticSpryker\Shared\PriceProductCustomerGroupStorage\PriceProductCustomerGroupStorageConstants;
use ValanticSpryker\Zed\PriceProductCustomerGroup\Dependency\PriceProductCustomerGroupEvents;

/**
 * @method \ValanticSpryker\Zed\PriceProductCustomerGroupStorage\Business\PriceProductCustomerGroupStorageFacadeInterface getFacade()
 * @method \ValanticSpryker\Zed\PriceProductCustomerGroupStorage\Communication\PriceProductCustomerGroupStorageCommunicationFactory getFactory()
 * @method \ValanticSpryker\Zed\PriceProductCustomerGroupStorage\Persistence\PriceProductCustomerGroupStorageRepositoryInterface getRepository()
 * @method \ValanticSpryker\Zed\PriceProductCustomerGroupStorage\PriceProductCustomerGroupStorageConfig getConfig()
 */
class PriceProductConcreteCustomerGroupEventResourceBulkRepositoryPlugin extends AbstractPlugin implements EventResourceBulkRepositoryPluginInterface
{
    /**
     * @uses \Propel\Runtime\ActiveQuery\Criteria::ASC
     *
     * @var string
     */
    protected const ORDER_DIRECTION = 'ASC';

    /**
     * {@inheritDoc}
     *
     * @api
     *
     * @return string
     */
    public function getResourceName(): string
    {
        return PriceProductCustomerGroupStorageConstants::PRICE_PRODUCT_CONCRETE_CUSTOMER_GROUP_RESOURCE_NAME;
    }

    /**
     * {@inheritDoc}
     *
     * @api
     *
     * @param int $offset
     * @param int $limit
     *
     * @return array<\Generated\Shared\Transfer\PriceProductCustomerGroupTransfer|\Spryker\Shared\Kernel\Transfer\AbstractTransfer>
     */
    public function getData(int $offset, int $limit): array
    {
        $filterTransfer = (new FilterTransfer())
            ->setOffset($offset)
            ->setLimit($limit)
            ->setOrderBy($this->getIdColumnName())
            ->setOrderDirection(static::ORDER_DIRECTION);

        return $this->getRepository()
            ->getFilteredPriceProductConcreteCustomerGroups($filterTransfer);
    }

    /**
     * {@inheritDoc}
     *
     * @api
     *
     * @return string
     */
    public function getEventName(): string
    {
        return PriceProductCustomerGroupEvents::PRICE_CONCRETE_PUBLISH;
    }

    /**
     * {@inheritDoc}
     *
     * @api
     *
     * @return string|null
     */
    public function getIdColumnName(): ?string
    {
        return VsyPriceProductCustomerGroupTableMap::COL_ID_PRICE_PRODUCT_CUSTOMER_GROUP;
    }
}

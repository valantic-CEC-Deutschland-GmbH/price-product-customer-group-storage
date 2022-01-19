<?php

declare(strict_types = 1);

namespace ValanticSpryker\Client\PriceProductCustomerGroupStorage\Plugin\PriceProductStorageExtension;

use Spryker\Client\Kernel\AbstractPlugin;
use Spryker\Client\PriceProductStorageExtension\Dependency\Plugin\PriceProductStoragePriceDimensionPluginInterface;

/**
 * @method \ValanticSpryker\Client\PriceProductCustomerGroupStorage\PriceProductCustomerGroupStorageClientInterface getClient()
 * @method \ValanticSpryker\Client\PriceProductCustomerGroupStorage\PriceProductCustomerGroupStorageFactory getFactory()
 */
class PriceProductCustomerGroupStorageDimensionPlugin extends AbstractPlugin implements PriceProductStoragePriceDimensionPluginInterface
{
    /**
     * {@inheritDoc}
     *
     * @api
     *
     * @param int $idProductConcrete
     *
     * @return array<\Generated\Shared\Transfer\PriceProductTransfer>
     */
    public function findProductConcretePrices(int $idProductConcrete): array
    {
        $idBusinessUnitFromCurrentCustomer = $this->getFactory()
            ->createCustomerGroupFinder()
            ->findCurrentCustomerGroupId();

        if (!$idBusinessUnitFromCurrentCustomer) {
            return [];
        }

        return $this->getFactory()
            ->createPriceProductCustomerGroupConcreteReader()
            ->findPriceCustomerGroupConcrete(
                $idProductConcrete,
                $idBusinessUnitFromCurrentCustomer,
            );
    }

    /**
     * {@inheritDoc}
     *
     * @api
     *
     * @param int $idProductAbstract
     *
     * @return array<\Generated\Shared\Transfer\PriceProductTransfer>
     */
    public function findProductAbstractPrices(int $idProductAbstract): array
    {
        $idBusinessUnitFromCurrentCustomer = $this->getFactory()
            ->createCustomerGroupFinder()
            ->findCurrentCustomerGroupId();

        if (!$idBusinessUnitFromCurrentCustomer) {
            return [];
        }

        return $this->getFactory()
            ->createPriceProductCustomerGroupAbstractReader()
            ->findProductAbstractPrices(
                $idProductAbstract,
                $idBusinessUnitFromCurrentCustomer,
            );
    }

    /**
     * {@inheritDoc}
     *
     * @api
     *
     * @return string
     */
    public function getDimensionName(): string
    {
        return $this->getFactory()
            ->getPriceProductCustomerGroupStorageConfig()
            ->getPriceDimensionCustomerGroup();
    }
}

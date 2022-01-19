<?php

declare(strict_types = 1);

namespace ValanticSpryker\Zed\PriceProductCustomerGroupStorage\Business\Model;

use Generated\Shared\Transfer\PriceProductCustomerGroupStorageTransfer;
use ValanticSpryker\Zed\PriceProductCustomerGroupStorage\PriceProductCustomerGroupStorageConfig;

class PriceGrouper implements PriceGrouperInterface
{
    /**
     * @var string
     */
    protected const PRICES = 'prices';

    /**
     * @param \Generated\Shared\Transfer\PriceProductCustomerGroupStorageTransfer $priceProductCustomerGroupStorageTransfer
     * @param array $pricesData
     *
     * @return \Generated\Shared\Transfer\PriceProductCustomerGroupStorageTransfer
     */
    public function groupPricesData(
        PriceProductCustomerGroupStorageTransfer $priceProductCustomerGroupStorageTransfer,
        array $pricesData = []
    ): PriceProductCustomerGroupStorageTransfer {
        $groupedPrices = $this->groupPrices($priceProductCustomerGroupStorageTransfer);

        if (isset($pricesData[static::PRICES])) {
            $groupedPrices = array_replace_recursive($pricesData[static::PRICES], $groupedPrices);
        }

        $groupedPrices = $this->filterPriceData($groupedPrices, PriceProductCustomerGroupStorageConfig::PRICE_DATA);

        return $priceProductCustomerGroupStorageTransfer->setPrices(
            $this->formatData($groupedPrices),
        );
    }

    /**
     * @param \Generated\Shared\Transfer\PriceProductCustomerGroupStorageTransfer $priceProductCustomerGroupStorageTransfer
     *
     * @return array
     */
    protected function groupPrices(
        PriceProductCustomerGroupStorageTransfer $priceProductCustomerGroupStorageTransfer
    ): array {
        $groupedPrices = [];
        foreach ($priceProductCustomerGroupStorageTransfer->getUngroupedPrices() as $priceTransfer) {
            if ($priceTransfer->getGrossPrice() || $priceTransfer->getNetPrice()) {
                $groupedPrices[$priceTransfer->getIdCustomerGroup()][$priceTransfer->getCurrencyCode()][PriceProductCustomerGroupStorageConfig::PRICE_DATA] = $priceTransfer->getPriceData();
            }

            $groupedPrices[$priceTransfer->getIdCustomerGroup()][$priceTransfer->getCurrencyCode()][PriceProductCustomerGroupStorageConfig::PRICE_MODE_GROSS][$priceTransfer->getPriceType()] = $priceTransfer->getGrossPrice();
            $groupedPrices[$priceTransfer->getIdCustomerGroup()][$priceTransfer->getCurrencyCode()][PriceProductCustomerGroupStorageConfig::PRICE_MODE_NET][$priceTransfer->getPriceType()] = $priceTransfer->getNetPrice();
        }

        return $groupedPrices;
    }

    /**
     * @param array $priceData
     * @param string $excludeKey
     *
     * @return array
     */
    protected function filterPriceData(array $priceData, string $excludeKey): array
    {
        $priceData = array_filter($priceData, function ($v, $k) use ($excludeKey) {
            if ($k === $excludeKey) {
                return true;
            }

            return (bool)$v;
        }, ARRAY_FILTER_USE_BOTH);

        foreach ($priceData as $key => &$value) {
            if (is_array($value)) {
                $value = $this->filterPriceData($value, $excludeKey);

                if (!$value || $value === [$excludeKey => null]) {
                    unset($priceData[$key]);
                }
            }
        }

        return $priceData;
    }

    /**
     * @param array $prices
     *
     * @return array
     */
    protected function formatData(array $prices): array
    {
        if ($prices) {
            return [
                static::PRICES => $prices,
            ];
        }

        return [];
    }
}

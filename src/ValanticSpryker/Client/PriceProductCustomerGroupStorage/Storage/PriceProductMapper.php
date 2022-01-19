<?php

declare(strict_types = 1);

namespace ValanticSpryker\Client\PriceProductCustomerGroupStorage\Storage;

use Generated\Shared\Transfer\CurrencyTransfer;
use Generated\Shared\Transfer\MoneyValueTransfer;
use Generated\Shared\Transfer\PriceProductDimensionTransfer;
use Generated\Shared\Transfer\PriceProductStorageTransfer;
use Generated\Shared\Transfer\PriceProductTransfer;
use ValanticSpryker\Client\PriceProductCustomerGroupStorage\Dependency\Service\PriceProductCustomerGroupStorageToPriceProductServiceInterface;
use ValanticSpryker\Client\PriceProductCustomerGroupStorage\PriceProductCustomerGroupStorageConfig;
use ValanticSpryker\Shared\PriceProductCustomerGroupStorage\PriceProductCustomerGroupStorageConfig as SharedPriceProductCustomerGroupStorageConfig;

class PriceProductMapper implements PriceProductMapperInterface
{
    /**
     * @var string
     */
    protected const INDEX_SEPARATOR = '-';

    /**
     * @var \ValanticSpryker\Client\PriceProductCustomerGroupStorage\PriceProductCustomerGroupStorageConfig
     */
    protected $priceProductCustomerGroupStorageConfig;

    /**
     * @var \ValanticSpryker\Client\PriceProductCustomerGroupStorage\Dependency\Service\PriceProductCustomerGroupStorageToPriceProductServiceInterface
     */
    protected $priceProductService;

    /**
     * @param \ValanticSpryker\Client\PriceProductCustomerGroupStorage\PriceProductCustomerGroupStorageConfig $priceProductCustomerGroupStorageConfig
     * @param \ValanticSpryker\Client\PriceProductCustomerGroupStorage\Dependency\Service\PriceProductCustomerGroupStorageToPriceProductServiceInterface $priceProductService
     */
    public function __construct(
        PriceProductCustomerGroupStorageConfig $priceProductCustomerGroupStorageConfig,
        PriceProductCustomerGroupStorageToPriceProductServiceInterface $priceProductService
    ) {
        $this->priceProductCustomerGroupStorageConfig = $priceProductCustomerGroupStorageConfig;
        $this->priceProductService = $priceProductService;
    }

    /**
     * @param \Generated\Shared\Transfer\PriceProductStorageTransfer $priceProductStorageTransfer
     *
     * @return array<\Generated\Shared\Transfer\PriceProductTransfer>
     */
    public function mapPriceProductStorageTransferToPriceProductTransfers(
        PriceProductStorageTransfer $priceProductStorageTransfer
    ): array {
        $priceProductTransfers = [];

        foreach ($priceProductStorageTransfer->getPrices() as $idCustomerGroup => $pricesPerCustomerGroup) {
            foreach ($pricesPerCustomerGroup as $currencyCode => $prices) {
                foreach (SharedPriceProductCustomerGroupStorageConfig::PRICE_MODES as $priceMode) {
                    if (!isset($prices[$priceMode])) {
                        continue;
                    }

                    foreach ($prices[$priceMode] as $priceType => $priceAmount) {
                        $priceProductTransfer = $this->findProductTransferInCollection(
                            $idCustomerGroup,
                            $currencyCode,
                            $priceType,
                            $priceProductTransfers,
                        );

                        $priceProductTransfer->setGroupKey($this->priceProductService->buildPriceProductGroupKey($priceProductTransfer))
                            ->setIsMergeable(true);

                        if ($priceMode === SharedPriceProductCustomerGroupStorageConfig::PRICE_GROSS_MODE) {
                            $priceProductTransfer->getMoneyValue()->setGrossAmount($priceAmount);

                            continue;
                        }

                        $priceProductTransfer->getMoneyValue()->setNetAmount($priceAmount);
                    }
                }
            }
        }

        return array_values($priceProductTransfers);
    }

    /**
     * @param int $idCustomerGroup
     * @param string $currencyCode
     * @param string $priceType
     * @param array<\Generated\Shared\Transfer\PriceProductTransfer> $priceProductTransfers
     *
     * @return \Generated\Shared\Transfer\PriceProductTransfer
     */
    protected function findProductTransferInCollection(
        int $idCustomerGroup,
        string $currencyCode,
        string $priceType,
        array &$priceProductTransfers
    ): PriceProductTransfer {
        $index = implode(static::INDEX_SEPARATOR, [
            $idCustomerGroup,
            $currencyCode,
            $priceType,
        ]);

        if (!isset($priceProductTransfers[$index])) {
            $priceProductTransfers[$index] = (new PriceProductTransfer())
                ->setPriceDimension(
                    (new PriceProductDimensionTransfer())
                        ->setType($this->priceProductCustomerGroupStorageConfig->getPriceDimensionCustomerGroup())
                        ->setIdCustomerGroup($idCustomerGroup),
                )
                ->setMoneyValue(
                    (new MoneyValueTransfer())
                        ->setCurrency((new CurrencyTransfer())->setCode($currencyCode)),
                )
                ->setPriceTypeName($priceType);
        }

        return $priceProductTransfers[$index];
    }
}

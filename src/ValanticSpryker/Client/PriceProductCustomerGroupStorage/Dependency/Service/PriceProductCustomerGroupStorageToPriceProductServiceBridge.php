<?php

declare(strict_types=1);

namespace ValanticSpryker\Client\PriceProductCustomerGroupStorage\Dependency\Service;

use Generated\Shared\Transfer\PriceProductTransfer;

class PriceProductCustomerGroupStorageToPriceProductServiceBridge implements PriceProductCustomerGroupStorageToPriceProductServiceInterface
{
    /**
     * @var \Spryker\Service\PriceProduct\PriceProductServiceInterface
     */
    protected $priceProductService;

    /**
     * @param \Spryker\Service\PriceProduct\PriceProductServiceInterface $priceProductService
     */
    public function __construct($priceProductService)
    {
        $this->priceProductService = $priceProductService;
    }

    /**
     * @param \Generated\Shared\Transfer\PriceProductTransfer $priceProductTransfer
     *
     * @return string
     */
    public function buildPriceProductGroupKey(PriceProductTransfer $priceProductTransfer): string
    {
        return $this->priceProductService
            ->buildPriceProductGroupKey($priceProductTransfer);
    }
}

<?php

declare(strict_types = 1);

namespace ValanticSpryker\Client\PriceProductCustomerGroupStorage\Storage;

use Generated\Shared\Transfer\PriceProductStorageTransfer;
use ValanticSpryker\Client\PriceProductCustomerGroupStorage\Dependency\Client\PriceProductCustomerGroupStorageToStorageClientInterface;
use ValanticSpryker\Shared\PriceProductCustomerGroupStorage\PriceProductCustomerGroupStorageConstants;

class PriceProductCustomerGroupAbstractReader implements PriceProductCustomerGroupAbstractReaderInterface
{
    /**
     * @var \ValanticSpryker\Client\PriceProductCustomerGroupStorage\Dependency\Client\PriceProductCustomerGroupStorageToStorageClientInterface
     */
    protected $storageClient;

    /**
     * @var \ValanticSpryker\Client\PriceProductCustomerGroupStorage\Storage\PriceProductCustomerGroupKeyGeneratorInterface
     */
    protected $priceStorageKeyGenerator;

    /**
     * @var \ValanticSpryker\Client\PriceProductCustomerGroupStorage\Storage\PriceProductMapperInterface
     */
    protected $priceProductMapper;

    /**
     * @param \ValanticSpryker\Client\PriceProductCustomerGroupStorage\Dependency\Client\PriceProductCustomerGroupStorageToStorageClientInterface $storageClient
     * @param \ValanticSpryker\Client\PriceProductCustomerGroupStorage\Storage\PriceProductCustomerGroupKeyGeneratorInterface $priceStorageKeyGenerator
     * @param \ValanticSpryker\Client\PriceProductCustomerGroupStorage\Storage\PriceProductMapperInterface $priceProductMapper
     */
    public function __construct(
        PriceProductCustomerGroupStorageToStorageClientInterface $storageClient,
        PriceProductCustomerGroupKeyGeneratorInterface $priceStorageKeyGenerator,
        PriceProductMapperInterface $priceProductMapper
    ) {
        $this->storageClient = $storageClient;
        $this->priceStorageKeyGenerator = $priceStorageKeyGenerator;
        $this->priceProductMapper = $priceProductMapper;
    }

    /**
     * @param int $idProductAbstract
     * @param int $idCustomerGroup
     *
     * @return array<\Generated\Shared\Transfer\PriceProductTransfer>
     */
    public function findProductAbstractPrices(int $idProductAbstract, int $idCustomerGroup): array
    {
        $key = $this->priceStorageKeyGenerator->generateKey(
            PriceProductCustomerGroupStorageConstants::PRICE_PRODUCT_ABSTRACT_CUSTOMER_GROUP_RESOURCE_NAME,
            $idProductAbstract,
            $idCustomerGroup,
        );

        return $this->findPriceProductTransfers($key);
    }

    /**
     * @param string $key
     *
     * @return array<\Generated\Shared\Transfer\PriceProductTransfer>
     */
    protected function findPriceProductTransfers(string $key): array
    {
        $priceData = $this->storageClient->get($key);

        if (!$priceData) {
            return [];
        }

        $priceProductStorageTransfer = new PriceProductStorageTransfer();
        $priceProductStorageTransfer->fromArray($priceData, true);

        return $this->priceProductMapper->mapPriceProductStorageTransferToPriceProductTransfers($priceProductStorageTransfer);
    }
}

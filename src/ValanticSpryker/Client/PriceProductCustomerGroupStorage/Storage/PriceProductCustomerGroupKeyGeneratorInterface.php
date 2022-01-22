<?php

declare(strict_types = 1);

namespace ValanticSpryker\Client\PriceProductCustomerGroupStorage\Storage;

interface PriceProductCustomerGroupKeyGeneratorInterface
{
    /**
     * @param string $resourceName
     * @param int $idProduct
     * @param int $idCustomerGroup
     *
     * @return string
     */
    public function generateKey(string $resourceName, int $idProduct, int $idCustomerGroup): string;
}

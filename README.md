# Price Product Customer Group Storage

[![Minimum PHP Version](https://img.shields.io/badge/php-%3E%3D%207.3-8892BF.svg)](https://php.net/)

This modules is used for saving customer group prices into storage and contains plugins for reading them.

### Install package
```
composer req valantic-spryker/price-product-customer-group-storage
```

### Register plugins
`src/Pyz/Zed/Event/EventDependencyProvider.php`

```
use ValanticSpryker\Zed\PriceProductCustomerGroupStorage\Communication\Plugin\Event\Subscriber\PriceProductCustomerGroupStorageEventSubscriber;

...

public function getEventSubscriberCollection()
{
    ...
    $eventSubscriberCollection->add(new PriceProductCustomerGroupStorageEventSubscriber());
    ...
}
```

`src/Pyz/Zed/Synchronization/SynchronizationDependencyProvider.php`

```
use \ValanticSpryker\Zed\PriceProductCustomerGroupStorage\Communication\Plugin\Synchronization\PriceProductAbstractCustomerGroupSynchronizationDataBulkPlugin
use \ValanticSpryker\Zed\PriceProductCustomerGroupStorage\Communication\Plugin\Synchronization\PriceProductConcreteCustomerGroupSynchronizationDataBulkPlugin

...

protected function getSynchronizationDataPlugins(): array
{
    return [
        ...
        new PriceProductAbstractCustomerGroupSynchronizationDataBulkPlugin(),
        new PriceProductConcreteCustomerGroupSynchronizationDataBulkPlugin(),
    ];
}
```

`src/Pyz/Client/PriceProductStorage/PriceProductStorageDependencyProvider.php`

```
use ValanticSpryker\Client\PriceProductCustomerGroupStorage\Plugin\PriceProductStorageExtension\PriceProductCustomerGroupStorageDimensionPlugin;

...

public function getPriceDimensionStorageReaderPlugins(): array
{
    return [
        ...
        new PriceProductCustomerGroupStorageDimensionPlugin(),
    ];
}
```

`src/Pyz/Zed/EventBehavior/EventBehaviorDependencyProvider.php`

```
use ValanticSpryker\Zed\PriceProductCustomerGroupStorage\Communication\Plugin\Event\PriceProductAbstractCustomerGroupEventResourceBulkRepositoryPlugin;
use ValanticSpryker\Zed\PriceProductCustomerGroupStorage\Communication\Plugin\Event\PriceProductConcreteCustomerGroupEventResourceBulkRepositoryPlugin;

...

protected function getEventTriggerResourcePlugins()
{
    return [
        ...
        new PriceProductAbstractCustomerGroupEventResourceBulkRepositoryPlugin(),
        new PriceProductConcreteCustomerGroupEventResourceBulkRepositoryPlugin(),
    ];
}
```

### Create project level module config
`src/Pyz/Zed/PriceProductCustomerGroupStorage/PriceProductCustomerGroupStorageConfig.php`

```
<?php

declare(strict_types = 1);

namespace Pyz\Zed\PriceProductCustomerGroupStorage;

use Pyz\Zed\Synchronization\SynchronizationConfig;
use ValanticSpryker\Zed\PriceProductCustomerGroupStorage\PriceProductCustomerGroupStorageConfig as VsyPriceProductCustomerGroupStorageConfig;

class PriceProductCustomerGroupStorageConfig extends VsyPriceProductCustomerGroupStorageConfig
{
    /**
     * @return string|null
     */
    public function getPriceProductConcreteCustomerGroupSynchronizationPoolName(): ?string
    {
        return SynchronizationConfig::DEFAULT_SYNCHRONIZATION_POOL_NAME;
    }

    /**
     * @return string|null
     */
    public function getPriceProductAbstractCustomerGroupSynchronizationPoolName(): ?string
    {
        return SynchronizationConfig::DEFAULT_SYNCHRONIZATION_POOL_NAME;
    }
}
```

### Enable event behavior
`src/Pyz/Zed/PriceProductCustomerGroup/Persistence/Propel/Schema/vsy_price_product_customer_group.schema.xml`

```
<?xml version="1.0"?>
<database
    xmlns="spryker:schema-01"
    xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance"
    name="zed"
    xsi:schemaLocation="spryker:schema-01 https://static.spryker.com/schema-01.xsd"
    namespace="Orm\Zed\PriceProductCustomerGroup\Persistence"
    package="src.Orm.Zed.PriceProductCustomerGroup.Persistence"
>

    <table name="vsy_price_product_customer_group">
        <behavior name="event">
            <parameter name="vsy_price_product_customer_group_all" column="*"/>
        </behavior>
    </table>

</database>
```

### Migrate database and generate transfers
`propel:install`, `transfer:generate`

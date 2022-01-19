# Price Product Customer Group Storage

[![Minimum PHP Version](https://img.shields.io/badge/php-%3E%3D%207.4-8892BF.svg)](https://php.net/)

This modules is used for saving customer group prices into storage and contains plugins for reading them.

## Integration

### Add composer registry
```
composer config repositories.gitlab.nxs360.com/461 '{"type": "composer", "url": "https://gitlab.nxs360.com/api/v4/group/461/-/packages/composer/packages.json"}'
```

### Add Gitlab domain
```
composer config gitlab-domains gitlab.nxs360.com
```

### Authentication
Go to Gitlab and create a personal access token. Then create an **auth.json** file:
```
composer config gitlab-token.gitlab.nxs360.com <personal_access_token>
```

Make sure to add **auth.json** to your **.gitignore**.

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

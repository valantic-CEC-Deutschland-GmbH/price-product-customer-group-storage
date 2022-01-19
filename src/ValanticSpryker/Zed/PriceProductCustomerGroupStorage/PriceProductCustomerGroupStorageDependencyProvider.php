<?php

declare(strict_types = 1);

namespace ValanticSpryker\Zed\PriceProductCustomerGroupStorage;

use Spryker\Zed\Kernel\AbstractBundleDependencyProvider;
use Spryker\Zed\Kernel\Container;
use ValanticSpryker\Zed\PriceProductCustomerGroupStorage\Dependency\Facade\PriceProductCustomerGroupStorageToEventBehaviorFacadeBridge;

/**
 * @method \ValanticSpryker\Zed\PriceProductCustomerGroupStorage\PriceProductCustomerGroupStorageConfig getConfig()
 */
class PriceProductCustomerGroupStorageDependencyProvider extends AbstractBundleDependencyProvider
{
    /**
     * @var string
     */
    public const PROPEL_QUERY_PRICE_PRODUCT_CUSTOMER_GROUP = 'PROPEL_QUERY_PRICE_PRODUCT_CUSTOMER_GROUP';

    /**
     * @var string
     */
    public const FACADE_EVENT_BEHAVIOR = 'FACADE_EVENT_BEHAVIOR';

    /**
     * @var string
     */
    public const PLUGINS_PRICE_PRODUCT_CUSTOMER_GROUP_STORAGE_FILTER = 'PLUGINS_PRICE_PRODUCT_CUSTOMER_GROUP_STORAGE_FILTER';

    /**
     * @param \Spryker\Zed\Kernel\Container $container
     *
     * @return \Spryker\Zed\Kernel\Container
     */
    public function provideCommunicationLayerDependencies(Container $container): Container
    {
        $container = $this->addEventBehaviorFacade($container);

        return $container;
    }

    /**
     * @param \Spryker\Zed\Kernel\Container $container
     *
     * @return \Spryker\Zed\Kernel\Container
     */
    public function provideBusinessLayerDependencies(Container $container): Container
    {
        $container = $this->addEventBehaviorFacade($container);
        $container = $this->addPriceProductCustomerGroupStorageFilterPlugins($container);

        return $container;
    }

    /**
     * @param \Spryker\Zed\Kernel\Container $container
     *
     * @return \Spryker\Zed\Kernel\Container
     */
    public function providePersistenceLayerDependencies(Container $container): Container
    {
        $container = $this->addPropelPriceProductCustomerGroupQuery($container);

        return $container;
    }

    /**
     * @param \Spryker\Zed\Kernel\Container $container
     *
     * @return \Spryker\Zed\Kernel\Container
     */
    protected function addEventBehaviorFacade(Container $container): Container
    {
        $container->set(static::FACADE_EVENT_BEHAVIOR, function (Container $container) {
            return new PriceProductCustomerGroupStorageToEventBehaviorFacadeBridge(
                $container->getLocator()->eventBehavior()->facade(),
            );
        });

        return $container;
    }

    /**
     * @param \Spryker\Zed\Kernel\Container $container
     *
     * @return \Spryker\Zed\Kernel\Container
     */
    protected function addPropelPriceProductCustomerGroupQuery(Container $container): Container
    {
        $container->set(static::PROPEL_QUERY_PRICE_PRODUCT_CUSTOMER_GROUP, $container->factory(function () {
            return VsyPriceProductCustomerGroupQuery::create();
        }));

        return $container;
    }

    /**
     * @param \Spryker\Zed\Kernel\Container $container
     *
     * @return \Spryker\Zed\Kernel\Container
     */
    protected function addPriceProductCustomerGroupStorageFilterPlugins(Container $container): Container
    {
        $container->set(static::PLUGINS_PRICE_PRODUCT_CUSTOMER_GROUP_STORAGE_FILTER, function () {
            return $this->getPriceProductCustomerGroupStorageFilterPlugins();
        });

        return $container;
    }

    /**
     * @return array<\ValanticSpryker\Zed\PriceProductCustomerGroupStorageExtension\Dependency\Plugin\PriceProductCustomerGroupStorageFilterPluginInterface>
     */
    protected function getPriceProductCustomerGroupStorageFilterPlugins(): array
    {
        return [];
    }
}

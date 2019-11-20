<?php

namespace FondOfSpryker\Zed\CompanyUserReference;

use FondOfSpryker\Zed\CompanyUserReference\Dependency\Facade\CompanyUserReferenceToSequenceNumberFacadeBridge;
use FondOfSpryker\Zed\CompanyUserReference\Dependency\Facade\CompanyUserReferenceToStoreFacadeBridge;
use Orm\Zed\CompanyUser\Persistence\SpyCompanyUserQuery;
use Spryker\Zed\Kernel\AbstractBundleDependencyProvider;
use Spryker\Zed\Kernel\Container;

class CompanyUserReferenceDependencyProvider extends AbstractBundleDependencyProvider
{
    public const PROPEL_QUERY_COMPANY_USER = 'PROPEL_QUERY_COMPANY_USER';

    public const FACADE_SEQUENCE_NUMBER = 'FACADE_SEQUENCE_NUMBER';
    public const FACADE_STORE = 'FACADE_STORE';

    /**
     * @param \Spryker\Zed\Kernel\Container $container
     *
     * @return \Spryker\Zed\Kernel\Container
     */
    public function provideBusinessLayerDependencies(Container $container): Container
    {
        $container = parent::provideBusinessLayerDependencies($container);

        $container = $this->addSequenceNumberFacade($container);
        $container = $this->addStoreFacade($container);

        return $container;
    }

    /**
     * @param \Spryker\Zed\Kernel\Container $container
     *
     * @return \Spryker\Zed\Kernel\Container
     */
    protected function addSequenceNumberFacade(Container $container): Container
    {
        $container[static::FACADE_SEQUENCE_NUMBER] = static function (Container $container) {
            return new CompanyUserReferenceToSequenceNumberFacadeBridge(
                $container->getLocator()->sequenceNumber()->facade()
            );
        };

        return $container;
    }

    /**
     * @param \Spryker\Zed\Kernel\Container $container
     *
     * @return \Spryker\Zed\Kernel\Container
     */
    protected function addStoreFacade(Container $container): Container
    {
        $container[static::FACADE_STORE] = static function (Container $container) {
            return new CompanyUserReferenceToStoreFacadeBridge(
                $container->getLocator()->store()->facade()
            );
        };

        return $container;
    }

    /**
     * @param \Spryker\Zed\Kernel\Container $container
     *
     * @return \Spryker\Zed\Kernel\Container
     */
    public function providePersistenceLayerDependencies(Container $container): Container
    {
        $container = parent::providePersistenceLayerDependencies($container);

        $container = $this->addCompanyUserPropelQuery($container);

        return $container;
    }

    /**
     * @param \Spryker\Zed\Kernel\Container $container
     *
     * @return \Spryker\Zed\Kernel\Container
     */
    protected function addCompanyUserPropelQuery(Container $container): Container
    {
        $container[static::PROPEL_QUERY_COMPANY_USER] = static function () {
            return SpyCompanyUserQuery::create();
        };

        return $container;
    }
}

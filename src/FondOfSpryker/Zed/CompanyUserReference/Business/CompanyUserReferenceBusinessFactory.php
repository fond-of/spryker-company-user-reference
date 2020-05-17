<?php

namespace FondOfSpryker\Zed\CompanyUserReference\Business;

use FondOfSpryker\Zed\CompanyUserReference\Business\Model\CompanyUserReader;
use FondOfSpryker\Zed\CompanyUserReference\Business\Model\CompanyUserReaderInterface;
use FondOfSpryker\Zed\CompanyUserReference\Business\Model\CompanyUserReferenceGenerator;
use FondOfSpryker\Zed\CompanyUserReference\Business\Model\CompanyUserReferenceGeneratorInterface;
use FondOfSpryker\Zed\CompanyUserReference\CompanyUserReferenceDependencyProvider;
use FondOfSpryker\Zed\CompanyUserReference\Dependency\Facade\CompanyUserReferenceToSequenceNumberFacadeInterface;
use FondOfSpryker\Zed\CompanyUserReference\Dependency\Facade\CompanyUserReferenceToStoreFacadeInterface;
use Spryker\Zed\Kernel\Business\AbstractBusinessFactory;

/**
 * @method \FondOfSpryker\Zed\CompanyUserReference\CompanyUserReferenceConfig getConfig()
 * @method \FondOfSpryker\Zed\CompanyUserReference\Persistence\CompanyUserReferenceRepositoryInterface getRepository()
 */
class CompanyUserReferenceBusinessFactory extends AbstractBusinessFactory
{
    /**
     * @return \FondOfSpryker\Zed\CompanyUserReference\Business\Model\CompanyUserReferenceGeneratorInterface
     */
    public function createCompanyUserReferenceGenerator(): CompanyUserReferenceGeneratorInterface
    {
        return new CompanyUserReferenceGenerator(
            $this->getSequenceNumberFacade(),
            $this->getStoreFacade(),
            $this->getConfig()
        );
    }

    /**
     * @return \FondOfSpryker\Zed\CompanyUserReference\Business\Model\CompanyUserReaderInterface
     */
    public function createCompanyUserReader(): CompanyUserReaderInterface
    {
        return new CompanyUserReader(
            $this->getRepository(),
            $this->getCompanyUserHydrationPlugins()
        );
    }

    /**
     * @return \FondOfSpryker\Zed\CompanyUserReference\Dependency\Facade\CompanyUserReferenceToStoreFacadeInterface
     */
    protected function getStoreFacade(): CompanyUserReferenceToStoreFacadeInterface
    {
        return $this->getProvidedDependency(CompanyUserReferenceDependencyProvider::FACADE_STORE);
    }

    /**
     * @return \FondOfSpryker\Zed\CompanyUserReference\Dependency\Facade\CompanyUserReferenceToSequenceNumberFacadeInterface
     */
    protected function getSequenceNumberFacade(): CompanyUserReferenceToSequenceNumberFacadeInterface
    {
        return $this->getProvidedDependency(CompanyUserReferenceDependencyProvider::FACADE_SEQUENCE_NUMBER);
    }

    /**
     * @return \Spryker\Zed\CompanyUserExtension\Dependency\Plugin\CompanyUserHydrationPluginInterface[]
     */
    protected function getCompanyUserHydrationPlugins(): array
    {
        return $this->getProvidedDependency(CompanyUserReferenceDependencyProvider::PLUGINS_COMPANY_USER_HYDRATE);
    }
}

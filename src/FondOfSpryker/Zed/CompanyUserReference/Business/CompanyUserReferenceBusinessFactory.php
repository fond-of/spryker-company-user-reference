<?php

namespace FondOfSpryker\Zed\CompanyUserReference\Business;

use FondOfSpryker\Zed\CompanyUserReference\Business\Generator\CompanyUserReferenceGenerator;
use FondOfSpryker\Zed\CompanyUserReference\Business\Generator\CompanyUserReferenceGeneratorInterface;
use FondOfSpryker\Zed\CompanyUserReference\Business\Reader\CompanyBusinessUnitReader;
use FondOfSpryker\Zed\CompanyUserReference\Business\Reader\CompanyBusinessUnitReaderInterface;
use FondOfSpryker\Zed\CompanyUserReference\Business\Reader\CompanyReader;
use FondOfSpryker\Zed\CompanyUserReference\Business\Reader\CompanyReaderInterface;
use FondOfSpryker\Zed\CompanyUserReference\Business\Reader\CompanyUserReader;
use FondOfSpryker\Zed\CompanyUserReference\Business\Reader\CompanyUserReaderInterface;
use FondOfSpryker\Zed\CompanyUserReference\CompanyUserReferenceDependencyProvider;
use FondOfSpryker\Zed\CompanyUserReference\Dependency\Facade\CompanyUserReferenceToCompanyBusinessUnitFacadeInterface;
use FondOfSpryker\Zed\CompanyUserReference\Dependency\Facade\CompanyUserReferenceToCompanyFacadeInterface;
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
     * @return \FondOfSpryker\Zed\CompanyUserReference\Business\Generator\CompanyUserReferenceGeneratorInterface
     */
    public function createCompanyUserReferenceGenerator(): CompanyUserReferenceGeneratorInterface
    {
        return new CompanyUserReferenceGenerator(
            $this->getSequenceNumberFacade(),
            $this->getStoreFacade(),
            $this->getConfig(),
        );
    }

    /**
     * @return \FondOfSpryker\Zed\CompanyUserReference\Business\Reader\CompanyUserReaderInterface
     */
    public function createCompanyUserReader(): CompanyUserReaderInterface
    {
        return new CompanyUserReader(
            $this->getRepository(),
            $this->getCompanyUserHydrationPlugins(),
        );
    }

    /**
     * @return \FondOfSpryker\Zed\CompanyUserReference\Business\Reader\CompanyReaderInterface
     */
    public function createCompanyReader(): CompanyReaderInterface
    {
        return new CompanyReader(
            $this->getRepository(),
            $this->getCompanyFacade(),
        );
    }

    /**
     * @return \FondOfSpryker\Zed\CompanyUserReference\Business\Reader\CompanyBusinessUnitReaderInterface
     */
    public function createCompanyBusinessUnitReader(): CompanyBusinessUnitReaderInterface
    {
        return new CompanyBusinessUnitReader(
            $this->getRepository(),
            $this->getCompanyBusinessUnitFacade(),
        );
    }

    /**
     * @return \FondOfSpryker\Zed\CompanyUserReference\Dependency\Facade\CompanyUserReferenceToCompanyFacadeInterface
     */
    protected function getCompanyFacade(): CompanyUserReferenceToCompanyFacadeInterface
    {
        return $this->getProvidedDependency(CompanyUserReferenceDependencyProvider::FACADE_COMPANY);
    }

    /**
     * @return \FondOfSpryker\Zed\CompanyUserReference\Dependency\Facade\CompanyUserReferenceToCompanyBusinessUnitFacadeInterface
     */
    protected function getCompanyBusinessUnitFacade(): CompanyUserReferenceToCompanyBusinessUnitFacadeInterface
    {
        return $this->getProvidedDependency(CompanyUserReferenceDependencyProvider::FACADE_COMPANY_BUSINESS_UNIT);
    }

    /**
     * @return \FondOfSpryker\Zed\CompanyUserReference\Dependency\Facade\CompanyUserReferenceToSequenceNumberFacadeInterface
     */
    protected function getSequenceNumberFacade(): CompanyUserReferenceToSequenceNumberFacadeInterface
    {
        return $this->getProvidedDependency(CompanyUserReferenceDependencyProvider::FACADE_SEQUENCE_NUMBER);
    }

    /**
     * @return \FondOfSpryker\Zed\CompanyUserReference\Dependency\Facade\CompanyUserReferenceToStoreFacadeInterface
     */
    protected function getStoreFacade(): CompanyUserReferenceToStoreFacadeInterface
    {
        return $this->getProvidedDependency(CompanyUserReferenceDependencyProvider::FACADE_STORE);
    }

    /**
     * @return array<\Spryker\Zed\CompanyUserExtension\Dependency\Plugin\CompanyUserHydrationPluginInterface>
     */
    protected function getCompanyUserHydrationPlugins(): array
    {
        return $this->getProvidedDependency(CompanyUserReferenceDependencyProvider::PLUGINS_COMPANY_USER_HYDRATE);
    }
}

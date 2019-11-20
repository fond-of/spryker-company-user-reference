<?php

namespace FondOfSpryker\Zed\CompanyUserReference\Business;

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
     * @throws
     *
     * @return \FondOfSpryker\Zed\CompanyUserReference\Dependency\Facade\CompanyUserReferenceToStoreFacadeInterface
     */
    protected function getStoreFacade(): CompanyUserReferenceToStoreFacadeInterface
    {
        return $this->getProvidedDependency(CompanyUserReferenceDependencyProvider::FACADE_STORE);
    }

    /**
     * @throws
     *
     * @return \FondOfSpryker\Zed\CompanyUserReference\Dependency\Facade\CompanyUserReferenceToSequenceNumberFacadeInterface
     */
    protected function getSequenceNumberFacade(): CompanyUserReferenceToSequenceNumberFacadeInterface
    {
        return $this->getProvidedDependency(CompanyUserReferenceDependencyProvider::FACADE_SEQUENCE_NUMBER);
    }

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
}

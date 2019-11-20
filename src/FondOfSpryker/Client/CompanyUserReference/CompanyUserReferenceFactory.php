<?php

namespace FondOfSpryker\Client\CompanyUserReference;

use FondOfSpryker\Client\CompanyUserReference\Dependency\Client\CompanyUserReferenceToZedRequestClientInterface;
use FondOfSpryker\Client\CompanyUserReference\Zed\CompanyUserReferenceStub;
use FondOfSpryker\Client\CompanyUserReference\Zed\CompanyUserReferenceStubInterface;
use Spryker\Client\Kernel\AbstractFactory;

class CompanyUserReferenceFactory extends AbstractFactory
{
    /**
     * @return \FondOfSpryker\Client\CompanyUserReference\Zed\CompanyUserReferenceStubInterface
     */
    public function createZedCompanyUserReferenceStub(): CompanyUserReferenceStubInterface
    {
        return new CompanyUserReferenceStub($this->getZedRequestClient());
    }

    /**
     * @throws
     *
     * @return \FondOfSpryker\Client\CompanyUserReference\Dependency\Client\CompanyUserReferenceToZedRequestClientInterface
     */
    protected function getZedRequestClient(): CompanyUserReferenceToZedRequestClientInterface
    {
        return $this->getProvidedDependency(CompanyUserReferenceDependencyProvider::CLIENT_ZED_REQUEST);
    }
}

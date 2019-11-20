<?php

namespace FondOfSpryker\Zed\CompanyUserReference\Persistence;

use FondOfSpryker\Zed\CompanyUserReference\CompanyUserReferenceDependencyProvider;
use Orm\Zed\CompanyUser\Persistence\SpyCompanyUserQuery;
use Spryker\Zed\Kernel\Persistence\AbstractPersistenceFactory;

/**
 * @method \FondOfSpryker\Zed\CompanyUserReference\CompanyUserReferenceConfig getConfig()
 * @method \FondOfSpryker\Zed\CompanyUserReference\Persistence\CompanyUserReferenceRepositoryInterface getRepository()
 */
class CompanyUserReferencePersistenceFactory extends AbstractPersistenceFactory
{
    /**
     * @return \Orm\Zed\CompanyUser\Persistence\SpyCompanyUserQuery
     */
    public function getCompanyUserPropelQuery(): SpyCompanyUserQuery
    {
        return $this->getProvidedDependency(CompanyUserReferenceDependencyProvider::PROPEL_QUERY_COMPANY_USER);
    }
}

<?php

namespace FondOfSpryker\Zed\CompanyUserReference\Persistence;

use Generated\Shared\Transfer\CompanyUserTransfer;

interface CompanyUserReferenceRepositoryInterface
{
    /**
     * @param string $companyUserReference
     *
     * @return \Generated\Shared\Transfer\CompanyUserTransfer|null
     */
    public function findCompanyUserByCompanyUserReference(string $companyUserReference): ?CompanyUserTransfer;
}

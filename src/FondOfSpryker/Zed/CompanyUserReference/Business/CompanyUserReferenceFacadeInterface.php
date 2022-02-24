<?php

namespace FondOfSpryker\Zed\CompanyUserReference\Business;

use Generated\Shared\Transfer\CompanyTransfer;
use Generated\Shared\Transfer\CompanyUserResponseTransfer;
use Generated\Shared\Transfer\CompanyUserTransfer;

interface CompanyUserReferenceFacadeInterface
{
    /**
     * Specifications:
     * - Generate company user reference.
     *
     * @api
     *
     * @return string
     */
    public function generateCompanyUserReference(): string;

    /**
     * Specifications:
     *  - Finds company user by reference.
     *  - Returns company user response transfer.
     *
     * @api
     *
     * @param \Generated\Shared\Transfer\CompanyUserTransfer $companyUserTransfer
     *
     * @return \Generated\Shared\Transfer\CompanyUserResponseTransfer
     */
    public function findCompanyUserByCompanyUserReference(
        CompanyUserTransfer $companyUserTransfer
    ): CompanyUserResponseTransfer;

    /**
     * Specifications:
     *  - Finds company by reference.
     *  - Returns company transfer.
     *
     * @api
     *
     * @param string $companyUserReference
     *
     * @return \Generated\Shared\Transfer\CompanyTransfer|null
     */
    public function getCompanyByCompanyUserReference(
        string $companyUserReference
    ): ?CompanyTransfer;
}

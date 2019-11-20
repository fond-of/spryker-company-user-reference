<?php

namespace FondOfSpryker\Zed\CompanyUserReference\Business;

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
}

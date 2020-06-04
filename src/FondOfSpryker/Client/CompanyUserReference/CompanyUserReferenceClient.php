<?php

namespace FondOfSpryker\Client\CompanyUserReference;

use Generated\Shared\Transfer\CompanyUserResponseTransfer;
use Generated\Shared\Transfer\CompanyUserTransfer;
use Spryker\Client\Kernel\AbstractClient;

/**
 * @method \FondOfSpryker\Client\CompanyUserReference\CompanyUserReferenceFactory getFactory()
 */
class CompanyUserReferenceClient extends AbstractClient implements CompanyUserReferenceClientInterface
{
    /**
     * {@inheritDoc}
     *
     * @api
     *
     * @param \Generated\Shared\Transfer\CompanyUserTransfer $companyUserTransfer
     *
     * @return \Generated\Shared\Transfer\CompanyUserResponseTransfer
     */
    public function findCompanyUserByCompanyUserReference(CompanyUserTransfer $companyUserTransfer): CompanyUserResponseTransfer
    {
        return $this->getFactory()->createZedCompanyUserReferenceStub()
            ->findCompanyUserByCompanyUserReference($companyUserTransfer);
    }
}

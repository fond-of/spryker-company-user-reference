<?php

namespace FondOfSpryker\Zed\CompanyUserReference\Business;

use Generated\Shared\Transfer\CompanyUserResponseTransfer;
use Generated\Shared\Transfer\CompanyUserTransfer;
use Spryker\Zed\Kernel\Business\AbstractFacade;

/**
 * @method \FondOfSpryker\Zed\CompanyUserReference\Persistence\CompanyUserReferenceRepositoryInterface getRepository()
 * @method \FondOfSpryker\Zed\CompanyUserReference\Business\CompanyUserReferenceBusinessFactory getFactory()
 */
class CompanyUserReferenceFacade extends AbstractFacade implements CompanyUserReferenceFacadeInterface
{
    /**
     * {@inheritdoc}
     *
     * @api
     *
     * @return string
     */
    public function generateCompanyUserReference(): string
    {
        return $this->getFactory()->createCompanyUserReferenceGenerator()->generate();
    }

    /**
     * {@inheritdoc}
     *
     * @api
     *
     * @param \Generated\Shared\Transfer\CompanyUserTransfer $companyUserTransfer
     *
     * @return \Generated\Shared\Transfer\CompanyUserResponseTransfer
     */
    public function findCompanyUserByCompanyUserReference(
        CompanyUserTransfer $companyUserTransfer
    ): CompanyUserResponseTransfer {
        return $this->getFactory()->createCompanyUserReader()
            ->findCompanyUserByCompanyUserReference($companyUserTransfer);
    }
}

<?php

namespace FondOfSpryker\Zed\CompanyUserReference\Communication\Plugin\CompanyUserExtension;

use Generated\Shared\Transfer\CompanyUserResponseTransfer;
use Spryker\Zed\CompanyUserExtension\Dependency\Plugin\CompanyUserPreSavePluginInterface;
use Spryker\Zed\Kernel\Communication\AbstractPlugin;

/**
 * @method \FondOfSpryker\Zed\CompanyUserReference\CompanyUserReferenceConfig getConfig()
 * @method \FondOfSpryker\Zed\CompanyUserReference\Business\CompanyUserReferenceFacadeInterface getFacade()
 */
class AddReferenceCompanyUserPreSavePlugin extends AbstractPlugin implements CompanyUserPreSavePluginInterface
{
    /**
     * {@inheritDoc}
     *
     * @api
     *
     * @param \Generated\Shared\Transfer\CompanyUserResponseTransfer $companyUserResponseTransfer
     *
     * @return \Generated\Shared\Transfer\CompanyUserResponseTransfer
     */
    public function preSave(CompanyUserResponseTransfer $companyUserResponseTransfer): CompanyUserResponseTransfer
    {
        $companyUser = $companyUserResponseTransfer->getCompanyUser();

        if ($companyUser !== null && $companyUser->getCompanyUserReference() === null) {
            $companyUserReference = $this->getFacade()->generateCompanyUserReference();
            $companyUser->setCompanyUserReference($companyUserReference);
        }

        return $companyUserResponseTransfer;
    }
}

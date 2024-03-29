<?php

namespace FondOfSpryker\Zed\CompanyUserReference\Business\Reader;

use FondOfSpryker\Zed\CompanyUserReference\Dependency\Facade\CompanyUserReferenceToCompanyBusinessUnitFacadeInterface;
use FondOfSpryker\Zed\CompanyUserReference\Persistence\CompanyUserReferenceRepositoryInterface;
use Generated\Shared\Transfer\CompanyBusinessUnitTransfer;

class CompanyBusinessUnitReader implements CompanyBusinessUnitReaderInterface
{
    /**
     * @var \FondOfSpryker\Zed\CompanyUserReference\Persistence\CompanyUserReferenceRepositoryInterface
     */
    protected $repository;

    /**
     * @var \FondOfSpryker\Zed\CompanyUserReference\Dependency\Facade\CompanyUserReferenceToCompanyBusinessUnitFacadeInterface
     */
    protected $companyBusinessUnitFacade;

    /**
     * @param \FondOfSpryker\Zed\CompanyUserReference\Persistence\CompanyUserReferenceRepositoryInterface $repository
     * @param \FondOfSpryker\Zed\CompanyUserReference\Dependency\Facade\CompanyUserReferenceToCompanyBusinessUnitFacadeInterface $companyBusinessUnitFacade
     */
    public function __construct(
        CompanyUserReferenceRepositoryInterface $repository,
        CompanyUserReferenceToCompanyBusinessUnitFacadeInterface $companyBusinessUnitFacade
    ) {
        $this->repository = $repository;
        $this->companyBusinessUnitFacade = $companyBusinessUnitFacade;
    }

    /**
     * @param string $companyUserReference
     *
     * @return \Generated\Shared\Transfer\CompanyBusinessUnitTransfer|null
     */
    public function getByCompanyUserReference(string $companyUserReference): ?CompanyBusinessUnitTransfer
    {
        $idCompanyBusinessUnit = $this->repository->findIdCompanyBusinessUnitByCompanyUserReference(
            $companyUserReference,
        );

        if ($idCompanyBusinessUnit === null) {
            return null;
        }

        return $this->companyBusinessUnitFacade->findCompanyBusinessUnitById($idCompanyBusinessUnit);
    }
}

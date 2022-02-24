<?php

namespace FondOfSpryker\Zed\CompanyUserReference\Business\Reader;

use FondOfSpryker\Zed\CompanyUserReference\Dependency\Facade\CompanyUserReferenceToCompanyFacadeInterface;
use FondOfSpryker\Zed\CompanyUserReference\Persistence\CompanyUserReferenceRepositoryInterface;
use Generated\Shared\Transfer\CompanyTransfer;

class CompanyReader implements CompanyReaderInterface
{
    /**
     * @var \FondOfSpryker\Zed\CompanyUserReference\Persistence\CompanyUserReferenceRepositoryInterface
     */
    protected $repository;

    /**
     * @var \FondOfSpryker\Zed\CompanyUserReference\Dependency\Facade\CompanyUserReferenceToCompanyFacadeInterface
     */
    protected $companyFacade;

    /**
     * @param \FondOfSpryker\Zed\CompanyUserReference\Persistence\CompanyUserReferenceRepositoryInterface $repository
     * @param \FondOfSpryker\Zed\CompanyUserReference\Dependency\Facade\CompanyUserReferenceToCompanyFacadeInterface $companyFacade
     */
    public function __construct(
        CompanyUserReferenceRepositoryInterface $repository,
        CompanyUserReferenceToCompanyFacadeInterface $companyFacade
    ) {
        $this->repository = $repository;
        $this->companyFacade = $companyFacade;
    }

    /**
     * @param string $companyUserReference
     *
     * @return \Generated\Shared\Transfer\CompanyTransfer|null
     */
    public function getByCompanyUserReference(string $companyUserReference): ?CompanyTransfer
    {
        $idCompany = $this->repository->findIdCompanyByCompanyUserReference($companyUserReference);

        if ($idCompany === null) {
            return null;
        }

        return $this->companyFacade->findCompanyById($idCompany);
    }
}

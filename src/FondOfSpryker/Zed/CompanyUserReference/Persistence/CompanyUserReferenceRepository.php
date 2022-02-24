<?php

namespace FondOfSpryker\Zed\CompanyUserReference\Persistence;

use Generated\Shared\Transfer\CompanyUserTransfer;
use Spryker\Zed\Kernel\Persistence\AbstractRepository;

/**
 * @method \FondOfSpryker\Zed\CompanyUserReference\Persistence\CompanyUserReferencePersistenceFactory getFactory()
 */
class CompanyUserReferenceRepository extends AbstractRepository implements CompanyUserReferenceRepositoryInterface
{
    /**
     * @param string $companyUserReference
     *
     * @return \Generated\Shared\Transfer\CompanyUserTransfer|null
     */
    public function findCompanyUserByCompanyUserReference(string $companyUserReference): ?CompanyUserTransfer
    {
        $query = $this->getFactory()
            ->getCompanyUserPropelQuery()
            ->clear()
            ->filterByCompanyUserReference($companyUserReference);

        $companyUserEntityTransfer = $this->buildQueryFromCriteria($query)->findOne();

        if ($companyUserEntityTransfer === null) {
            return null;
        }

        return (new CompanyUserTransfer())->fromArray(
            $companyUserEntityTransfer->toArray(),
            true,
        );
    }

    /**
     * @param string $companyUserReference
     *
     * @return int|null
     */
    public function findIdCompanyByCompanyUserReference(string $companyUserReference): ?int
    {
        $entity = $this->getFactory()
            ->getCompanyUserPropelQuery()
            ->clear()
            ->filterByCompanyUserReference($companyUserReference)
            ->findOne();

        if ($entity === null) {
            return null;
        }

        return $entity->getFkCompany();
    }

    /**
     * @param string $companyUserReference
     *
     * @return int|null
     */
    public function findIdCompanyBusinessUnitByCompanyUserReference(string $companyUserReference): ?int
    {
        $entity = $this->getFactory()
            ->getCompanyUserPropelQuery()
            ->clear()
            ->filterByCompanyUserReference($companyUserReference)
            ->findOne();

        if ($entity === null) {
            return null;
        }

        return $entity->getFkCompanyBusinessUnit();
    }
}

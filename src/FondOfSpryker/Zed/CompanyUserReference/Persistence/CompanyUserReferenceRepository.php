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
            ->filterByCompanyUserReference($companyUserReference);

        $companyUserEntityTransfer = $this->buildQueryFromCriteria($query)->findOne();

        if ($companyUserEntityTransfer === null) {
            return null;
        }

        $companyUserTransfer = (new CompanyUserTransfer())->fromArray(
            $companyUserEntityTransfer->toArray(),
            true
        );

        return $companyUserTransfer;
    }
}

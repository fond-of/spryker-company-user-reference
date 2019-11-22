<?php

namespace FondOfSpryker\Zed\CompanyUserReference\Business\Model;

use FondOfSpryker\Shared\CompanyUserReference\CompanyUserReferenceConstants;
use FondOfSpryker\Zed\CompanyUserReference\CompanyUserReferenceConfig;
use FondOfSpryker\Zed\CompanyUserReference\Dependency\Facade\CompanyUserReferenceToSequenceNumberFacadeInterface;
use FondOfSpryker\Zed\CompanyUserReference\Dependency\Facade\CompanyUserReferenceToStoreFacadeInterface;
use Generated\Shared\Transfer\SequenceNumberSettingsTransfer;

class CompanyUserReferenceGenerator implements CompanyUserReferenceGeneratorInterface
{
    /**
     * @var \FondOfSpryker\Zed\CompanyUserReference\Dependency\Facade\CompanyUserReferenceToSequenceNumberFacadeInterface
     */
    protected $sequenceNumberFacade;

    /**
     * @var \FondOfSpryker\Zed\CompanyUserReference\Dependency\Facade\CompanyUserReferenceToStoreFacadeInterface
     */
    protected $storeFacade;

    /**
     * @var \FondOfSpryker\Zed\CompanyUserReference\CompanyUserReferenceConfig
     */
    protected $config;

    /**
     * @param \FondOfSpryker\Zed\CompanyUserReference\Dependency\Facade\CompanyUserReferenceToSequenceNumberFacadeInterface $sequenceNumberFacade
     * @param \FondOfSpryker\Zed\CompanyUserReference\Dependency\Facade\CompanyUserReferenceToStoreFacadeInterface $storeFacade
     * @param \FondOfSpryker\Zed\CompanyUserReference\CompanyUserReferenceConfig $config
     */
    public function __construct(
        CompanyUserReferenceToSequenceNumberFacadeInterface $sequenceNumberFacade,
        CompanyUserReferenceToStoreFacadeInterface $storeFacade,
        CompanyUserReferenceConfig $config
    ) {
        $this->sequenceNumberFacade = $sequenceNumberFacade;
        $this->storeFacade = $storeFacade;
        $this->config = $config;
    }

    /**
     * @return string
     */
    public function generate(): string
    {
        $sequenceNumberSettingsTransfer = (new SequenceNumberSettingsTransfer())
            ->setName(CompanyUserReferenceConstants::NAME_COMPANY_USER_REFERENCE)
            ->setPrefix($this->getPrefix());

        return $sequenceNumberSettingsTransfer;
    }

    /**
     * @return void
     */
    protected function getPrefix(): string
    {
        $sequenceNumberPrefixParts = [
            $this->storeFacade->getCurrentStore()->getName(),
            $this->config->getEnvironmentPrefix(),
            CompanyUserReferenceConstants::PREFIX_COMPANY_USER_REFERENCE,
        ];

        return implode($this->getUniqueIdentifierSeparator(), $sequenceNumberPrefixParts)
            . $this->getUniqueIdentifierSeparator();
    }

    /**
     * @return string
     */
    protected function getUniqueIdentifierSeparator(): string
    {
        return '-';
    }
}

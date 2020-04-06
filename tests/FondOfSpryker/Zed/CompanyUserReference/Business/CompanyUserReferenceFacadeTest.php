<?php

namespace FondOfSpryker\Zed\CompanyUserReference\Business;

use Codeception\Test\Unit;
use FondOfSpryker\Zed\CompanyUserReference\Business\Model\CompanyUserReaderInterface;
use FondOfSpryker\Zed\CompanyUserReference\Business\Model\CompanyUserReferenceGeneratorInterface;
use Generated\Shared\Transfer\CompanyUserResponseTransfer;
use Generated\Shared\Transfer\CompanyUserTransfer;

class CompanyUserReferenceFacadeTest extends Unit
{
    /**
     * @var \FondOfSpryker\Zed\CompanyUserReference\Business\CompanyUserReferenceFacade
     */
    protected $companyUserReferenceFacade;

    /**
     * @var string
     */
    protected $generatedString;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\FondOfSpryker\Zed\CompanyUserReference\Business\CompanyUserReferenceBusinessFactory
     */
    protected $companyUserReferenceBusinessFactoryMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\FondOfSpryker\Zed\CompanyUserReference\Business\Model\CompanyUserReferenceGeneratorInterface
     */
    protected $companyUserReferenceGeneratorInterfaceMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Generated\Shared\Transfer\CompanyUserTransfer
     */
    protected $companyUserTransferMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\FondOfSpryker\Zed\CompanyUserReference\Business\Model\CompanyUserReaderInterface
     */
    protected $companyUserReaderInterfaceMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Generated\Shared\Transfer\CompanyUserResponseTransfer
     */
    protected $companyUserResponseTransferMock;

    /**
     * @return void
     */
    protected function _before(): void
    {
        $this->generatedString = 'generated-string';

        $this->companyUserReferenceBusinessFactoryMock = $this->getMockBuilder(CompanyUserReferenceBusinessFactory::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->companyUserReferenceGeneratorInterfaceMock = $this->getMockBuilder(CompanyUserReferenceGeneratorInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->companyUserTransferMock = $this->getMockBuilder(CompanyUserTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->companyUserReaderInterfaceMock = $this->getMockBuilder(CompanyUserReaderInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->companyUserResponseTransferMock = $this->getMockBuilder(CompanyUserResponseTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->companyUserReferenceFacade = new CompanyUserReferenceFacade();
        $this->companyUserReferenceFacade->setFactory($this->companyUserReferenceBusinessFactoryMock);
    }

    /**
     * @return void
     */
    public function testGenerateCompanyUserReference(): void
    {
        $this->companyUserReferenceBusinessFactoryMock->expects($this->atLeastOnce())
            ->method('createCompanyUserReferenceGenerator')
            ->willReturn($this->companyUserReferenceGeneratorInterfaceMock);

        $this->companyUserReferenceGeneratorInterfaceMock->expects($this->atLeastOnce())
            ->method('generate')
            ->willReturn($this->generatedString);

        $this->assertSame(
            $this->generatedString,
            $this->companyUserReferenceFacade->generateCompanyUserReference()
        );
    }

    /**
     * @return void
     */
    public function testFindCompanyUserByCompanyUserReference(): void
    {
        $this->companyUserReferenceBusinessFactoryMock->expects($this->atLeastOnce())
            ->method('createCompanyUserReader')
            ->willReturn($this->companyUserReaderInterfaceMock);

        $this->companyUserReaderInterfaceMock->expects($this->atLeastOnce())
            ->method('findCompanyUserByCompanyUserReference')
            ->with($this->companyUserTransferMock)
            ->willReturn($this->companyUserResponseTransferMock);

        $this->assertInstanceOf(
            CompanyUserResponseTransfer::class,
            $this->companyUserReferenceFacade->findCompanyUserByCompanyUserReference(
                $this->companyUserTransferMock
            )
        );
    }
}

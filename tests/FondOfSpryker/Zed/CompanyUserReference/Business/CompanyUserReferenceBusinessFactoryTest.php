<?php

namespace FondOfSpryker\Zed\CompanyUserReference\Business;

use Codeception\Test\Unit;
use FondOfSpryker\Zed\CompanyUserReference\Business\Generator\CompanyUserReferenceGeneratorInterface;
use FondOfSpryker\Zed\CompanyUserReference\Business\Reader\CompanyUserReaderInterface;
use FondOfSpryker\Zed\CompanyUserReference\CompanyUserReferenceConfig;
use FondOfSpryker\Zed\CompanyUserReference\CompanyUserReferenceDependencyProvider;
use FondOfSpryker\Zed\CompanyUserReference\Dependency\Facade\CompanyUserReferenceToSequenceNumberFacadeInterface;
use FondOfSpryker\Zed\CompanyUserReference\Dependency\Facade\CompanyUserReferenceToStoreFacadeInterface;
use FondOfSpryker\Zed\CompanyUserReference\Persistence\CompanyUserReferenceRepository;
use Spryker\Zed\Kernel\Container;

class CompanyUserReferenceBusinessFactoryTest extends Unit
{
    /**
     * @var \FondOfSpryker\Zed\CompanyUserReference\Business\CompanyUserReferenceBusinessFactory
     */
    protected $companyUserReferenceBusinessFactory;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\FondOfSpryker\Zed\CompanyUserReference\CompanyUserReferenceConfig
     */
    protected $companyUserReferenceConfigMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Spryker\Zed\Kernel\Container
     */
    protected $containerMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\FondOfSpryker\Zed\CompanyUserReference\Dependency\Facade\CompanyUserReferenceToSequenceNumberFacadeInterface
     */
    protected $companyUserReferenceToSequenceNumberFacadeInterfaceMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\FondOfSpryker\Zed\CompanyUserReference\Dependency\Facade\CompanyUserReferenceToStoreFacadeInterface
     */
    protected $companyUserReferenceToStoreFacadeInterfaceMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\FondOfSpryker\Zed\CompanyUserReference\Persistence\CompanyUserReferenceRepository
     */
    protected $companyUserReferenceRepositoryMock;

    /**
     * @return void
     */
    protected function _before(): void
    {
        $this->companyUserReferenceConfigMock = $this->getMockBuilder(CompanyUserReferenceConfig::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->containerMock = $this->getMockBuilder(Container::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->companyUserReferenceToSequenceNumberFacadeInterfaceMock = $this->getMockBuilder(CompanyUserReferenceToSequenceNumberFacadeInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->companyUserReferenceToStoreFacadeInterfaceMock = $this->getMockBuilder(CompanyUserReferenceToStoreFacadeInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->companyUserReferenceRepositoryMock = $this->getMockBuilder(CompanyUserReferenceRepository::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->companyUserReferenceBusinessFactory = new CompanyUserReferenceBusinessFactory();
        $this->companyUserReferenceBusinessFactory->setRepository($this->companyUserReferenceRepositoryMock);
        $this->companyUserReferenceBusinessFactory->setConfig($this->companyUserReferenceConfigMock);
        $this->companyUserReferenceBusinessFactory->setContainer($this->containerMock);
    }

    /**
     * @return void
     */
    public function testCreateCompanyUserReferenceGenerator(): void
    {
        $this->containerMock->expects($this->atLeastOnce())
            ->method('has')
            ->willReturn(true);

        $this->containerMock->expects($this->atLeastOnce())
            ->method('get')
            ->withConsecutive(
                [CompanyUserReferenceDependencyProvider::FACADE_SEQUENCE_NUMBER],
                [CompanyUserReferenceDependencyProvider::FACADE_STORE],
            )->willReturnOnConsecutiveCalls(
                $this->companyUserReferenceToSequenceNumberFacadeInterfaceMock,
                $this->companyUserReferenceToStoreFacadeInterfaceMock,
            );

        $this->assertInstanceOf(
            CompanyUserReferenceGeneratorInterface::class,
            $this->companyUserReferenceBusinessFactory->createCompanyUserReferenceGenerator(),
        );
    }

    /**
     * @return void
     */
    public function testCreateCompanyUserReader(): void
    {
        $this->containerMock->expects($this->atLeastOnce())
            ->method('has')
            ->willReturn(true);

        $this->containerMock->expects($this->atLeastOnce())
            ->method('get')
            ->with(CompanyUserReferenceDependencyProvider::PLUGINS_COMPANY_USER_HYDRATE)
            ->willReturn([]);

        $this->assertInstanceOf(
            CompanyUserReaderInterface::class,
            $this->companyUserReferenceBusinessFactory->createCompanyUserReader(),
        );
    }
}

<?php

namespace FondOfSpryker\Zed\CompanyUserReference\Business;

use Codeception\Test\Unit;
use FondOfSpryker\Zed\CompanyUserReference\Business\Generator\CompanyUserReferenceGenerator;
use FondOfSpryker\Zed\CompanyUserReference\Business\Reader\CompanyReader;
use FondOfSpryker\Zed\CompanyUserReference\Business\Reader\CompanyUserReader;
use FondOfSpryker\Zed\CompanyUserReference\CompanyUserReferenceConfig;
use FondOfSpryker\Zed\CompanyUserReference\CompanyUserReferenceDependencyProvider;
use FondOfSpryker\Zed\CompanyUserReference\Dependency\Facade\CompanyUserReferenceToCompanyFacadeInterface;
use FondOfSpryker\Zed\CompanyUserReference\Dependency\Facade\CompanyUserReferenceToSequenceNumberFacadeInterface;
use FondOfSpryker\Zed\CompanyUserReference\Dependency\Facade\CompanyUserReferenceToStoreFacadeInterface;
use FondOfSpryker\Zed\CompanyUserReference\Persistence\CompanyUserReferenceRepository;
use Spryker\Zed\Kernel\Container;

class CompanyUserReferenceBusinessFactoryTest extends Unit
{
    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\FondOfSpryker\Zed\CompanyUserReference\CompanyUserReferenceConfig
     */
    protected $configMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Spryker\Zed\Kernel\Container
     */
    protected $containerMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\FondOfSpryker\Zed\CompanyUserReference\Persistence\CompanyUserReferenceRepository
     */
    protected $repositoryMock;

    /**
     * @var \FondOfSpryker\Zed\CompanyUserReference\Dependency\Facade\CompanyUserReferenceToCompanyFacadeInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $companyFacadeMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\FondOfSpryker\Zed\CompanyUserReference\Dependency\Facade\CompanyUserReferenceToSequenceNumberFacadeInterface
     */
    protected $sequenceNumberFacadeMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\FondOfSpryker\Zed\CompanyUserReference\Dependency\Facade\CompanyUserReferenceToStoreFacadeInterface
     */
    protected $storeFacadeMock;

    /**
     * @var \FondOfSpryker\Zed\CompanyUserReference\Business\CompanyUserReferenceBusinessFactory
     */
    protected $factory;

    /**
     * @return void
     */
    protected function _before(): void
    {
        $this->configMock = $this->getMockBuilder(CompanyUserReferenceConfig::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->containerMock = $this->getMockBuilder(Container::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->repositoryMock = $this->getMockBuilder(CompanyUserReferenceRepository::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->companyFacadeMock = $this->getMockBuilder(CompanyUserReferenceToCompanyFacadeInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->sequenceNumberFacadeMock = $this->getMockBuilder(CompanyUserReferenceToSequenceNumberFacadeInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->storeFacadeMock = $this->getMockBuilder(CompanyUserReferenceToStoreFacadeInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->factory = new CompanyUserReferenceBusinessFactory();
        $this->factory->setRepository($this->repositoryMock);
        $this->factory->setConfig($this->configMock);
        $this->factory->setContainer($this->containerMock);
    }

    /**
     * @return void
     */
    public function testCreateCompanyUserReferenceGenerator(): void
    {
        $this->containerMock->expects(static::atLeastOnce())
            ->method('has')
            ->willReturn(true);

        $this->containerMock->expects(static::atLeastOnce())
            ->method('get')
            ->withConsecutive(
                [CompanyUserReferenceDependencyProvider::FACADE_SEQUENCE_NUMBER],
                [CompanyUserReferenceDependencyProvider::FACADE_STORE],
            )->willReturnOnConsecutiveCalls(
                $this->sequenceNumberFacadeMock,
                $this->storeFacadeMock,
            );

        static::assertInstanceOf(
            CompanyUserReferenceGenerator::class,
            $this->factory->createCompanyUserReferenceGenerator(),
        );
    }

    /**
     * @return void
     */
    public function testCreateCompanyUserReader(): void
    {
        $this->containerMock->expects(static::atLeastOnce())
            ->method('has')
            ->willReturn(true);

        $this->containerMock->expects(static::atLeastOnce())
            ->method('get')
            ->with(CompanyUserReferenceDependencyProvider::PLUGINS_COMPANY_USER_HYDRATE)
            ->willReturn([]);

        static::assertInstanceOf(CompanyUserReader::class, $this->factory->createCompanyUserReader());
    }

    /**
     * @return void
     */
    public function testCreateCompanyReader(): void
    {
        $this->containerMock->expects(static::atLeastOnce())
            ->method('has')
            ->willReturn(true);

        $this->containerMock->expects(static::atLeastOnce())
            ->method('get')
            ->withConsecutive(
                [CompanyUserReferenceDependencyProvider::FACADE_COMPANY],
            )->willReturnOnConsecutiveCalls(
                $this->companyFacadeMock,
            );

        static::assertInstanceOf(CompanyReader::class, $this->factory->createCompanyReader());
    }
}

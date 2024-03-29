<?php

namespace FondOfSpryker\Client\CompanyUserReference;

use Codeception\Test\Unit;
use FondOfSpryker\Client\CompanyUserReference\Dependency\Client\CompanyUserReferenceToZedRequestClientInterface;
use FondOfSpryker\Client\CompanyUserReference\Zed\CompanyUserReferenceStubInterface;
use Spryker\Client\Kernel\Container;

class CompanyUserReferenceFactoryTest extends Unit
{
    /**
     * @var \FondOfSpryker\Client\CompanyUserReference\CompanyUserReferenceFactory
     */
    protected $companyUserReferenceFactory;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Spryker\Client\Kernel\Container
     */
    protected $containerMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\FondOfSpryker\Client\CompanyUserReference\Dependency\Client\CompanyUserReferenceToZedRequestClientInterface
     */
    protected $companyUserReferenceToZedRequestClientInterfaceMock;

    /**
     * @return void
     */
    protected function _before(): void
    {
        $this->containerMock = $this->getMockBuilder(Container::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->companyUserReferenceToZedRequestClientInterfaceMock = $this->getMockBuilder(CompanyUserReferenceToZedRequestClientInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->companyUserReferenceFactory = new CompanyUserReferenceFactory();
        $this->companyUserReferenceFactory->setContainer($this->containerMock);
    }

    /**
     * @return void
     */
    public function testCreateZedCompanyUserReferenceStub(): void
    {
        $this->containerMock->expects($this->atLeastOnce())
            ->method('has')
            ->willReturn(true);

        $this->containerMock->expects($this->atLeastOnce())
            ->method('get')
            ->with(CompanyUserReferenceDependencyProvider::CLIENT_ZED_REQUEST)
            ->willReturn($this->companyUserReferenceToZedRequestClientInterfaceMock);

        $this->assertInstanceOf(
            CompanyUserReferenceStubInterface::class,
            $this->companyUserReferenceFactory->createZedCompanyUserReferenceStub(),
        );
    }
}

<?php

namespace FondOfSpryker\Zed\CompanyUserReference\Business\Model;

interface CompanyUserReferenceGeneratorInterface
{
    /**
     * @return string
     */
    public function generate(): string;
}

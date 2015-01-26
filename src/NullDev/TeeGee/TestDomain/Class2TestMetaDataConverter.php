<?php

namespace NullDev\TeeGee\TestDomain;

class Class2TestMetaDataConverter
{
    /**
     * Namespace separator.
     */
    const NS = '\\';

    protected $classMetaData;
    protected $settings;

    public function __construct($classMetaData, $settings)
    {
        $this->classMetaData = $classMetaData;
        $this->settings      = $settings;
    }

    public function getUnitTestFilePath()
    {
        $zzzz = str_replace(
            $this->settings->getRootPath(),
            $this->settings->getUnitTestPath(),
            $this->getClassFilePathWithoutExtension()
        );

        return $zzzz . 'Test.php';
    }

    public function getFunctionalTestFilePath()
    {
        $zzzz = str_replace(
            $this->settings->getRootPath(),
            $this->settings->getFunctionalTestPath(),
            $this->getClassFilePathWithoutExtension()
        );

        return $zzzz . 'Test.php';
    }

    public function getIntegrationTestFilePath()
    {
        $zzzz = str_replace(
            $this->settings->getRootPath(),
            $this->settings->getIntegrationalTestPath(),
            $this->getClassFilePathWithoutExtension()
        );

        return $zzzz . 'Test.php';
    }

    public function getUnitTestFqdn()
    {
        //TestClass fqdn is base on unit test base namespace
        $testFqdn = $this->getUnitTestBaseNamespace();

        //And FQDN with removed base namespace.
        $testFqdn .= substr(
            $this->classMetaData->getFullyQualifiedClassName(),
            strlen($this->getBaseNamespace())
        );
        //And added Test to end of class name.
        $testFqdn .= 'Test';

        return $testFqdn;
    }

    public function getFunctionalTestFqdn()
    {
        //TestClass fqdn is base on functional test base namespace
        $testFqdn = $this->getFunctionalTestBaseNamespace();

        //And FQDN with removed base namespace.
        $testFqdn .= substr(
            $this->classMetaData->getFullyQualifiedClassName(),
            strlen($this->getBaseNamespace())
        );
        //And added Test to end of class name.
        $testFqdn .= 'Test';

        return $testFqdn;
    }

    public function getIntegrationTestFqdn()
    {
        //TestClass fqdn is base on integration test base namespace
        $testFqdn = $this->getIntegrationTestBaseNamespace();

        //And FQDN with removed base namespace.
        $testFqdn .= substr(
            $this->classMetaData->getFullyQualifiedClassName(),
            strlen($this->getBaseNamespace())
        );
        //And added Test to end of class name.
        $testFqdn .= 'Test';

        return $testFqdn;
    }

    public function getUnitTestBaseNamespace()
    {
        return $this->getBaseNamespace() . 'Tests\\Unit\\';
    }

    public function getFunctionalTestBaseNamespace()
    {
        return $this->getBaseNamespace() . 'Tests\\Functional\\';
    }

    public function getIntegrationTestBaseNamespace()
    {
        return $this->getBaseNamespace() . 'Tests\\Integration\\';
    }

    public function getBaseNamespace()
    {
        return str_replace(
            $this->getClassNamespaceFromRootPathOnwards(),
            '',
            $this->classMetaData->getFullyQualifiedClassName()
        );
    }

    public function getClassFilePathWithoutExtension()
    {
        return str_replace('.php', '', $this->classMetaData->getFilePath());
    }

    public function getClassPathWithoutRootAndExtension()
    {
        return str_replace($this->settings->getRootPath(), '', $this->getClassFilePathWithoutExtension());
    }

    /**
     * Returns namespace from root path onwards.
     *
     * @return mixed
     */
    public function getClassNamespaceFromRootPathOnwards()
    {
        return str_replace(DIRECTORY_SEPARATOR, self::NS, $this->getClassPathWithoutRootAndExtension());
    }

    public function getTestClassName()
    {
        return $this->classMetaData->getClassName() . 'Test';
    }
}

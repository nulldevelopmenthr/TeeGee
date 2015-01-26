<?php
namespace Tests\Integration\NullDev\TeeGee\TestDomain\Class2TestMetaDataConverterTest;

use NullDev\TeeGee\TestDomain\Class2TestMetaDataConverter;
use stdClass;

/**
 *
 */
class Class2TestMetaDataConverterTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var Class2TestMetaDataConverter
     */
    protected $object;

    /**
     */
    protected function setUp()
    {
        $classMetaData = new stdClass();
        $settings      = new stdClass();

        $this->object = new Class2TestMetaDataConverter($classMetaData, $settings);
    }

    /**
     *
     */
    public function testGetUnitTestFilePath()
    {
        $this->markTestIncomplete('TODO');
    }

    /**
     *
     */
    public function testGetFunctionalTestFilePath()
    {
        $this->markTestIncomplete('TODO');
    }

    /**
     *
     */
    public function testGetIntegrationTestFilePath()
    {
        $this->markTestIncomplete('TODO');
    }

    /**
     *
     */
    public function testGetUnitTestFqdn()
    {
        $this->markTestIncomplete('TODO');
    }

    /**
     *
     */
    public function testGetFunctionalTestFqdn()
    {
        $this->markTestIncomplete('TODO');
    }

    /**
     *
     */
    public function testGetIntegrationTestFqdn()
    {
        $this->markTestIncomplete('TODO');
    }

    /**
     *
     */
    public function testGetUnitTestBaseNamespace()
    {
        $this->markTestIncomplete('TODO');
    }

    /**
     *
     */
    public function testGetFunctionalTestBaseNamespace()
    {
        $this->markTestIncomplete('TODO');
    }

    /**
     *
     */
    public function testGetIntegrationTestBaseNamespace()
    {
        $this->markTestIncomplete('TODO');
    }

    /**
     *
     */
    public function testGetBaseNamespace()
    {
        $this->markTestIncomplete('TODO');
    }

    /**
     *
     */
    public function testGetClassFilePathWithoutExtension()
    {
        $this->markTestIncomplete('TODO');
    }

    /**
     *
     */
    public function testGetClassPathWithoutRootAndExtension()
    {
        $this->markTestIncomplete('TODO');
    }

    /**
     *
     */
    public function testGetClassNamespaceFromRootPathOnwards()
    {
        $this->markTestIncomplete('TODO');
    }

    /**
     *
     */
    public function testGetTestClassName()
    {
        $this->markTestIncomplete('TODO');
    }
}

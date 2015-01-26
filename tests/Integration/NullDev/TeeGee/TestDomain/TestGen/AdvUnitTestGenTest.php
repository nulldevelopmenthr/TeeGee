<?php
namespace Tests\Integration\NullDev\TeeGee\TestDomain\TestGen\AdvUnitTestGenTest;

use NullDev\TeeGee\TestDomain\TestGen\AdvUnitTestGen;
use stdClass;

/**
 *
 */
class AdvUnitTestGenTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var AdvUnitTestGen
     */
    protected $object;

    /**
     */
    protected function setUp()
    {
        $testMetaData = new stdClass();

        $this->object = new AdvUnitTestGen($testMetaData);
    }

    /**
     *
     */
    public function testGetVars()
    {
        $this->markTestIncomplete('TODO');
    }

    /**
     *
     */
    public function testGetDependencies()
    {
        $this->markTestIncomplete('TODO');
    }

    /**
     *
     */
    public function testGetDependenciesString()
    {
        $this->markTestIncomplete('TODO');
    }

    /**
     *
     */
    public function testGetConstructorArgumentsString()
    {
        $this->markTestIncomplete('TODO');
    }

    /**
     *
     */
    public function testGetConstructorString()
    {
        $this->markTestIncomplete('TODO');
    }

    /**
     *
     */
    public function testGetMethods()
    {
        $this->markTestIncomplete('TODO');
    }

    /**
     *
     */
    public function testRender()
    {
        $this->markTestIncomplete('TODO');
    }

    /**
     *
     */
    public function testGetNamespace()
    {
        $this->markTestIncomplete('TODO');
    }

    /**
     *
     */
    public function testGetNamespaceString()
    {
        $this->markTestIncomplete('TODO');
    }

    /**
     *
     */
    public function testGetConstructorMethod()
    {
        $this->markTestIncomplete('TODO');
    }
}

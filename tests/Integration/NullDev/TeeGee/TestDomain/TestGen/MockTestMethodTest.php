<?php
namespace Tests\Integration\NullDev\TeeGee\TestDomain\TestGen\MockTestMethodTest;

use NullDev\TeeGee\TestDomain\TestGen\MockTestMethod;
use NullDev\TeeGee\TestDomain\TestMetaData;

/**
 *
 */
class MockTestMethodTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var MockTestMethod
     */
    protected $object;

    /**
     */
    protected function setUp()
    {
        $testMetaData = new TestMetaData();

        $this->object = new MockTestMethod($testMetaData);
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
}

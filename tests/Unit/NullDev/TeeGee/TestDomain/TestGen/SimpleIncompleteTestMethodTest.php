<?php
namespace Tests\Unit\NullDev\TeeGee\TestDomain\TestGen\SimpleIncompleteTestMethodTest;

use NullDev\TeeGee\TestDomain\TestGen\SimpleIncompleteTestMethod;

/**
 *
 */
class SimpleIncompleteTestMethodTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var SimpleIncompleteTestMethod
     */
    protected $object;

    /**
     */
    protected function setUp()
    {

        $this->object = new SimpleIncompleteTestMethod();
    }

    /**
     *
     */
    public function testRender()
    {
        $mockMethod       = new \stdClass();
        $mockMethod->name = 'getSomething';

        $result = $this->object->render($mockMethod);

        $expected = <<<EOF


    /**
     *
     */
    public function testGetSomething()
    {
        \$this->markTestIncomplete('TODO');
    }
EOF;
        $this->assertEquals($expected, $result);
    }
}

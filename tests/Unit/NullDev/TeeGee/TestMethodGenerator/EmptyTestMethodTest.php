<?php
namespace tests\Unit\NullDev\TeeGee\TestMethodGenerator;

use NullDev\TeeGee\TestMethodGenerator\EmptyTestMethod;
use Mockery as m;

/**
 *
 */
class EmptyTestMethodTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var EmptyTestMethod
     */
    protected $object;

    /**
     */
    protected function setUp()
    {
        $mockTestClassMetaData = m::mock('NullDev\TeeGee\TestDomain\TestMetaData');

        $this->object = new EmptyTestMethod($mockTestClassMetaData);
    }

    /**
     *
     */
    public function testGetData()
    {
        $mockMethod = m::mock('ReflectionMethod');
        $mockMethod->shouldReceive('getName')->once()->andReturn('exampleMethod');

        $result = $this->object->getData($mockMethod);

        $expected = [
            'methodName' => 'ExampleMethod',
        ];

        $this->assertEquals($expected, $result);
    }

    /**
     *
     */
    public function testGetTemplatePath()
    {
        $mockMethod = m::mock('ReflectionMethod');

        $result = $this->object->getTemplatePath($mockMethod);

        $expectedPath = __DIR__.'/../../../../../src/NullDev/TeeGee/TestMethodGenerator/Template/EmptyTestMethod.tpl';

        $expected = realpath($expectedPath);

        $this->assertEquals($expected, $result);
    }

    /**
     *
     */
    public function testRender()
    {
        $mockMethod = m::mock('ReflectionMethod');
        $mockMethod->shouldReceive('getName')->once()->andReturn('exampleMethod');

        $result = $this->object->render($mockMethod);

        $expected = file_get_contents(__DIR__.'/results/EmptyTestMethod.renderResult');

        $this->assertEquals($expected, $result);
    }
}

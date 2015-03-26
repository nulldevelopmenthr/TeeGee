<?php
namespace tests\Unit\NullDev\TeeGee\TestMethodGenerator;

use NullDev\TeeGee\TestMethodGenerator\SimpleSetTestMethod;
use Mockery as m;

class SimpleSetTestMethodTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var SimpleSetTestMethod
     */
    protected $object;

    /**
     * @covers NullDev\TeeGee\TestMethodGenerator\SimpleSetTestMethod::getData
     */
    public function testGetData()
    {
        $object = new SimpleSetTestMethod(m::mock('NullDev\TeeGee\TestDomain\TestMetaData'));

        $mockParam = m::mock();
        $mockParam->shouldReceive('getClass')->once()->andReturn(null);

        $mockMethod = m::mock('ReflectionMethod');
        $mockMethod->shouldReceive('getName')->times(5)->andReturn('setProperty');
        $mockMethod->shouldReceive('getParameters')->once()->andReturn([$mockParam]);

        $result = $object->getData($mockMethod);

        $expected = [
            'methodName'       => 'SetProperty',
            'testedMethodName' => 'setProperty',
            'testedValue'      => '\'property\'',
            'propertyName'     => 'property',
            'getMethod'        => 'getProperty',
        ];

        $this->assertEquals($expected, $result);
    }

    /**
     * @covers NullDev\TeeGee\TestMethodGenerator\SimpleSetTestMethod::getData
     */
    public function testGetDataParamIsClass()
    {
        $object = new SimpleSetTestMethod(m::mock('NullDev\TeeGee\TestDomain\TestMetaData'));

        $mockParamReflection = m::mock();
        $mockParamReflection->shouldReceive('getName')->once()->andReturn('SomeClass');

        $mockParam = m::mock();
        $mockParam->shouldReceive('getClass')->twice()->andReturn($mockParamReflection);

        $mockMethod = m::mock('ReflectionMethod');
        $mockMethod->shouldReceive('getName')->times(4)->andReturn('setProperty');
        $mockMethod->shouldReceive('getParameters')->once()->andReturn([$mockParam]);

        $result = $object->getData($mockMethod);

        $expected = [
            'methodName'       => 'SetProperty',
            'testedMethodName' => 'setProperty',
            'testedValue'      => 'm::mock(\'SomeClass\')',
            'propertyName'     => 'property',
            'getMethod'        => 'getProperty',
        ];

        $this->assertEquals($expected, $result);
    }

    /**
     *
     */
    public function testGetTestedValue()
    {
        $object = new SimpleSetTestMethod(m::mock('NullDev\TeeGee\TestDomain\TestMetaData'));

        $mockParam = m::mock();
        $mockParam->shouldReceive('getClass')->once()->andReturn(null);

        $mockMethod = m::mock('ReflectionMethod');
        $mockMethod->shouldReceive('getName')->once()->andReturn('setProperty');
        $mockMethod->shouldReceive('getParameters')->once()->andReturn([$mockParam]);

        $result = $object->getTestedValue($mockMethod);

        $this->assertEquals('\'property\'', $result);
    }

    /**
     *
     */
    public function testGetTestedValueParamIsClass()
    {
        $object = new SimpleSetTestMethod(m::mock('NullDev\TeeGee\TestDomain\TestMetaData'));

        $mockParamReflection = m::mock();
        $mockParamReflection->shouldReceive('getName')->once()->andReturn('SomeClass');

        $mockParam = m::mock();
        $mockParam->shouldReceive('getClass')->twice()->andReturn($mockParamReflection);

        $mockMethod = m::mock('ReflectionMethod');
        $mockMethod->shouldReceive('getParameters')->once()->andReturn([$mockParam]);

        $result = $object->getTestedValue($mockMethod);

        $this->assertEquals("m::mock('SomeClass')", $result);
    }

    /**
     *
     */
    public function testGetGetMethod()
    {
        $object = new SimpleSetTestMethod(m::mock('NullDev\TeeGee\TestDomain\TestMetaData'));

        $mockMethod = m::mock('ReflectionMethod');
        $mockMethod->shouldReceive('getName')->once()->andReturn('setProperty');

        $result = $object->getGetMethod($mockMethod);

        $this->assertEquals('getProperty', $result);
    }

    /**
     *
     */
    public function testExtractPropertyName()
    {
        $object = new SimpleSetTestMethod(m::mock('NullDev\TeeGee\TestDomain\TestMetaData'));

        $mockMethod = m::mock('ReflectionMethod');
        $mockMethod->shouldReceive('getName')->once()->andReturn('setProperty');

        $result = $object->extractPropertyName($mockMethod);

        $this->assertEquals('property', $result);
    }

    /**
     *
     */
    public function testGetTemplatePath()
    {
        $object = new SimpleSetTestMethod(m::mock('NullDev\TeeGee\TestDomain\TestMetaData'));

        $mockMethod = m::mock('ReflectionMethod');

        $result = $object->getTemplatePath($mockMethod);

        $expectedPath = __DIR__.'/../../../../../src/NullDev/TeeGee/TestMethodGenerator/Template/SimpleSetTestMethod.tpl';

        $expected = realpath($expectedPath);

        $this->assertEquals($expected, $result);
    }

    /**
     * @covers NullDev\TeeGee\TestMethodGenerator\SimpleSetTestMethod::render
     */
    public function testRender()
    {
        $object = new SimpleSetTestMethod(m::mock('NullDev\TeeGee\TestDomain\TestMetaData'));

        $mockParam = m::mock();
        $mockParam->shouldReceive('getClass')->once()->andReturn(null);

        $mockMethod = m::mock('ReflectionMethod');
        $mockMethod->shouldReceive('getName')->times(5)->andReturn('setProperty');
        $mockMethod->shouldReceive('getParameters')->once()->andReturn([$mockParam]);

        $result = $object->render($mockMethod);

        $expected = file_get_contents(__DIR__.'/results/SimpleSetTestMethod.renderResult');

        $this->assertEquals($expected, $result);
    }

    /**
     * @covers NullDev\TeeGee\TestMethodGenerator\SimpleSetTestMethod::render
     */
    public function testRenderParamIsClass()
    {
        $object = new SimpleSetTestMethod(m::mock('NullDev\TeeGee\TestDomain\TestMetaData'));

        $mockParamReflection = m::mock();
        $mockParamReflection->shouldReceive('getName')->once()->andReturn('SomeClass');

        $mockParam = m::mock();
        $mockParam->shouldReceive('getClass')->twice()->andReturn($mockParamReflection);

        $mockMethod = m::mock('ReflectionMethod');
        $mockMethod->shouldReceive('getName')->times(4)->andReturn('setProperty');
        $mockMethod->shouldReceive('getParameters')->once()->andReturn([$mockParam]);

        $result = $object->render($mockMethod);

        $expected = file_get_contents(__DIR__.'/results/SimpleSetTestMethodParamIsClass.renderResult');

        $this->assertEquals($expected, $result);
    }
}

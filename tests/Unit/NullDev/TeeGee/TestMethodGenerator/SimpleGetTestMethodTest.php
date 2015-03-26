<?php
namespace tests\Unit\NullDev\TeeGee\TestMethodGenerator;

use NullDev\TeeGee\TestMethodGenerator\SimpleGetTestMethod;
use Mockery as m;

class SimpleGetTestMethodTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var SimpleGetTestMethod
     */
    protected $object;

    /**
     * @covers NullDev\TeeGee\TestMethodGenerator\SimpleGetTestMethod::getData
     */
    public function testGetData()
    {
        $mockReflectionObject = m::mock();
        $mockReflectionObject->shouldReceive('getDefaultProperties')->once()->andReturn(['property' => 'defaultValue']);

        $mockTestClassMetaData = m::mock('NullDev\TeeGee\TestDomain\TestMetaData');
        $mockTestClassMetaData->shouldReceive('getReflectionObject')->once()->andReturn($mockReflectionObject);

        $object = new SimpleGetTestMethod($mockTestClassMetaData);

        $mockMethod = m::mock('ReflectionMethod');
        $mockMethod->shouldReceive('getName')->times(3)->andReturn('getProperty');

        $result = $object->getData($mockMethod);

        $expected = [
            'methodName'       => 'GetProperty',
            'testedMethodName' => 'getProperty',
            'testedValue'      => '\'defaultValue\'',
        ];

        $this->assertEquals($expected, $result);
    }

    /**
     *
     */
    public function testGetDefaultValue()
    {
        $mockReflectionObject = m::mock();
        $mockReflectionObject
            ->shouldReceive('getDefaultProperties')
            ->once()
            ->andReturn(['property' => 'defaultValue']);

        $mockTestClassMetaData = m::mock('NullDev\TeeGee\TestDomain\TestMetaData');
        $mockTestClassMetaData
            ->shouldReceive('getReflectionObject')
            ->once()
            ->andReturn($mockReflectionObject);

        $object = new SimpleGetTestMethod($mockTestClassMetaData);

        $mockMethod = m::mock('ReflectionMethod');
        $mockMethod
            ->shouldReceive('getName')
            ->once()
            ->andReturn('getProperty');

        $result = $object->getDefaultValue($mockMethod);

        $this->assertEquals('defaultValue', $result);
    }

    /**
     *
     */
    public function testExtractPropertyName()
    {
        $object = new SimpleGetTestMethod(m::mock('NullDev\TeeGee\TestDomain\TestMetaData'));

        $mockMethod = m::mock('ReflectionMethod');
        $mockMethod->shouldReceive('getName')->once()->andReturn('getProperty');

        $result = $object->extractPropertyName($mockMethod);

        $this->assertEquals('property', $result);
    }

    /**
     *
     */
    public function testGetTemplatePath()
    {
        $mockTestClassMetaData = m::mock('NullDev\TeeGee\TestDomain\TestMetaData');
        $object                = new SimpleGetTestMethod($mockTestClassMetaData);

        $mockMethod = m::mock('ReflectionMethod');

        $result = $object->getTemplatePath($mockMethod);

        $expectedPath = __DIR__.'/../../../../../src/NullDev/TeeGee/TestMethodGenerator/Template/SimpleGetTestMethod.tpl';

        $expected = realpath($expectedPath);

        $this->assertEquals($expected, $result);
    }

    /**
     * @covers NullDev\TeeGee\TestMethodGenerator\SimpleGetTestMethod::render
     */
    public function testRender()
    {
        $mockReflectionObject = m::mock();
        $mockReflectionObject->shouldReceive('getDefaultProperties')->once()->andReturn(['property' => 'defaultValue']);

        $mockTestClassMetaData = m::mock('NullDev\TeeGee\TestDomain\TestMetaData');
        $mockTestClassMetaData->shouldReceive('getReflectionObject')->once()->andReturn($mockReflectionObject);

        $object = new SimpleGetTestMethod($mockTestClassMetaData);

        $mockMethod = m::mock('ReflectionMethod');
        $mockMethod->shouldReceive('getName')->times(3)->andReturn('getProperty');

        $result = $object->render($mockMethod);

        $expected = file_get_contents(__DIR__.'/results/SimpleGetTestMethod.renderResult');

        $this->assertEquals($expected, $result);
    }
}

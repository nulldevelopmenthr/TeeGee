<?php
namespace tests\Unit\NullDev\TeeGee\TestMethodGenerator;

use NullDev\TeeGee\TestMethodGenerator\MockeryGetTestMethod;
use Mockery as m;

class MockeryGetTestMethodTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var MockeryGetTestMethod
     */
    protected $object;

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

        $object = new MockeryGetTestMethod($mockTestClassMetaData);

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
        $object = new MockeryGetTestMethod(m::mock('NullDev\TeeGee\TestDomain\TestMetaData'));

        $mockMethod = m::mock('ReflectionMethod');
        $mockMethod->shouldReceive('getName')->once()->andReturn('getProperty');

        $result = $object->extractPropertyName($mockMethod);

        $this->assertEquals('property', $result);
    }

    /**
     *
     */
    public function testGetMethodArguments()
    {
        $object = new MockeryGetTestMethod(m::mock('NullDev\TeeGee\TestDomain\TestMetaData'));

        $mockParam1 = m::mock();
        $mockParam1->shouldReceive('getName')->once()->andReturn('param1');
        $mockParam2 = m::mock();
        $mockParam2->shouldReceive('getName')->once()->andReturn('param2');

        $mockMethod = m::mock('ReflectionMethod');
        $mockMethod->shouldReceive('getParameters')->times(1)->andReturn([$mockParam1, $mockParam2]);

        $expected = ['$mockParam1', '$mockParam2'];

        $this->assertEquals($expected, $object->getMethodArguments($mockMethod));
    }

    /**
     *
     */
    public function testGetMethodArgumentsNoArguments()
    {
        $object = new MockeryGetTestMethod(m::mock('NullDev\TeeGee\TestDomain\TestMetaData'));

        $mockMethod = m::mock('ReflectionMethod');
        $mockMethod->shouldReceive('getParameters')->times(1)->andReturn([]);

        $this->assertEquals([], $object->getMethodArguments($mockMethod));
    }

    /**
     *
     */
    public function testGetMethodArgumentsString()
    {
        $object = new MockeryGetTestMethod(m::mock('NullDev\TeeGee\TestDomain\TestMetaData'));

        $mockParam1 = m::mock();
        $mockParam1->shouldReceive('getName')->once()->andReturn('param1');
        $mockParam2 = m::mock();
        $mockParam2->shouldReceive('getName')->once()->andReturn('param2');

        $mockMethod = m::mock('ReflectionMethod');
        $mockMethod->shouldReceive('getParameters')->times(1)->andReturn([$mockParam1, $mockParam2]);

        $expected = '$mockParam1, $mockParam2';

        $this->assertEquals($expected, $object->getMethodArgumentsString($mockMethod));
    }

    /**
     *
     */
    public function testGetMethodArgumentsStringNoArguments()
    {
        $object = new MockeryGetTestMethod(m::mock('NullDev\TeeGee\TestDomain\TestMetaData'));

        $mockMethod = m::mock('ReflectionMethod');
        $mockMethod->shouldReceive('getParameters')->times(1)->andReturn([]);

        $this->assertEquals('', $object->getMethodArgumentsString($mockMethod));
    }

    /**
     *
     */
    public function testGetMethodDependencies()
    {
        $object = new MockeryGetTestMethod(m::mock('NullDev\TeeGee\TestDomain\TestMetaData'));

        $mockClass1 = m::mock();
        $mockClass1->shouldReceive('getName')->once()->andReturn('DateTime');

        $mockParam1 = m::mock();
        $mockParam1->shouldReceive('getName')->once()->andReturn('param1');
        $mockParam1->shouldReceive('getClass')->twice()->andReturn($mockClass1);
        $mockParam2 = m::mock();
        $mockParam2->shouldReceive('getName')->once()->andReturn('param2');
        $mockParam2->shouldReceive('getClass')->once()->andReturn(false);

        $mockMethod = m::mock('ReflectionMethod');
        $mockMethod->shouldReceive('getParameters')->times(1)->andReturn([$mockParam1, $mockParam2]);

        $expected = ['$mockParam1 = m::mock(\'DateTime\');', '$mockParam2 = m::mock();'];

        $this->assertEquals($expected, $object->getMethodDependencies($mockMethod));
    }

    /**
     *
     */
    public function testGetMethodDependenciesNoArguments()
    {
        $object = new MockeryGetTestMethod(m::mock('NullDev\TeeGee\TestDomain\TestMetaData'));

        $mockMethod = m::mock('ReflectionMethod');
        $mockMethod->shouldReceive('getParameters')->times(1)->andReturn([]);

        $this->assertEquals([], $object->getMethodDependencies($mockMethod));
    }

    /**
     *
     */
    public function testGetMethodDependencyString()
    {
        $object = new MockeryGetTestMethod(m::mock('NullDev\TeeGee\TestDomain\TestMetaData'));

        $mockClass1 = m::mock();
        $mockClass1->shouldReceive('getName')->once()->andReturn('DateTime');

        $mockParam1 = m::mock();
        $mockParam1->shouldReceive('getName')->once()->andReturn('param1');
        $mockParam1->shouldReceive('getClass')->twice()->andReturn($mockClass1);
        $mockParam2 = m::mock();
        $mockParam2->shouldReceive('getName')->once()->andReturn('param2');
        $mockParam2->shouldReceive('getClass')->once()->andReturn(false);

        $mockMethod = m::mock('ReflectionMethod');
        $mockMethod->shouldReceive('getParameters')->times(1)->andReturn([$mockParam1, $mockParam2]);

        $expected = '$mockParam1 = m::mock(\'DateTime\');'.PHP_EOL.'        $mockParam2 = m::mock();';

        $this->assertEquals($expected, $object->getMethodDependencyString($mockMethod));
    }

    /**
     *
     */
    public function testGetMethodDependencyStringNoArguments()
    {
        $object = new MockeryGetTestMethod(m::mock('NullDev\TeeGee\TestDomain\TestMetaData'));

        $mockMethod = m::mock('ReflectionMethod');
        $mockMethod->shouldReceive('getParameters')->times(1)->andReturn([]);

        $this->assertEquals('//', $object->getMethodDependencyString($mockMethod));
    }

    /**
     *
     */
    public function testGetClassName()
    {
        $mockTestClassMetaData = m::mock('NullDev\TeeGee\TestDomain\TestMetaData');
        $mockTestClassMetaData->shouldReceive('getClassName')->once()->andReturn('SimpleClass');

        $object = new MockeryGetTestMethod($mockTestClassMetaData);

        $this->assertEquals('SimpleClass', $object->getClassName());
    }

    /**
     *
     */
    public function testGetClassArgumentsString()
    {
        $mockParam1 = m::mock();
        $mockParam1->shouldReceive('getName')->once()->andReturn('param1');
        $mockParam2 = m::mock();
        $mockParam2->shouldReceive('getName')->once()->andReturn('param2');

        $mockConstructorMethod = m::mock('ReflectionMethod');
        $mockConstructorMethod->shouldReceive('getParameters')->times(1)->andReturn([$mockParam1, $mockParam2]);

        $mockTestClassMetaData = m::mock('NullDev\TeeGee\TestDomain\TestMetaData');
        $mockTestClassMetaData->shouldReceive('getConstructorReflection')->once()->andReturn($mockConstructorMethod);

        $object = new MockeryGetTestMethod($mockTestClassMetaData);

        $expected = '$mockParam1, $mockParam2';

        $this->assertEquals($expected, $object->getClassArgumentsString());
    }

    /**
     *
     */
    public function testGetClassArgumentsStringConstructorWithoutParams()
    {
        $mockConstructorMethod = m::mock('ReflectionMethod');
        $mockConstructorMethod->shouldReceive('getParameters')->times(1)->andReturn([]);

        $mockTestClassMetaData = m::mock('NullDev\TeeGee\TestDomain\TestMetaData');
        $mockTestClassMetaData->shouldReceive('getConstructorReflection')->once()->andReturn($mockConstructorMethod);

        $object = new MockeryGetTestMethod($mockTestClassMetaData);

        $this->assertEquals('', $object->getClassArgumentsString());
    }

    /**
     *
     */
    public function testGetClassArgumentsStringNoConstructor()
    {
        $mockTestClassMetaData = m::mock('NullDev\TeeGee\TestDomain\TestMetaData');
        $mockTestClassMetaData->shouldReceive('getConstructorReflection')->once()->andReturn(null);

        $object = new MockeryGetTestMethod($mockTestClassMetaData);

        $this->assertEquals('', $object->getClassArgumentsString());
    }

    /**
     *
     */
    public function testGetClassDependencyString()
    {
        $mockClass1 = m::mock();
        $mockClass1->shouldReceive('getName')->once()->andReturn('DateTime');

        $mockParam1 = m::mock();
        $mockParam1->shouldReceive('getName')->once()->andReturn('param1');
        $mockParam1->shouldReceive('getClass')->twice()->andReturn($mockClass1);
        $mockParam2 = m::mock();
        $mockParam2->shouldReceive('getName')->once()->andReturn('param2');
        $mockParam2->shouldReceive('getClass')->once()->andReturn(false);

        $mockConstructorMethod = m::mock('ReflectionMethod');
        $mockConstructorMethod->shouldReceive('getParameters')->times(1)->andReturn([$mockParam1, $mockParam2]);

        $mockTestClassMetaData = m::mock('NullDev\TeeGee\TestDomain\TestMetaData');
        $mockTestClassMetaData->shouldReceive('getConstructorReflection')->once()->andReturn($mockConstructorMethod);

        $object = new MockeryGetTestMethod($mockTestClassMetaData);

        $expected = '$mockParam1 = m::mock(\'DateTime\');'.PHP_EOL.'        $mockParam2 = m::mock();';

        $this->assertEquals($expected, $object->getClassDependencyString());
    }

    /**
     *
     */
    public function testGetClassDependencyStringConstructorWithoutParams()
    {
        $mockConstructorMethod = m::mock('ReflectionMethod');
        $mockConstructorMethod->shouldReceive('getParameters')->times(1)->andReturn([]);

        $mockTestClassMetaData = m::mock('NullDev\TeeGee\TestDomain\TestMetaData');
        $mockTestClassMetaData->shouldReceive('getConstructorReflection')->once()->andReturn($mockConstructorMethod);

        $object = new MockeryGetTestMethod($mockTestClassMetaData);

        $this->assertEquals('//', $object->getClassDependencyString());
    }

    /**
     *
     */
    public function testGetClassDependencyStringStringNoConstructor()
    {
        $mockTestClassMetaData = m::mock('NullDev\TeeGee\TestDomain\TestMetaData');
        $mockTestClassMetaData->shouldReceive('getConstructorReflection')->once()->andReturn(null);

        $object = new MockeryGetTestMethod($mockTestClassMetaData);

        $this->assertEquals('//', $object->getClassDependencyString());
    }

    /**
     * @covers NullDev\TeeGee\TestMethodGenerator\MockeryGetTestMethod::getData
     */
    public function testGetDataTest1()
    {
        $mockReflectionObject = m::mock();
        $mockReflectionObject->shouldReceive('getDefaultProperties')->once()->andReturn(['property' => 'defaultValue']);

        $mockTestClassMetaData = m::mock('NullDev\TeeGee\TestDomain\TestMetaData');
        $mockTestClassMetaData->shouldReceive('getClassName')->once()->andReturn('SimpleClass');
        $mockTestClassMetaData->shouldReceive('getConstructorReflection')->times(2)->andReturn(null);
        $mockTestClassMetaData->shouldReceive('getReflectionObject')->once()->andReturn($mockReflectionObject);

        $object = new MockeryGetTestMethod($mockTestClassMetaData);

        $mockMethod = m::mock('ReflectionMethod');
        $mockMethod->shouldReceive('getName')->times(3)->andReturn('getProperty');
        $mockMethod->shouldReceive('getParameters')->times(2)->andReturn([]);

        $result = $object->getData($mockMethod);

        $expected = [
            'methodName'               => 'GetProperty',
            'testedMethodName'         => 'getProperty',
            'testedMethodArguments'    => '',
            'testedMethodDependencies' => '//',
            'testedClassName'          => 'SimpleClass',
            'testedClassArguments'     => '',
            'testedClassDependencies'  => '//',
            'testedValue'              => '\'defaultValue\'',
        ];

        $this->assertEquals($expected, $result);
    }

    /**
     *
     */
    public function testGetTemplatePath()
    {
        $object = new MockeryGetTestMethod(m::mock('NullDev\TeeGee\TestDomain\TestMetaData'));

        $mockMethod = m::mock('ReflectionMethod');

        $result = $object->getTemplatePath($mockMethod);

        $expectedPath = __DIR__.'/../../../../../src/NullDev/TeeGee/TestMethodGenerator/Template/MockeryGetTestMethod.tpl';

        $expected = realpath($expectedPath);

        $this->assertEquals($expected, $result);
    }

    /**
     * @covers NullDev\TeeGee\TestMethodGenerator\MockeryGetTestMethod::render
     */
    public function testRenderTest1()
    {
        $mockReflectionObject = m::mock();
        $mockReflectionObject->shouldReceive('getDefaultProperties')->once()->andReturn(['property' => 'defaultValue']);

        $mockTestClassMetaData = m::mock('NullDev\TeeGee\TestDomain\TestMetaData');
        $mockTestClassMetaData->shouldReceive('getClassName')->once()->andReturn('SimpleClass');
        $mockTestClassMetaData->shouldReceive('getConstructorReflection')->times(2)->andReturn(null);
        $mockTestClassMetaData->shouldReceive('getReflectionObject')->once()->andReturn($mockReflectionObject);

        $object = new MockeryGetTestMethod($mockTestClassMetaData);

        $mockMethod = m::mock('ReflectionMethod');
        $mockMethod->shouldReceive('getName')->times(3)->andReturn('getProperty');
        $mockMethod->shouldReceive('getParameters')->times(2)->andReturn([]);

        $result = $object->render($mockMethod);

        $expected = file_get_contents(__DIR__.'/results/MockeryGetTestMethod_test1.renderResult');

        $this->assertEquals($expected, $result);
    }

    /**
     * @covers NullDev\TeeGee\TestMethodGenerator\MockeryGetTestMethod::render
     */
    public function testRenderTest2()
    {
        $mockReflectionObject = m::mock();
        $mockReflectionObject->shouldReceive('getDefaultProperties')->once()->andReturn(['property' => 'defaultValue']);

        $mockConstructorParam1 = m::mock();
        $mockConstructorParam1->shouldReceive('getName')->twice()->andReturn('constructorParam1');
        $mockConstructorParam1->shouldReceive('getClass')->once()->andReturn(false);
        $mockConstructorParam2 = m::mock();
        $mockConstructorParam2->shouldReceive('getName')->twice()->andReturn('constructorParam2');
        $mockConstructorParam2->shouldReceive('getClass')->once()->andReturn(false);

        $mockConstructorMethod = m::mock('ReflectionMethod');
        $mockConstructorMethod
            ->shouldReceive('getParameters')
            ->times(2)
            ->andReturn([$mockConstructorParam1, $mockConstructorParam2]);

        $mockTestClassMetaData = m::mock('NullDev\TeeGee\TestDomain\TestMetaData');
        $mockTestClassMetaData->shouldReceive('getClassName')->once()->andReturn('SimpleClass');
        $mockTestClassMetaData->shouldReceive('getConstructorReflection')->times(2)->andReturn($mockConstructorMethod);
        $mockTestClassMetaData->shouldReceive('getReflectionObject')->once()->andReturn($mockReflectionObject);

        $object = new MockeryGetTestMethod($mockTestClassMetaData);

        $mockMethod = m::mock('ReflectionMethod');
        $mockMethod->shouldReceive('getName')->times(3)->andReturn('getProperty');
        $mockMethod->shouldReceive('getParameters')->times(2)->andReturn([]);

        $result = $object->render($mockMethod);

        $expected = file_get_contents(__DIR__.'/results/MockeryGetTestMethod_test2.renderResult');

        $this->assertEquals($expected, $result);
    }

    /**
     * @covers NullDev\TeeGee\TestMethodGenerator\MockeryGetTestMethod::render
     */
    public function testRenderTest3()
    {
        $mockReflectionObject = m::mock();
        $mockReflectionObject->shouldReceive('getDefaultProperties')->once()->andReturn(['property' => 'defaultValue']);

        $mockConstructorClass1 = m::mock();
        $mockConstructorClass1->shouldReceive('getName')->once()->andReturn('DateTime');

        $mockConstructorParam1 = m::mock();
        $mockConstructorParam1->shouldReceive('getName')->twice()->andReturn('constructorParam1');
        $mockConstructorParam1->shouldReceive('getClass')->twice()->andReturn($mockConstructorClass1);
        $mockConstructorParam2 = m::mock();
        $mockConstructorParam2->shouldReceive('getName')->twice()->andReturn('constructorParam2');
        $mockConstructorParam2->shouldReceive('getClass')->once()->andReturn(false);

        $mockConstructorMethod = m::mock('ReflectionMethod');
        $mockConstructorMethod
            ->shouldReceive('getParameters')
            ->times(2)
            ->andReturn([$mockConstructorParam1, $mockConstructorParam2]);

        $mockTestClassMetaData = m::mock('NullDev\TeeGee\TestDomain\TestMetaData');
        $mockTestClassMetaData->shouldReceive('getClassName')->once()->andReturn('SimpleClass');
        $mockTestClassMetaData->shouldReceive('getConstructorReflection')->times(2)->andReturn($mockConstructorMethod);
        $mockTestClassMetaData->shouldReceive('getReflectionObject')->once()->andReturn($mockReflectionObject);

        $object = new MockeryGetTestMethod($mockTestClassMetaData);

        $mockMethod = m::mock('ReflectionMethod');
        $mockMethod->shouldReceive('getName')->times(3)->andReturn('getProperty');
        $mockMethod->shouldReceive('getParameters')->times(2)->andReturn([]);

        $result = $object->render($mockMethod);

        $expected = file_get_contents(__DIR__.'/results/MockeryGetTestMethod_test3.renderResult');

        $this->assertEquals($expected, $result);
    }
}

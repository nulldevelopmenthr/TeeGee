<?php
namespace tests\Unit\NullDev\TeeGee\TestMethodGenerator;

use NullDev\TeeGee\TestMethodGenerator\MockeryTestMethod;
use Mockery as m;

class MockeryTestMethodTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var MockeryTestMethod
     */
    protected $object;

    /**
     *
     */
    public function testGetMethodArguments()
    {
        $object = new MockeryTestMethod(m::mock('NullDev\TeeGee\TestDomain\TestMetaData'));

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
        $object = new MockeryTestMethod(m::mock('NullDev\TeeGee\TestDomain\TestMetaData'));

        $mockMethod = m::mock('ReflectionMethod');
        $mockMethod->shouldReceive('getParameters')->times(1)->andReturn([]);

        $this->assertEquals([], $object->getMethodArguments($mockMethod));
    }

    /**
     *
     */
    public function testGetMethodArgumentsString()
    {
        $object = new MockeryTestMethod(m::mock('NullDev\TeeGee\TestDomain\TestMetaData'));

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
        $object = new MockeryTestMethod(m::mock('NullDev\TeeGee\TestDomain\TestMetaData'));

        $mockMethod = m::mock('ReflectionMethod');
        $mockMethod->shouldReceive('getParameters')->times(1)->andReturn([]);

        $this->assertEquals('', $object->getMethodArgumentsString($mockMethod));
    }

    /**
     *
     */
    public function testGetMethodDependencies()
    {
        $object = new MockeryTestMethod(m::mock('NullDev\TeeGee\TestDomain\TestMetaData'));

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
        $object = new MockeryTestMethod(m::mock('NullDev\TeeGee\TestDomain\TestMetaData'));

        $mockMethod = m::mock('ReflectionMethod');
        $mockMethod->shouldReceive('getParameters')->times(1)->andReturn([]);

        $this->assertEquals([], $object->getMethodDependencies($mockMethod));
    }

    /**
     *
     */
    public function testGetMethodDependencyString()
    {
        $object = new MockeryTestMethod(m::mock('NullDev\TeeGee\TestDomain\TestMetaData'));

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
        $object = new MockeryTestMethod(m::mock('NullDev\TeeGee\TestDomain\TestMetaData'));

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

        $object = new MockeryTestMethod($mockTestClassMetaData);

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

        $object = new MockeryTestMethod($mockTestClassMetaData);

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

        $object = new MockeryTestMethod($mockTestClassMetaData);

        $this->assertEquals('', $object->getClassArgumentsString());
    }

    /**
     *
     */
    public function testGetClassArgumentsStringNoConstructor()
    {
        $mockTestClassMetaData = m::mock('NullDev\TeeGee\TestDomain\TestMetaData');
        $mockTestClassMetaData->shouldReceive('getConstructorReflection')->once()->andReturn(null);

        $object = new MockeryTestMethod($mockTestClassMetaData);

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

        $object = new MockeryTestMethod($mockTestClassMetaData);

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

        $object = new MockeryTestMethod($mockTestClassMetaData);

        $this->assertEquals('//', $object->getClassDependencyString());
    }

    /**
     *
     */
    public function testGetClassDependencyStringStringNoConstructor()
    {
        $mockTestClassMetaData = m::mock('NullDev\TeeGee\TestDomain\TestMetaData');
        $mockTestClassMetaData->shouldReceive('getConstructorReflection')->once()->andReturn(null);

        $object = new MockeryTestMethod($mockTestClassMetaData);

        $this->assertEquals('//', $object->getClassDependencyString());
    }

    /**
     * @covers NullDev\TeeGee\TestMethodGenerator\MockeryTestMethod::getData
     */
    public function testGetDataTest1()
    {
        $mockTestClassMetaData = m::mock('NullDev\TeeGee\TestDomain\TestMetaData');
        $mockTestClassMetaData->shouldReceive('getClassName')->once()->andReturn('SimpleClass');
        $mockTestClassMetaData->shouldReceive('getConstructorReflection')->times(2)->andReturn(null);

        $object = new MockeryTestMethod($mockTestClassMetaData);

        $mockMethod = m::mock('ReflectionMethod');
        $mockMethod->shouldReceive('getName')->times(2)->andReturn('simpleMethod');
        $mockMethod->shouldReceive('getParameters')->times(2)->andReturn([]);

        $result = $object->getData($mockMethod);

        $expected = [
            'methodName'               => 'SimpleMethod',
            'testedMethodName'         => 'simpleMethod',
            'testedMethodArguments'    => '',
            'testedMethodDependencies' => '//',
            'testedClassName'          => 'SimpleClass',
            'testedClassArguments'     => '',
            'testedClassDependencies'  => '//',
        ];

        $this->assertEquals($expected, $result);
    }

    /**
     *
     */
    public function testGetTemplatePath()
    {
        $object = new MockeryTestMethod(m::mock('NullDev\TeeGee\TestDomain\TestMetaData'));

        $mockMethod = m::mock('ReflectionMethod');

        $result = $object->getTemplatePath($mockMethod);

        $expectedPath = __DIR__.'/../../../../../src/NullDev/TeeGee/TestMethodGenerator/Template/MockeryTestMethod.tpl';

        $expected = realpath($expectedPath);

        $this->assertEquals($expected, $result);
    }

    /**
     * @covers NullDev\TeeGee\TestMethodGenerator\MockeryTestMethod::render
     */
    public function testRenderTest1()
    {
        $mockTestClassMetaData = m::mock('NullDev\TeeGee\TestDomain\TestMetaData');
        $mockTestClassMetaData->shouldReceive('getClassName')->once()->andReturn('SimpleClass');
        $mockTestClassMetaData->shouldReceive('getConstructorReflection')->times(2)->andReturn(null);

        $object = new MockeryTestMethod($mockTestClassMetaData);

        $mockMethod = m::mock('ReflectionMethod');
        $mockMethod->shouldReceive('getName')->times(2)->andReturn('simpleMethod');
        $mockMethod->shouldReceive('getParameters')->times(2)->andReturn([]);

        $result = $object->render($mockMethod);

        $expected = file_get_contents(__DIR__.'/results/MockeryTestMethod_test1.renderResult');

        $this->assertEquals($expected, $result);
    }

    /**
     * @covers NullDev\TeeGee\TestMethodGenerator\MockeryTestMethod::render
     */
    public function testRenderTest2()
    {
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

        $object = new MockeryTestMethod($mockTestClassMetaData);

        $mockParam1 = m::mock();
        $mockParam1->shouldReceive('getName')->twice()->andReturn('param1');
        $mockParam1->shouldReceive('getClass')->once()->andReturn(false);
        $mockParam2 = m::mock();
        $mockParam2->shouldReceive('getName')->twice()->andReturn('param2');
        $mockParam2->shouldReceive('getClass')->once()->andReturn(false);

        $mockMethod = m::mock('ReflectionMethod');
        $mockMethod->shouldReceive('getName')->times(2)->andReturn('simpleMethod');
        $mockMethod->shouldReceive('getParameters')->times(2)->andReturn([$mockParam1, $mockParam2]);

        $result = $object->render($mockMethod);

        $expected = file_get_contents(__DIR__.'/results/MockeryTestMethod_test2.renderResult');

        $this->assertEquals($expected, $result);
    }

    /**
     * @covers NullDev\TeeGee\TestMethodGenerator\MockeryTestMethod::render
     */
    public function testRenderTest3()
    {
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

        $object = new MockeryTestMethod($mockTestClassMetaData);

        $mockClass1 = m::mock();
        $mockClass1->shouldReceive('getName')->once()->andReturn('Vendor\Package\NameSpaceClassName');

        $mockParam1 = m::mock();
        $mockParam1->shouldReceive('getName')->twice()->andReturn('param1');
        $mockParam1->shouldReceive('getClass')->twice()->andReturn($mockClass1);
        $mockParam2 = m::mock();
        $mockParam2->shouldReceive('getName')->twice()->andReturn('param2');
        $mockParam2->shouldReceive('getClass')->once()->andReturn(false);

        $mockMethod = m::mock('ReflectionMethod');
        $mockMethod->shouldReceive('getName')->times(2)->andReturn('simpleMethod');
        $mockMethod->shouldReceive('getParameters')->times(2)->andReturn([$mockParam1, $mockParam2]);

        $result = $object->render($mockMethod);

        $expected = file_get_contents(__DIR__.'/results/MockeryTestMethod_test3.renderResult');

        $this->assertEquals($expected, $result);
    }
}

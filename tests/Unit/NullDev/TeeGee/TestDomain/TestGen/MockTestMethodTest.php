<?php
namespace Tests\Unit\NullDev\TeeGee\TestDomain\TestGen\MockTestMethodTest;

use NullDev\TeeGee\TestDomain\TestGen\MockTestMethod;
use Mockery as m;

/**
 *
 */
class MockTestMethodTest extends \PHPUnit_Framework_TestCase
{

    /**
     *
     */
    public function testRender()
    {
        $this->markTestIncomplete('TODO');

        //
        $mockTestMetaData = m::mock();

        $obj = new MockTestMethod($mockTestMetaData);

        //
        $mockMethod = m::mock();

        $result = $obj->render($mockMethod);

        $this->assertNotNull($result);
    }

    /**
     *
     */
    public function testGetMethodArgumentsString()
    {
        $obj = new MockTestMethod(m::mock());

        $mockParam1       =new \stdClass();
        $mockParam1->name = 'propertyName';

        $mockParam2       = new \stdClass();
        $mockParam2->name = 'getName';

        //
        $mockMethod = m::mock();
        $mockMethod->shouldReceive('getParameters')->once()->andReturn([$mockParam1, $mockParam2]);

        $result = $obj->getMethodArgumentsString($mockMethod);

        $expectedResult  = '$mockPropertyName = m::mock();';
        $expectedResult .= PHP_EOL . '        ';
        $expectedResult .= '$mockGetName = m::mock();' . PHP_EOL . PHP_EOL;

        $this->assertEquals($expectedResult, $result);
    }

    /**
     *
     */
    public function testGetMethodArgumentsStringOneParamFound()
    {
        $obj = new MockTestMethod(m::mock());

        $mockParam       = new \stdClass();
        $mockParam->name = 'propertyName';

        //
        $mockMethod = m::mock();
        $mockMethod->shouldReceive('getParameters')->once()->andReturn([$mockParam]);

        $result = $obj->getMethodArgumentsString($mockMethod);

        $expectedResult = '$mockPropertyName = m::mock();' . PHP_EOL . PHP_EOL;

        $this->assertEquals($expectedResult, $result);
    }

    /**
     *
     */
    public function testGetMethodArgumentsStringNoParamsOnMethod()
    {
        $obj = new MockTestMethod(m::mock());

        //
        $mockMethod = m::mock();
        $mockMethod->shouldReceive('getParameters')->once()->andReturn([]);

        $result = $obj->getMethodArgumentsString($mockMethod);

        $this->assertEquals('//', $result);
    }

    /**
     *
     */
    public function testGetMethodString()
    {
        $obj = new MockTestMethod(m::mock());

        $mockParam       = new \stdClass();
        $mockParam->name = 'propertyName';

        //
        $mockMethod       = m::mock();
        $mockMethod->name = 'methodName';
        $mockMethod->shouldReceive('getParameters')->once()->andReturn([$mockParam]);

        $result = $obj->getMethodString($mockMethod);

        $this->assertEquals('methodName($mockPropertyName)', $result);
    }

    /**
     *
     */
    public function testGetMethodStringNoParamsOnMethod()
    {
        $obj = new MockTestMethod(m::mock());

        //
        $mockMethod       = m::mock();
        $mockMethod->name = 'methodName';
        $mockMethod->shouldReceive('getParameters')->once()->andReturn([]);

        $result = $obj->getMethodString($mockMethod);

        $this->assertEquals('methodName()', $result);
    }

    /**
     *
     */
    public function testGetConstructorArgumentsString()
    {
        $mockArg1       = new \stdClass();
        $mockArg1->name = 'arg1';
        $mockArg2       = new \stdClass();
        $mockArg2->name = 'arg2';
        $mockArg3       = new \stdClass();
        $mockArg3->name = 'arg3';

        $mockConstructorReflection = m::mock();
        $mockConstructorReflection
            ->shouldReceive('getParameters')->once()->andReturn([$mockArg1, $mockArg2, $mockArg3]);

        $mockTestMetaData = m::mock();
        $mockTestMetaData->shouldReceive('getConstructorReflection')->once()->andReturn($mockConstructorReflection);

        $obj = new MockTestMethod($mockTestMetaData);

        $result = $obj->getConstructorArgumentsString();

        $expected  = '$mockArg1 = m::mock();' . PHP_EOL;
        $expected .= '        $mockArg2 = m::mock();' . PHP_EOL;
        $expected .= '        $mockArg3 = m::mock();';
        $expected .= PHP_EOL . PHP_EOL;

        $this->assertEquals($expected, $result);
    }

    /**
     *
     */
    public function testGetConstructorArgumentsStringNoArgs()
    {
        $mockConstructorReflection = m::mock();
        $mockConstructorReflection->shouldReceive('getParameters')->once()->andReturn([]);

        $mockTestMetaData = m::mock();
        $mockTestMetaData->shouldReceive('getConstructorReflection')->once()->andReturn($mockConstructorReflection);

        $obj = new MockTestMethod($mockTestMetaData);

        $result = $obj->getConstructorArgumentsString();

        $this->assertEquals('', $result);
    }

    /**
     *
     */
    public function testGetConstructorArgumentsStringNoConstructor()
    {
        $mockTestMetaData = m::mock();
        $mockTestMetaData->shouldReceive('getConstructorReflection')->once()->andReturn(null);

        $obj = new MockTestMethod($mockTestMetaData);

        $result = $obj->getConstructorArgumentsString();

        $this->assertEquals('', $result);
    }

    /**
     *
     */
    public function testGetConstructorString()
    {
        $mockParam1       = new \stdClass();
        $mockParam1->name = 'arg1';

        $mockReflection = m::mock();
        $mockReflection->shouldReceive('getParameters')->once()->andReturn([$mockParam1]);

        //
        $mockTestMetaData = m::mock();
        $mockTestMetaData->shouldReceive('getConstructorReflection')->once()->andReturn($mockReflection);
        $mockTestMetaData->shouldReceive('getClassName')->once()->andReturn('ClassName');

        $obj = new MockTestMethod($mockTestMetaData);

        //
        //
        $result = $obj->getConstructorString();

        $this->assertEquals('ClassName($mockArg1)', $result);
    }

    /**
     *
     */
    public function testGetConstructorStringMultipleParams()
    {
        $mockParam1       = new \stdClass();
        $mockParam1->name = 'arg1';
        $mockParam2       = new \stdClass();
        $mockParam2->name = 'arg2';
        $mockParam3       = new \stdClass();
        $mockParam3->name = 'arg3';

        $mockReflection = m::mock();
        $mockReflection->shouldReceive('getParameters')->once()->andReturn([$mockParam1, $mockParam2, $mockParam3]);

        //
        $mockTestMetaData = m::mock();
        $mockTestMetaData->shouldReceive('getConstructorReflection')->once()->andReturn($mockReflection);
        $mockTestMetaData->shouldReceive('getClassName')->once()->andReturn('ClassName');

        $obj = new MockTestMethod($mockTestMetaData);

        //
        //
        $result = $obj->getConstructorString();

        $this->assertEquals('ClassName($mockArg1, $mockArg2, $mockArg3)', $result);
    }

    /**
     *
     */
    public function testGetConstructorStringNoParamsForConstructor()
    {
        $mockReflection = m::mock();
        $mockReflection->shouldReceive('getParameters')->once()->andReturn([]);

        //
        $mockTestMetaData = m::mock();
        $mockTestMetaData->shouldReceive('getConstructorReflection')->once()->andReturn($mockReflection);
        $mockTestMetaData->shouldReceive('getClassName')->once()->andReturn('ClassName');

        $obj = new MockTestMethod($mockTestMetaData);

        //
        //
        $result = $obj->getConstructorString();

        $this->assertEquals('ClassName()', $result);
    }

    /**
     *
     */
    public function testGetConstructorStringNoConstructor()
    {
        //
        $mockTestMetaData = m::mock();
        $mockTestMetaData->shouldReceive('getConstructorReflection')->once()->andReturn(null);
        $mockTestMetaData->shouldReceive('getClassName')->once()->andReturn('ClassName');

        $obj = new MockTestMethod($mockTestMetaData);

        //
        //
        $result = $obj->getConstructorString();

        $this->assertEquals('ClassName()', $result);
    }
}

<?php
namespace Tests\Unit\NullDev\TeeGee\TestDomain\TestGen\BasicUnitTestGenTest;

use NullDev\TeeGee\TestDomain\TestGen\BasicUnitTestGen;
use Mockery as m;

/**
 *
 */
class BasicUnitTestGenTest extends \PHPUnit_Framework_TestCase
{
    /**
     *
     */
    public function testGetVars()
    {
        $mockReflectionObject = m::mock();
        $mockReflectionObject->shouldReceive('getMethods')->once()->andReturn([]);

        $mockTestMetaData = m::mock();
        $mockTestMetaData->shouldReceive('getClassName')->twice()->andReturn('ClassName');
        $mockTestMetaData->shouldReceive('getTestClassName')->twice()->andReturn('ClassNameTest');
        $mockTestMetaData->shouldReceive('getFullyQualifiedClassName')->once()->andReturn('Namespace\ClassName');
        $mockTestMetaData->shouldReceive('getTestFullyQualifiedClassName')->once()->andReturn(
            'Tests\Unit\Namespace\ClassNameTest'
        );
        $mockTestMetaData->shouldReceive('getConstructorReflection')->twice()->andReturn(null);
        $mockTestMetaData->shouldReceive('getReflectionObject')->once()->andReturn($mockReflectionObject);

        $obj = new BasicUnitTestGen($mockTestMetaData);

        $result = $obj->getVars();
        $expectedMethods = <<<EOF
    /**
     *
     */
    public function testNothing()
    {
        \$this->markTestIncomplete('TODO');
    }

EOF;

        $expected = [
            'namespace'            => 'namespace Tests\Unit\Namespace;',
            'dependencies'         => 'use Namespace\ClassName;'.PHP_EOL.'use Mockery as m;',
            'testClassName'        => 'ClassNameTest',
            'className'            => 'ClassName',
            'constructorArguments' => '',
            'constructor'          => 'ClassName()',
            'methods'              => $expectedMethods,
        ];

        $this->assertEquals($expected, $result);
    }

    /**
     *
     */
    public function testGetDependencies()
    {
        $mockTestMetaData = m::mock();
        $mockTestMetaData->shouldReceive('getFullyQualifiedClassName')->once()->andReturn('Namespace\ClassName');

        $obj = new BasicUnitTestGen($mockTestMetaData);

        $result   = $obj->getDependencies();
        $expected = [
            'Namespace\ClassName',
            'Mockery as m',
        ];

        $this->assertEquals($expected, $result);
    }

    /**
     *
     */
    public function testGetDependenciesString()
    {
        $mockTestMetaData = m::mock();
        $mockTestMetaData->shouldReceive('getFullyQualifiedClassName')->once()->andReturn('Namespace\ClassName');

        $obj = new BasicUnitTestGen($mockTestMetaData);

        $result = $obj->getDependenciesString();

        $expected  = 'use Namespace\ClassName;'.PHP_EOL;
        $expected .= 'use Mockery as m;';

        $this->assertEquals($expected, $result);
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

        $obj = new BasicUnitTestGen($mockTestMetaData);

        $result = $obj->getConstructorArgumentsString();

        $expected  = '$mockArg1 = m::mock();'.PHP_EOL;
        $expected .= '        $mockArg2 = m::mock();'.PHP_EOL;
        $expected .= '        $mockArg3 = m::mock();';
        $expected .= PHP_EOL.PHP_EOL;

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

        $obj = new BasicUnitTestGen($mockTestMetaData);

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

        $obj = new BasicUnitTestGen($mockTestMetaData);

        $result = $obj->getConstructorArgumentsString();

        $this->assertEquals('', $result);
    }

    /**
     *
     */
    public function testGetConstructorString()
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
        $mockTestMetaData->shouldReceive('getClassName')->once()->andReturn('ClassName');

        $obj = new BasicUnitTestGen($mockTestMetaData);

        $result = $obj->getConstructorString();

        $this->assertEquals('ClassName($mockArg1, $mockArg2, $mockArg3)', $result);
    }

    /**
     *
     */
    public function testGetConstructorStringNoArgs()
    {
        $mockConstructorReflection = m::mock();
        $mockConstructorReflection->shouldReceive('getParameters')->once()->andReturn([]);

        $mockTestMetaData = m::mock();
        $mockTestMetaData->shouldReceive('getConstructorReflection')->once()->andReturn($mockConstructorReflection);
        $mockTestMetaData->shouldReceive('getClassName')->once()->andReturn('ClassName');

        $obj = new BasicUnitTestGen($mockTestMetaData);

        $result = $obj->getConstructorString();

        $this->assertEquals('ClassName()', $result);
    }

    /**
     *
     */
    public function testGetConstructorStringNoConstructor()
    {
        $mockTestMetaData = m::mock();
        $mockTestMetaData->shouldReceive('getConstructorReflection')->once()->andReturn(null);
        $mockTestMetaData->shouldReceive('getClassName')->once()->andReturn('ClassName');

        $obj = new BasicUnitTestGen($mockTestMetaData);

        $result = $obj->getConstructorString();

        $this->assertEquals('ClassName()', $result);
    }

    /**
     *
     */
    public function testGetMethods()
    {
        $this->markTestSkipped('remove freakin new MockTestMethod()');

        $mockMethod1 = m::mock();
        $mockMethod1->shouldReceive('isConstructor')->once()->andReturn(true);
        $mockMethod1->shouldReceive('isPublic')->never()->andReturn(false);

        $mockMethod2 = m::mock();
        $mockMethod2->shouldReceive('isConstructor')->once()->andReturn(false);
        $mockMethod2->shouldReceive('isPublic')->once()->andReturn(false);

        $mockMethod3 = m::mock();
        $mockMethod3->shouldReceive('isConstructor')->once()->andReturn(false);
        $mockMethod3->shouldReceive('isPublic')->once()->andReturn(true);
        $mockMethod3->shouldReceive('getParameters')->once()->andReturn([]);
        $mockMethod3->name = 'getSomething';

        $mockReflectionObject = m::mock();
        $mockReflectionObject->shouldReceive('getMethods')->once()->andReturn(
            [$mockMethod1, $mockMethod2, $mockMethod3]
        );

        $mockTestMetaData = m::mock();
        $mockTestMetaData->shouldReceive('getReflectionObject')->once()->andReturn($mockReflectionObject);
        $mockTestMetaData->shouldReceive('getConstructorReflection')->once()->andReturn(null);

        $obj = new BasicUnitTestGen($mockTestMetaData);

        $result = $obj->getMethods();

        $this->assertEquals('', $result);
    }

    /**
     *
     */
    public function testGetMethodsOnlyNonPublicMethods()
    {
        $mockMethod1 = m::mock();
        $mockMethod1->shouldReceive('isConstructor')->once()->andReturn(false);
        $mockMethod1->shouldReceive('isPublic')->once()->andReturn(false);

        $mockReflectionObject = m::mock();
        $mockReflectionObject->shouldReceive('getMethods')->once()->andReturn([$mockMethod1]);

        $mockTestMetaData = m::mock();
        $mockTestMetaData->shouldReceive('getReflectionObject')->once()->andReturn($mockReflectionObject);

        $obj = new BasicUnitTestGen($mockTestMetaData);

        $result = $obj->getMethods();

        $expected = <<<EOF
    /**
     *
     */
    public function testNothing()
    {
        \$this->markTestIncomplete('TODO');
    }

EOF;
        $this->assertEquals($expected, $result);
    }

    /**
     *
     */
    public function testGetMethodsOnlyConstructor()
    {
        $mockMethod1 = m::mock();
        $mockMethod1->shouldReceive('isConstructor')->once()->andReturn(true);

        $mockReflectionObject = m::mock();
        $mockReflectionObject->shouldReceive('getMethods')->once()->andReturn([$mockMethod1]);

        $mockTestMetaData = m::mock();
        $mockTestMetaData->shouldReceive('getReflectionObject')->once()->andReturn($mockReflectionObject);

        $obj = new BasicUnitTestGen($mockTestMetaData);

        $result = $obj->getMethods();

        $expected = <<<EOF
    /**
     *
     */
    public function testNothing()
    {
        \$this->markTestIncomplete('TODO');
    }

EOF;
        $this->assertEquals($expected, $result);
    }

    /**
     *
     */
    public function testGetMethodsNoneFound()
    {
        $mockReflectionObject = m::mock();
        $mockReflectionObject->shouldReceive('getMethods')->once()->andReturn([]);

        $mockTestMetaData = m::mock();
        $mockTestMetaData->shouldReceive('getReflectionObject')->once()->andReturn($mockReflectionObject);

        $obj = new BasicUnitTestGen($mockTestMetaData);

        $result = $obj->getMethods();

        $expected = <<<EOF
    /**
     *
     */
    public function testNothing()
    {
        \$this->markTestIncomplete('TODO');
    }

EOF;
        $this->assertEquals($expected, $result);
    }

    /**
     *
     */
    public function testRender()
    {
        $this->markTestIncomplete('TODO');

        //
        $mockTestMetaData = m::mock();

        $obj = new BasicUnitTestGen($mockTestMetaData);

        //
        //
        $result = $obj->render();

        $this->assertNotNull($result);
    }

    /**
     *
     */
    public function testGetNamespace()
    {
        $mockTestMetaData = m::mock();
        $mockTestMetaData->shouldReceive('getTestClassName')->once()->andReturn('ClassName');
        $mockTestMetaData->shouldReceive('getTestFullyQualifiedClassName')->once()->andReturn('Namespace\\ClassName');

        $obj = new BasicUnitTestGen($mockTestMetaData);

        $result = $obj->getNamespace();

        $this->assertEquals('Namespace', $result);
    }

    /**
     *
     */
    public function testGetNamespaceString()
    {
        $mockTestMetaData = m::mock();
        $mockTestMetaData->shouldReceive('getTestClassName')->once()->andReturn('ClassName');
        $mockTestMetaData->shouldReceive('getTestFullyQualifiedClassName')->once()->andReturn('Namespace\\ClassName');

        $obj = new BasicUnitTestGen($mockTestMetaData);

        $result = $obj->getNamespaceString();

        $this->assertEquals('namespace Namespace;', $result);
    }

    /**
     *
     */
    public function testGetConstructorMethod()
    {
        $mockTestMetaData = m::mock();
        $mockTestMetaData->shouldReceive('getConstructorReflection')->once()->andReturn('something');

        $obj = new BasicUnitTestGen($mockTestMetaData);

        $result = $obj->getConstructorMethod();

        $this->assertEquals('something', $result);
    }
}

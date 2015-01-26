<?php
namespace Tests\Unit\NullDev\TeeGee\TestDomain;

use Faker\Factory;
use NullDev\TeeGee\TestDomain\TestMetaData;
use \Mockery as m;

class TestMetaDataTest extends \PHPUnit_Framework_TestCase
{
    public function testGettersAndSetters()
    {
        $obj = new TestMetaData();

        $fakerFactory = Factory::create();

        $filePath = $fakerFactory->name;
        $obj->setFilePath($filePath);
        $this->assertEquals($filePath, $obj->getFilePath());

        $className = $fakerFactory->name;
        $obj->setClassName($className);
        $this->assertEquals($className, $obj->getClassName());

        $fullyQualifiedClassName = $fakerFactory->name;
        $obj->setFullyQualifiedClassName($fullyQualifiedClassName);
        $this->assertEquals($fullyQualifiedClassName, $obj->getFullyQualifiedClassName());

        $testClassName = $fakerFactory->name;
        $obj->setTestClassName($testClassName);
        $this->assertEquals($testClassName, $obj->getTestClassName());

        $testFullyQualifiedClassName = $fakerFactory->name;
        $obj->setTestFullyQualifiedClassName($testFullyQualifiedClassName);
        $this->assertEquals($testFullyQualifiedClassName, $obj->getTestFullyQualifiedClassName());

        $reflectionObject = $fakerFactory->name;
        $obj->setReflectionObject($reflectionObject);
        $this->assertEquals($reflectionObject, $obj->getReflectionObject());
    }

    public function testGetConstructorReflection()
    {
        $obj = new TestMetaData();

        $mockMethod1 = m::mock();
        $mockMethod1->shouldReceive('isConstructor')->once()->andReturn(false);

        $mockMethod2 = m::mock();
        $mockMethod2->shouldReceive('isConstructor')->once()->andReturn(true);

        $mockMethod3 = m::mock();
        $mockMethod3->shouldReceive('isConstructor')->never()->andReturn(false);

        $mockReflectionObject = m::mock();
        $mockReflectionObject->shouldReceive('getMethods')->andReturn([$mockMethod1, $mockMethod2, $mockMethod3]);

        $obj->setReflectionObject($mockReflectionObject);

        $result = $obj->getConstructorReflection();

        $this->assertEquals($mockMethod2, $result);
    }

    public function testGetConstructorReflectionWithoutConstructor()
    {
        $obj = new TestMetaData();

        $mockMethod1 = m::mock();
        $mockMethod1->shouldReceive('isConstructor')->once()->andReturn(false);

        $mockMethod2 = m::mock();
        $mockMethod2->shouldReceive('isConstructor')->once()->andReturn(false);

        $mockReflectionObject = m::mock();
        $mockReflectionObject->shouldReceive('getMethods')->andReturn([$mockMethod1, $mockMethod2]);

        $obj->setReflectionObject($mockReflectionObject);

        $result = $obj->getConstructorReflection();

        $this->assertNull($result);
    }

    public function testGetConstructorReflectionClassWithoutMethods()
    {
        $obj = new TestMetaData();

        $mockReflectionObject = m::mock();
        $mockReflectionObject->shouldReceive('getMethods')->andReturn([]);

        $obj->setReflectionObject($mockReflectionObject);

        $result = $obj->getConstructorReflection();

        $this->assertNull($result);
    }

    public function testHasConstructorParams()
    {
        $obj = new TestMetaData();

        $mockMethod1 = m::mock();
        $mockMethod1->shouldReceive('isConstructor')->once()->andReturn(false);

        $mockMethod2 = m::mock();
        $mockMethod2->shouldReceive('isConstructor')->once()->andReturn(true);
        $mockMethod2->shouldReceive('getParameters')->once()->andReturn(['arg1']);

        $mockMethod3 = m::mock();
        $mockMethod3->shouldReceive('isConstructor')->never()->andReturn(false);

        $mockReflectionObject = m::mock();
        $mockReflectionObject->shouldReceive('getMethods')->andReturn([$mockMethod1, $mockMethod2, $mockMethod3]);

        $obj->setReflectionObject($mockReflectionObject);

        $result = $obj->hasConstructorParams();

        $this->assertTrue($result);
    }

    public function testHasConstructorParamsNoParams()
    {
        $obj = new TestMetaData();

        $mockMethod1 = m::mock();
        $mockMethod1->shouldReceive('isConstructor')->once()->andReturn(false);

        $mockMethod2 = m::mock();
        $mockMethod2->shouldReceive('isConstructor')->once()->andReturn(true);
        $mockMethod2->shouldReceive('getParameters')->once()->andReturn([]);

        $mockMethod3 = m::mock();
        $mockMethod3->shouldReceive('isConstructor')->never()->andReturn(false);

        $mockReflectionObject = m::mock();
        $mockReflectionObject->shouldReceive('getMethods')->andReturn([$mockMethod1, $mockMethod2, $mockMethod3]);

        $obj->setReflectionObject($mockReflectionObject);

        $result = $obj->hasConstructorParams();

        $this->assertFalse($result);
    }

    public function testHasConstructorParamsWithoutConstructor()
    {
        $obj = new TestMetaData();

        $mockMethod1 = m::mock();
        $mockMethod1->shouldReceive('isConstructor')->once()->andReturn(false);

        $mockMethod2 = m::mock();
        $mockMethod2->shouldReceive('isConstructor')->once()->andReturn(false);

        $mockReflectionObject = m::mock();
        $mockReflectionObject->shouldReceive('getMethods')->andReturn([$mockMethod1, $mockMethod2]);

        $obj->setReflectionObject($mockReflectionObject);

        $result = $obj->hasConstructorParams();

        $this->assertFalse($result);
    }

    public function testHasConstructorParamsClassWithoutMethods()
    {
        $obj = new TestMetaData();

        $mockReflectionObject = m::mock();
        $mockReflectionObject->shouldReceive('getMethods')->andReturn([]);

        $obj->setReflectionObject($mockReflectionObject);

        $result = $obj->hasConstructorParams();

        $this->assertFalse($result);
    }
}

<?php
namespace tests\Unit\NullDev\TeeGee\TestDomain;

use NullDev\TeeGee\TestDomain\TestMetaDataGenerator;
use Mockery as m;

class TestMetaDataGeneratorTest extends \PHPUnit_Framework_TestCase
{
    public function testGenerateUnit()
    {
        $mockTestMetaData = m::mock();
        $mockTestMetaData->shouldReceive('setClassName')->once()->with('ClassName');
        $mockTestMetaData->shouldReceive('setFullyQualifiedClassName')->once()->with('Namespace\ClassName');
        $mockTestMetaData->shouldReceive('setTestClassName')->once()->with('ClassNameTest');
        $mockTestMetaData
            ->shouldReceive('setTestFullyQualifiedClassName')->once()->with('Tests\Unit\Namespace\ClassNameTest');
        $mockTestMetaData
            ->shouldReceive('setFilePath')->once()->with('/src/Tests/Unit/Namespace/ClassNameTest.php');
        $mockTestMetaData
            ->shouldReceive('setReflectionObject')->once()->with('reflection');

        $mockTestMetaDataFactory = m::mock();
        $mockTestMetaDataFactory->shouldReceive('create')->once()->andReturn($mockTestMetaData);

        $mockSettings = m::mock();

        $mockClassMetaData = m::mock();
        $mockClassMetaData
            ->shouldReceive('getClassName')->times(1)->andReturn('ClassName');
        $mockClassMetaData
            ->shouldReceive('getFullyQualifiedClassName')->times(1)->andReturn('Namespace\ClassName');
        $mockClassMetaData
            ->shouldReceive('getReflectionObject')->once()->andReturn('reflection');

        $mockConverter = m::mock();
        $mockConverter
            ->shouldReceive('getTestClassName')->once()->andReturn('ClassNameTest');
        $mockConverter
            ->shouldReceive('getUnitTestFqdn')->once()->andReturn('Tests\Unit\Namespace\ClassNameTest');
        $mockConverter
            ->shouldReceive('getUnitTestFilePath')->once()->andReturn('/src/Tests/Unit/Namespace/ClassNameTest.php');

        $mockConverterFactory = m::mock();
        $mockConverterFactory
            ->shouldReceive('create')
            ->once()
            ->with($mockClassMetaData, $mockSettings)
            ->andReturn($mockConverter);

        $generator = new TestMetaDataGenerator($mockTestMetaDataFactory, $mockConverterFactory);

        $result = $generator->generateUnit($mockSettings, $mockClassMetaData);

        $this->assertEquals($mockTestMetaData, $result);
    }

    public function testGenerateIntegration()
    {
        $mockTestMetaData = m::mock();
        $mockTestMetaData->shouldReceive('setClassName')->once()->with('ClassName');
        $mockTestMetaData->shouldReceive('setFullyQualifiedClassName')->once()->with('Namespace\ClassName');
        $mockTestMetaData->shouldReceive('setTestClassName')->once()->with('ClassNameTest');
        $mockTestMetaData
            ->shouldReceive('setTestFullyQualifiedClassName')
            ->once()
            ->with('Tests\Integration\Namespace\ClassNameTest');
        $mockTestMetaData
            ->shouldReceive('setFilePath')->once()->with('/src/Tests/Integration/Namespace/ClassNameTest.php');
        $mockTestMetaData
            ->shouldReceive('setReflectionObject')->once()->with('reflection');

        $mockTestMetaDataFactory = m::mock();
        $mockTestMetaDataFactory->shouldReceive('create')->once()->andReturn($mockTestMetaData);

        $mockSettings = m::mock();

        $mockClassMetaData = m::mock();
        $mockClassMetaData
            ->shouldReceive('getClassName')->times(1)->andReturn('ClassName');
        $mockClassMetaData
            ->shouldReceive('getFullyQualifiedClassName')->times(1)->andReturn('Namespace\ClassName');
        $mockClassMetaData
            ->shouldReceive('getReflectionObject')->once()->andReturn('reflection');

        $mockConverter = m::mock();
        $mockConverter
            ->shouldReceive('getTestClassName')->once()->andReturn('ClassNameTest');
        $mockConverter
            ->shouldReceive('getIntegrationTestFqdn')->once()->andReturn('Tests\Integration\Namespace\ClassNameTest');
        $mockConverter
            ->shouldReceive('getIntegrationTestFilePath')
            ->once()
            ->andReturn('/src/Tests/Integration/Namespace/ClassNameTest.php');

        $mockConverterFactory = m::mock();
        $mockConverterFactory
            ->shouldReceive('create')
            ->once()
            ->with($mockClassMetaData, $mockSettings)
            ->andReturn($mockConverter);

        $generator = new TestMetaDataGenerator($mockTestMetaDataFactory, $mockConverterFactory);

        $result = $generator->generateIntegration($mockSettings, $mockClassMetaData);

        $this->assertEquals($mockTestMetaData, $result);
    }
}

<?php
namespace Tests\Unit\NullDev\TeeGee\ClassDomain;

use Mockery as m;
use NullDev\TeeGee\ClassDomain\ClassMetaDataGenerator;

class ClassMetaDataGeneratorTest extends \PHPUnit_Framework_TestCase
{
    public function testGenerate()
    {
        $mockResult = m::mock();
        $mockResult->shouldReceive('getFullyQualifiedClassName')->times(3)->andReturn('Namespace\ClassName');
        $mockResult->shouldReceive('getClassName')->once()->andReturn('ClassName');

        $mockMetaData = m::mock();
        $mockMetaData->shouldReceive('setFilePath')->once()->with('some-filename');
        $mockMetaData->shouldReceive('setClassName')->once()->with('ClassName');
        $mockMetaData->shouldReceive('setFullyQualifiedClassName')->once()->with('Namespace\ClassName');
        $mockMetaData->shouldReceive('setReflectionObject')->once()->with('reflectionObject');

        $mockFactory = m::mock();
        $mockFactory->shouldReceive('create')->once()->andReturn($mockMetaData);

        $mockParser = m::mock();
        $mockParser->shouldReceive('parse')->once()->andReturn($mockResult);

        $mockFileLoader = m::mock();
        $mockFileLoader->shouldReceive('load')->once()->with('some-filename');

        $mockReflectionClassGen = m::mock();
        $mockReflectionClassGen
            ->shouldReceive('generate')
            ->once()
            ->with('Namespace\ClassName')
            ->andReturn('reflectionObject');

        $generator = new ClassMetaDataGenerator($mockFactory, $mockParser, $mockFileLoader, $mockReflectionClassGen);

        $result = $generator->generate('some-filename');

        $this->assertNotNull($result);
    }

    public function testGenerateNoClassFound()
    {
        $mockResult = m::mock();
        $mockResult->shouldReceive('getFullyQualifiedClassName')->once()->andReturn(null);

        $mockParser = m::mock();
        $mockParser->shouldReceive('parse')->once()->andReturn($mockResult);

        $generator = new ClassMetaDataGenerator(m::mock(), $mockParser, m::mock(), m::mock());

        $result = $generator->generate('some-filename');

        $this->assertNotNull($result);
    }

    public function testGenerateNoFileFound()
    {
        $mockParser = m::mock();
        $mockParser->shouldReceive('parse')->once()->andThrow('\Exception');

        $generator = new ClassMetaDataGenerator(m::mock(), $mockParser, m::mock(), m::mock());

        $result = $generator->generate('some-filename');

        $this->assertFalse($result);
    }
}

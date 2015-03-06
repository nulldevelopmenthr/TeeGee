<?php
namespace tests\Unit\NullDev\TeeGee\TestFileGenerator;

use NullDev\TeeGee\TestFileGenerator\BasicUnitTestGenerator;
use Mockery as m;

/**
 *
 */
class BasicUnitTestGeneratorTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @covers NullDev\TeeGee\TestFileGenerator\BasicUnitTestGenerator::getDependencies
     */
    public function testGetDependencies()
    {
        $mockMetaData = m::mock('NullDev\TeeGee\TestDomain\TestMetaData');
        $mockMetaData->shouldReceive('getFullyQualifiedClassName')->once()->andReturn('Vendor\Package\ClassName');

        $generator = new BasicUnitTestGenerator($mockMetaData);

        $result = $generator->getDependencies();

        $expected = [
            'Vendor\Package\ClassName',
            'Mockery as m',
        ];

        $this->assertEquals($expected, $result);
    }

    /**
     * @covers NullDev\TeeGee\TestFileGenerator\BasicUnitTestGenerator::getDependenciesString
     */
    public function testGetDependenciesString()
    {
        $mockMetaData = m::mock('NullDev\TeeGee\TestDomain\TestMetaData');
        $mockMetaData->shouldReceive('getFullyQualifiedClassName')->once()->andReturn('Vendor\Package\ClassName');

        $generator = new BasicUnitTestGenerator($mockMetaData);

        $result = $generator->getDependenciesString();

        $expected = 'use Vendor\Package\ClassName;'.PHP_EOL.'use Mockery as m;';

        $this->assertEquals($expected, $result);
    }
}

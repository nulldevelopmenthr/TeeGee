<?php
namespace NullDev\Generator\Tests\Unit\Generator;

use NullDev\TeeGee\Core\SettingsGenerator;
use Mockery as m;

class SettingsGeneratorTest extends \PHPUnit_Framework_TestCase
{
    public function testGenerate()
    {
        $mockSettings = m::mock();
        $mockSettings->shouldReceive('setRootPath')->once()->with('path/');
        $mockSettings->shouldReceive('setTestPath')->once()->with('path/Tests/');
        $mockSettings->shouldReceive('setUnitTestPath')->once()->with('path/Tests/Unit/');
        $mockSettings->shouldReceive('setFunctionalTestPath')->once()->with('path/Tests/Functional/');
        $mockSettings->shouldReceive('setIntegrationalTestPath')->once()->with('path/Tests/Integration/');

        $mockFactory = m::mock();
        $mockFactory->shouldReceive('create')->once()->andReturn($mockSettings);

        $generator = new SettingsGenerator($mockFactory);

        $result = $generator->generate('path/');

        $this->assertEquals($mockSettings, $result);
    }

    public function testGenerateWithouthLeadingSlash()
    {
        $mockSettings = m::mock();
        $mockSettings->shouldReceive('setRootPath')->once()->with('path/');
        $mockSettings->shouldReceive('setTestPath')->once()->with('path/Tests/');
        $mockSettings->shouldReceive('setUnitTestPath')->once()->with('path/Tests/Unit/');
        $mockSettings->shouldReceive('setFunctionalTestPath')->once()->with('path/Tests/Functional/');
        $mockSettings->shouldReceive('setIntegrationalTestPath')->once()->with('path/Tests/Integration/');

        $mockFactory = m::mock();
        $mockFactory->shouldReceive('create')->once()->andReturn($mockSettings);

        $generator = new SettingsGenerator($mockFactory);

        $result = $generator->generate('path');

        $this->assertEquals($mockSettings, $result);
    }
}

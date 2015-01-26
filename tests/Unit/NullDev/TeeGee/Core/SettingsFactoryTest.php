<?php
namespace NullDev\Generator\Tests\Unit\Factory;

use NullDev\TeeGee\Core\SettingsFactory;

class SettingsFactoryTest extends \PHPUnit_Framework_TestCase
{
    public function testCreate()
    {
        $factory = new SettingsFactory();

        $result = $factory->create();

        $this->assertInstanceOf('NullDev\TeeGee\Core\Settings', $result);
    }
}

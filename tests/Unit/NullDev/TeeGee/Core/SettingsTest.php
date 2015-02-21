<?php
namespace NullDev\Generator\Tests\Unit;

use NullDev\TeeGee\Core\Settings;

class SettingsTest extends \PHPUnit_Framework_TestCase
{
    public function testGettersAndSetters()
    {
        $obj = new Settings();

        $obj->setRootPath('path');
        $this->assertEquals('path', $obj->getRootPath());

        $obj->setTestPath('test-path');
        $this->assertEquals('test-path', $obj->getTestPath());

        $obj->setUnitTestPath('unit-test-path');
        $this->assertEquals('unit-test-path', $obj->getUnitTestPath());

        $obj->setFunctionalTestPath('func-test-path');
        $this->assertEquals('func-test-path', $obj->getFunctionalTestPath());

        $obj->setIntegrationalTestPath('integ-test-path');
        $this->assertEquals('integ-test-path', $obj->getIntegrationalTestPath());
    }
}

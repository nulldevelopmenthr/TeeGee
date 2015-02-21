<?php
namespace Tests\Integration\NullDev\TeeGee\Core\SettingsGeneratorTest;

use NullDev\TeeGee\Core\SettingsFactory;
use NullDev\TeeGee\Core\SettingsGenerator;

/**
 *
 */
class SettingsGeneratorTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var SettingsGenerator
     */
    protected $object;

    /**
     */
    protected function setUp()
    {
        $settingsFactory = new SettingsFactory();

        $this->object = new SettingsGenerator($settingsFactory);
    }

    /**
     *
     */
    public function testGenerate()
    {
        $path = realpath(__DIR__);

        $result = $this->object->generate($path);

        $this->assertEquals(
            $path.DIRECTORY_SEPARATOR,
            $result->getRootPath()
        );

        $this->assertEquals(
            $path.DIRECTORY_SEPARATOR.'Tests'.DIRECTORY_SEPARATOR,
            $result->getTestPath()
        );

        $this->assertEquals(
            $path.DIRECTORY_SEPARATOR.'Tests'.DIRECTORY_SEPARATOR.'Unit'.DIRECTORY_SEPARATOR,
            $result->getUnitTestPath()
        );
        $this->assertEquals(
            $path.DIRECTORY_SEPARATOR.'Tests'.DIRECTORY_SEPARATOR.'Functional'.DIRECTORY_SEPARATOR,
            $result->getFunctionalTestPath()
        );
        $this->assertEquals(
            $path.DIRECTORY_SEPARATOR.'Tests'.DIRECTORY_SEPARATOR.'Integration'.DIRECTORY_SEPARATOR,
            $result->getIntegrationalTestPath()
        );
    }
}

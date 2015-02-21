<?php
namespace Tests\Integration\NullDev\TeeGee\TestDomain;

use Tests\Integration\NullDev\TeeGee\AbstractIntegrationTestBase;

/**
 * Class TestMetaDataGeneratorTest.
 */
class TestMetaDataGeneratorTest extends AbstractIntegrationTestBase
{
    protected $generator;

    public function setUp()
    {
        $this->generator = $this->getTestMetaDataGenerator();
    }

    public function testGenerate()
    {
        $path = TEEGEE_TESTDATA_PATH;

        $settings = $this->getSettingsGenerator()->generate($path);
        $fileList = $this->getRecursiveFileListGenerator()->files()->name('*.php')->in($path);

        $classMetaDataGenerator = $this->getClassMetaDataGenerator();

        foreach ($fileList as $file) {
            $classMetaData = $classMetaDataGenerator->generate($file);

            if (!$classMetaData) {
                continue;
            }

            $result = $this->generator->generateUnit($settings, $classMetaData);

            $this->assertInstanceOf('NullDev\TeeGee\TestDomain\TestMetaData', $result);
        }
    }
}

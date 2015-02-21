<?php
namespace Tests\Integration\NullDev\TeeGee\ClassDomain;

use Tests\Integration\NullDev\TeeGee\AbstractIntegrationTestBase;

class ClassMetaDataGeneratorTest extends AbstractIntegrationTestBase
{
    protected $generator;

    public function setUp()
    {
        $this->generator = $this->getClassMetaDataGenerator();
    }

    /**
     * @dataProvider getTestFiles
     */
    public function testGenerate($fileName, $className)
    {
        $result = $this->generator->generate($fileName);

        $this->assertEquals($fileName, $result->getFilePath());
        $this->assertEquals($className, $result->getFullyQualifiedClassName());
    }

    /**
     */
    public function testGenerateAbstractFile()
    {
        $result = $this->generator->generate(TEEGEE_TESTDATA_PATH.'/Calculator/AbstractCalculator.php');

        $this->assertFalse($result);
    }

    public function testGenerateNonExistingFile()
    {
        $result = $this->generator->generate('non-existant-file.php');

        $this->assertFalse($result);
    }

    public function getTestFiles()
    {
        return [
            [
                TEEGEE_TESTDATA_PATH.'/Calculator/SimpleCalculator.php',
                'Calculator\SimpleCalculator',
            ],
            [
                TEEGEE_TESTDATA_PATH.'/Calculator/AdvancedCalculator.php',
                'Calculator\AdvancedCalculator',
            ],
            [
                TEEGEE_TESTDATA_PATH.'/Calculator/BasicCalculator.php',
                'Calculator\BasicCalculator',
            ],
            [
                TEEGEE_TESTDATA_PATH.'/Calculator/FinalCalculator.php',
                'Calculator\FinalCalculator',
            ],
            [
                TEEGEE_TESTDATA_PATH.'/Phone/FeaturePhone/Nokia3320.php',
                'Phone\FeaturePhone\Nokia3320',
            ],
            [
                TEEGEE_TESTDATA_PATH.'/Phone/SmartPhone/Apple/Iphone4.php',
                'Phone\SmartPhone\Apple\Iphone4',
            ],
        ];
    }
}

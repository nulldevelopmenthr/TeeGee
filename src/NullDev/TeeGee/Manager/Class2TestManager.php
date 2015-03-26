<?php

namespace NullDev\TeeGee\Manager;

use NullDev\TeeGee\TestDomain\TestGen\AdvUnitTestGen;
use NullDev\TeeGee\TestDomain\TestGen\BasicIntegrationTestGen;
use NullDev\TeeGee\TestDomain\TestGen\BasicUnitTestGen;

/**
 * Class Class2TestManager.
 */
class Class2TestManager
{
    /**
     * @var
     */
    protected $fileListGenerator;
    /**
     * @var
     */
    protected $classMetaDataGenerator;
    /**
     * @var
     */
    protected $settingsGenerator;
    /**
     * @var
     */
    protected $testMetaDataGenerator;

    /**
     * @param $fileListGenerator
     * @param $classMetaDataGenerator
     * @param $settingsGenerator
     * @param $testMetaDataGenerator
     */
    public function __construct($fileListGenerator, $classMetaDataGenerator, $settingsGenerator, $testMetaDataGenerator)
    {
        $this->fileListGenerator      = $fileListGenerator;
        $this->classMetaDataGenerator = $classMetaDataGenerator;
        $this->settingsGenerator      = $settingsGenerator;
        $this->testMetaDataGenerator  = $testMetaDataGenerator;
    }

    /**
     * @var array
     */
    protected $skipClasses = [
        'Exception',
        'Symfony\Component\HttpKernel\Bundle\Bundle',
        'PHPUnit_Framework_TestCase',
        'Symfony\Bundle\FrameworkBundle\Controller\Controller',
        'Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand',
        'Symfony\Component\HttpKernel\DependencyInjection\Extension',
        'Sonata\AdminBundle\Admin\Admin',
    ];
    /**
     * @var array
     */
    protected $skipInterfaces = [
        'Doctrine\Common\DataFixtures\OrderedFixtureInterface',
        'Doctrine\Common\DataFixtures\SharedFixtureInterface',
        'Doctrine\Common\DataFixtures\FixtureInterface',
        'Symfony\Component\Config\Definition\ConfigurationInterface',

    ];

    /**
     * @param $classMetaData
     *
     * @return bool
     */
    public function checkIfAllowed($classMetaData)
    {
        $class = $classMetaData->getReflectionObject();

        foreach ($class->getInterfaceNames() as $interfaceName) {
            if (in_array($interfaceName, $this->skipInterfaces)) {
                return false;
            }
        }

        while ($parent = $class->getParentClass()) {
            if (in_array($parent->getName(), $this->skipClasses)) {
                return false;
            }

            $class = $parent;
        }

        return true;
    }

    /**
     * @param $path
     *
     * @return bool
     */
    public function run($path)
    {
        $excludePaths = [
            '_testdata',
        ];

        $settings = $this->settingsGenerator->generate($path);
        $files    = $this->fileListGenerator->files()->name('*.php')->in($path)->exclude($excludePaths);

        $classMetaDatas   = [];
        $testMetaDatas    = [];
        $testMetaDataInts = [];

        foreach ($files as $filePath) {
            $classMetaData = $this->classMetaDataGenerator->generate($filePath);

            if ($classMetaData
                && substr($classMetaData->getClassName(), -4, 4) !== 'Test'
                && $this->checkIfAllowed($classMetaData)
            ) {
                $classMetaDatas [] = $classMetaData;
            }
        }

        foreach ($classMetaDatas as $classMetaData) {
            $testMetaData = $this->testMetaDataGenerator->generateUnit($settings, $classMetaData);

            if ($testMetaData) {
                $testMetaDatas[] = $testMetaData;
            }

            $testMetaDataInt = $this->testMetaDataGenerator->generateIntegration($settings, $classMetaData);

            if ($testMetaDataInt && $testMetaData->hasConstructorParams()) {
                $testMetaDataInts[] = $testMetaDataInt;
            }
        }

        $this->doUnitTests($testMetaDatas);

        //$this->doIntegrationTests($testMetaDataInts);

        return false;
    }

    /**
     * @param $testMetaData
     *
     * @return int
     */
    public function getGettersSettersPercentage($testMetaData)
    {
        $totalMethodCount       = 0;
        $gettersAndSettersCount = 0;

        foreach ($testMetaData->getReflectionObject()->getMethods() as $method) {
            if ($method->isPublic() && !$method->isConstructor()) {
                $totalMethodCount++;
                if (substr($method->name, 0, 3) === 'get') {
                    $gettersAndSettersCount++;
                }
                if (substr($method->name, 0, 3) === 'set') {
                    $gettersAndSettersCount++;
                }
            }
        }

        if ($totalMethodCount > 0) {
            return (int) (100 * ($gettersAndSettersCount / $totalMethodCount));
        } else {
            return 0;
        }
    }

    /**
     * @param $testMetaDatas
     */
    public function doUnitTests($testMetaDatas)
    {
        foreach ($testMetaDatas as $testMetaData) {
            $fileName = $testMetaData->getFilePath();

            if (is_file($fileName)) {
                echo 'Filename '.$fileName.' already exists'.PHP_EOL;
                continue;
                //unlink($fileName);
            }
            /*
                        if ($this->getGettersSettersPercentage($testMetaData) > 150) {
                            continue;

                        } elseif ($testMetaData->hasConstructorParams()) {
                            $testTemplate = new AdvUnitTestGen($testMetaData);
                        } else {
                            $testTemplate = new BasicUnitTestGen($testMetaData);
                        }
            */

            echo PHP_EOL.'Working on:'.$testMetaData->getClassName().PHP_EOL;

            if ($testMetaData->hasConstructorParams()) {
                $testTemplate = new AdvUnitTestGen($testMetaData);
            } else {
                $testTemplate = new BasicUnitTestGen($testMetaData);
            }

            $content = $testTemplate->render();

            $temporary = explode('/', $fileName);
            array_pop($temporary);
            $folder = implode('/', $temporary);

            if (!is_dir($folder)) {
                mkdir($folder, 0744, true);
            }

            file_put_contents($fileName, $content);
        }
    }

    /**
     * @param $testMetaDataInts
     */
    public function doIntegrationTests($testMetaDataInts)
    {
        foreach ($testMetaDataInts as $testMetaData) {
            $fileName = $testMetaData->getFilePath();

            if (is_file($fileName)) {
                echo 'Filename '.$fileName.' already exists'.PHP_EOL;
                continue;
                //unlink($fileName);
            }

            $basic = new BasicIntegrationTestGen($testMetaData);

            $content = $basic->render();

            $temporary = explode('/', $fileName);
            array_pop($temporary);
            $folder = implode('/', $temporary);

            if (!is_dir($folder)) {
                mkdir($folder, 0744, true);
            }

            file_put_contents($fileName, $content);
        }
    }
}

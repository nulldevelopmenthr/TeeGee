<?php
namespace Tests\Integration\NullDev\TeeGee;

use NullDev\TeeGee\Core\SettingsFactory;
use NullDev\TeeGee\TestDomain\Class2TestMetaDataConverterFactory;
use NullDev\TeeGee\TestDomain\TestMetaDataFactory;
use NullDev\TeeGee\ClassDomain\ClassMetaDataFactory;
use NullDev\TeeGee\ClassDomain\ClassMetaDataGenerator;
use NullDev\Examiner\ReflectionClassGenerator;
use NullDev\TeeGee\Core\SettingsGenerator;
use NullDev\TeeGee\TestDomain\TestMetaDataGenerator;
use NullDev\Generator\Manager\Class2TestManager;
use NullDev\Examiner\FileParser\PhpFileParser;
use NullDev\Examiner\FileParser\PhpFileParseResultFactory;
use NullDev\Examiner\PhpFileLoader;
use Symfony\Component\Finder\Finder;

/**
 * Class AbstractIntegrationTestBase.
 *
 * @SuppressWarnings("PHPMD.CouplingBetweenObjects")
 */
abstract class AbstractIntegrationTestBase extends \PHPUnit_Framework_TestCase
{
    public function getRecursiveFileListGenerator()
    {
        return new Finder();
    }

    public function getClassMetaDataFactory()
    {
        return new ClassMetaDataFactory();
    }

    public function getFileParseResultFactory()
    {
        return new PhpFileParseResultFactory();
    }

    public function getFileParser()
    {
        return new PhpFileParser($this->getFileParseResultFactory());
    }

    private function getFileLoader()
    {
        return new PhpFileLoader();
    }

    public function getClassMetaDataGenerator()
    {
        return new ClassMetaDataGenerator(
            $this->getClassMetaDataFactory(),
            $this->getFileParser(),
            $this->getFileLoader(),
            new ReflectionClassGenerator()
        );
    }

    public function getSettingsFactory()
    {
        return new SettingsFactory();
    }

    public function getSettingsGenerator()
    {
        return new SettingsGenerator($this->getSettingsFactory());
    }

    public function getTestMetaDataFactory()
    {
        return new TestMetaDataFactory();
    }

    public function getClass2TestMetaDataConverterFactory()
    {
        return new Class2TestMetaDataConverterFactory();
    }

    public function getTestMetaDataGenerator()
    {
        return new TestMetaDataGenerator(
            $this->getTestMetaDataFactory(), $this->getClass2TestMetaDataConverterFactory()
        );
    }

    public function getClass2TestManager()
    {
        return new Class2TestManager(
            $this->getRecursiveFileListGenerator(),
            $this->getClassMetaDataGenerator(),
            $this->getSettingsGenerator(),
            $this->getTestMetaDataGenerator()
        );
    }
}

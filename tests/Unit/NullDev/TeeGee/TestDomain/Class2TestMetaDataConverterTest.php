<?php
namespace Tests\Unit\NullDev\TeeGee\TestDomain\Class2TestMetaDataConverterTest;

use NullDev\TeeGee\TestDomain\Class2TestMetaDataConverter;
use Mockery as m;

/**
 *
 */
class Class2TestMetaDataConverterTest extends \PHPUnit_Framework_TestCase
{

    /**
     * @dataProvider providerTestData
     */
    public function testGetUnitTestFilePath($mockClassMetaData, $mockSettings, $expectedResult)
    {
        $obj    = new Class2TestMetaDataConverter($mockClassMetaData, $mockSettings);
        $result = $obj->getUnitTestFilePath();

        $this->assertEquals($expectedResult['unitTestFilePath'], $result);
    }

    /**
     * @dataProvider providerTestData
     */
    public function testGetFunctionalTestFilePath($mockClassMetaData, $mockSettings, $expectedResult)
    {
        $obj    = new Class2TestMetaDataConverter($mockClassMetaData, $mockSettings);
        $result = $obj->getFunctionalTestFilePath();

        $this->assertEquals($expectedResult['functionalTestFilePath'], $result);
    }

    /**
     * @dataProvider providerTestData
     */
    public function testGetIntegrationTestFilePath($mockClassMetaData, $mockSettings, $expectedResult)
    {
        $obj    = new Class2TestMetaDataConverter($mockClassMetaData, $mockSettings);
        $result = $obj->getIntegrationTestFilePath();

        $this->assertEquals($expectedResult['integrationTestFilePath'], $result);
    }

    /**
     * @dataProvider providerTestData
     */
    public function testGetUnitTestFqdn($mockClassMetaData, $mockSettings, $expectedResult)
    {
        $obj    = new Class2TestMetaDataConverter($mockClassMetaData, $mockSettings);
        $result = $obj->getUnitTestFqdn();

        $this->assertEquals($expectedResult['unitTestFqdn'], $result);
    }

    /**
     * @dataProvider providerTestData
     */
    public function testGetFunctionalTestFqdn($mockClassMetaData, $mockSettings, $expectedResult)
    {
        $obj    = new Class2TestMetaDataConverter($mockClassMetaData, $mockSettings);
        $result = $obj->getFunctionalTestFqdn();

        $this->assertEquals($expectedResult['functionalTestFqdn'], $result);
    }

    /**
     * @dataProvider providerTestData
     */
    public function testGetIntegrationTestFqdn($mockClassMetaData, $mockSettings, $expectedResult)
    {
        $obj    = new Class2TestMetaDataConverter($mockClassMetaData, $mockSettings);
        $result = $obj->getIntegrationTestFqdn();

        $this->assertEquals($expectedResult['integrationTestFqdn'], $result);
    }

    /**
     * @dataProvider providerTestData
     */
    public function testGetUnitTestBaseNamespace($mockClassMetaData, $mockSettings, $expectedResult)
    {
        $obj    = new Class2TestMetaDataConverter($mockClassMetaData, $mockSettings);
        $result = $obj->getUnitTestBaseNamespace();

        $this->assertEquals($expectedResult['unitTestBaseNamespace'], $result);
    }

    /**
     * @dataProvider providerTestData
     */
    public function testGetFunctionalTestBaseNamespace($mockClassMetaData, $mockSettings, $expectedResult)
    {
        $obj    = new Class2TestMetaDataConverter($mockClassMetaData, $mockSettings);
        $result = $obj->getFunctionalTestBaseNamespace();

        $this->assertEquals($expectedResult['functionalTestBaseNamespace'], $result);
    }

    /**
     * @dataProvider providerTestData
     */
    public function testGetIntegrationTestBaseNamespace($mockClassMetaData, $mockSettings, $expectedResult)
    {
        $obj    = new Class2TestMetaDataConverter($mockClassMetaData, $mockSettings);
        $result = $obj->getIntegrationTestBaseNamespace();

        $this->assertEquals($expectedResult['integrationTestBaseNamespace'], $result);
    }

    /**
     * @dataProvider providerTestData
     */
    public function testGetBaseNamespace($mockClassMetaData, $mockSettings, $expectedResult)
    {
        $obj    = new Class2TestMetaDataConverter($mockClassMetaData, $mockSettings);
        $result = $obj->getBaseNamespace();

        $this->assertEquals($expectedResult['baseNamespace'], $result);
    }

    /**
     * @dataProvider providerTestData
     */
    public function testGetClassFilePathWithoutExtension($mockClassMetaData, $mockSettings, $expectedResult)
    {
        $obj    = new Class2TestMetaDataConverter($mockClassMetaData, $mockSettings);
        $result = $obj->getClassFilePathWithoutExtension();

        $this->assertEquals($expectedResult['classFilePathWithoutExtension'], $result);
    }

    /**
     * @dataProvider providerTestData
     */
    public function testGetClassPathWithoutRootAndExtension($mockClassMetaData, $mockSettings, $expectedResult)
    {
        $obj    = new Class2TestMetaDataConverter($mockClassMetaData, $mockSettings);
        $result = $obj->getClassPathWithoutRootAndExtension();

        $this->assertEquals($expectedResult['classPathWithoutRootAndExtension'], $result);
    }

    /**
     * @dataProvider providerTestData
     */
    public function testGetClassNamespaceFromRootPathOnwards($mockClassMetaData, $mockSettings, $expectedResult)
    {
        $obj = new Class2TestMetaDataConverter($mockClassMetaData, $mockSettings);

        $result = $obj->getClassNamespaceFromRootPathOnwards();

        $this->assertEquals($expectedResult['classNamespaceFromRootPathOnwards'], $result);
    }

    /**
     *
     */
    public function testGetTestClassName()
    {
        $mockClassMetaData = m::mock();
        $mockClassMetaData->shouldReceive('getClassName')->once()->andReturn('ClassName');

        $obj = new Class2TestMetaDataConverter($mockClassMetaData, m::mock());

        $result = $obj->getTestClassName();

        $this->assertEquals('ClassNameTest', $result);
    }

    public function providerTestData()
    {
        $mockClassMetaData1 = m::mock();
        $mockClassMetaData1->shouldReceive('getFilePath')->andReturn('/src/Vendor/Package/Service/Class.php');
        $mockClassMetaData1->shouldReceive('getFullyQualifiedClassName')->andReturn('Vendor\\Package\\Service\\Class');

        $mockSettings1 = m::mock();
        $mockSettings1->shouldReceive('getRootPath')->andReturn('/src/');
        $mockSettings1->shouldReceive('getUnitTestPath')->andReturn('/src/Tests/Unit/');
        $mockSettings1->shouldReceive('getFunctionalTestPath')->andReturn('/src/Tests/Functional/');
        $mockSettings1->shouldReceive('getIntegrationalTestPath')->andReturn('/src/Tests/Integration/');

        $mockSettingsSymfonyBundleStyle = m::mock();
        $mockSettingsSymfonyBundleStyle->shouldReceive('getRootPath')->andReturn('/src/Vendor/Package/');
        $mockSettingsSymfonyBundleStyle
            ->shouldReceive('getUnitTestPath')->andReturn('/src/Vendor/Package/Tests/Unit/');
        $mockSettingsSymfonyBundleStyle
            ->shouldReceive('getFunctionalTestPath')->andReturn('/src/Vendor/Package/Tests/Functional/');
        $mockSettingsSymfonyBundleStyle
            ->shouldReceive('getIntegrationalTestPath')->andReturn('/src/Vendor/Package/Tests/Integration/');

        return [
            [
                $mockClassMetaData1,
                $mockSettings1,
                [
                    'baseNamespace'                     => '',
                    'classFilePathWithoutExtension'     => '/src/Vendor/Package/Service/Class',
                    'classPathWithoutRootAndExtension'  => 'Vendor/Package/Service/Class',
                    'classNamespaceFromRootPathOnwards' => 'Vendor\\Package\\Service\\Class',
                    'unitTestBaseNamespace'             => 'Tests\\Unit\\',
                    'unitTestRootPath'                  => '/src/Tests/Unit/',
                    'unitTestFqdn'                      => 'Tests\\Unit\\Vendor\\Package\\Service\\ClassTest',
                    'unitTestFilePath'                  => '/src/Tests/Unit/Vendor/Package/Service/ClassTest.php',
                    'functionalTestBaseNamespace'       => 'Tests\\Functional\\',
                    'functionalTestRootPath'            => '/src/Tests/Functional/',
                    'functionalTestFqdn'                => 'Tests\\Functional\\Vendor\\Package\\Service\\ClassTest',
                    'functionalTestFilePath'            => '/src/Tests/Functional/Vendor/Package/Service/ClassTest.php',
                    'integrationTestBaseNamespace'      => 'Tests\\Integration\\',
                    'integrationTestRootPath'           => '/src/Tests/Integration/',
                    'integrationTestFqdn'               => 'Tests\\Integration\\Vendor\\Package\\Service\\ClassTest',
                    'integrationTestFilePath'           => '/src/Tests/Integration/Vendor/Package/Service/ClassTest.php',
                ]
            ],
            [
                $mockClassMetaData1,
                $mockSettingsSymfonyBundleStyle,
                [
                    'baseNamespace'                     => 'Vendor\\Package\\',
                    'classFilePathWithoutExtension'     => '/src/Vendor/Package/Service/Class',
                    'classPathWithoutRootAndExtension'  => 'Service/Class',
                    'classNamespaceFromRootPathOnwards' => 'Service\\Class',
                    'unitTestBaseNamespace'             => 'Vendor\\Package\\Tests\\Unit\\',
                    'unitTestRootPath'                  => '/src/Vendor/Package/Tests/Unit/',
                    'unitTestFqdn'                      => 'Vendor\\Package\\Tests\\Unit\\Service\\ClassTest',
                    'unitTestFilePath'                  => '/src/Vendor/Package/Tests/Unit/Service/ClassTest.php',
                    'functionalTestBaseNamespace'       => 'Vendor\\Package\\Tests\\Functional\\',
                    'functionalTestRootPath'            => '/src/Vendor/Package/Tests/Functional/',
                    'functionalTestFqdn'                => 'Vendor\\Package\\Tests\\Functional\\Service\\ClassTest',
                    'functionalTestFilePath'            => '/src/Vendor/Package/Tests/Functional/Service/ClassTest.php',
                    'integrationTestBaseNamespace'      => 'Vendor\\Package\\Tests\\Integration\\',
                    'integrationTestRootPath'           => '/src/Vendor/Package/Tests/Integration/',
                    'integrationTestFqdn'               => 'Vendor\\Package\\Tests\\Integration\\Service\\ClassTest',
                    'integrationTestFilePath'           => '/src/Vendor/Package/Tests/Integration/Service/ClassTest.php',
                ]
            ],
        ];
    }
}

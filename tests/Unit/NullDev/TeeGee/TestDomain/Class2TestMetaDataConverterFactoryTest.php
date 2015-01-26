<?php
namespace Tests\Unit\NullDev\TeeGee\TestDomain\Class2TestMetaDataConverterFactoryTest;

use NullDev\TeeGee\TestDomain\Class2TestMetaDataConverterFactory;
use Mockery as m;

/**
 *
 */
class Class2TestMetaDataConverterFactoryTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var Class2TestMetaDataConverterFactory
     */
    protected $object;

    /**
     */
    protected function setUp()
    {
        $this->object = new Class2TestMetaDataConverterFactory();
    }

    /**
     *
     */
    public function testCreate()
    {
        $mockClassMetaData = m::mock();
        $mockSettings      = m::mock();

        $result = $this->object->create($mockClassMetaData, $mockSettings);

        $this->assertInstanceOf('NullDev\TeeGee\TestDomain\Class2TestMetaDataConverter', $result);
    }
}

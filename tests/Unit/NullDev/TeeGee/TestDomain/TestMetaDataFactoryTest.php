<?php
namespace Tests\Unit\NullDev\TeeGee\TestDomain;

use NullDev\TeeGee\TestDomain\TestMetaDataFactory;

class TestMetaDataFactoryTest extends \PHPUnit_Framework_TestCase
{
    public function testCreate()
    {
        $factory = new TestMetaDataFactory();

        $result = $factory->create();

        $this->assertInstanceOf('NullDev\TeeGee\TestDomain\TestMetaData', $result);
    }
}

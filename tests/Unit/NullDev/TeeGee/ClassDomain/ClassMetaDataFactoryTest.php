<?php
namespace tests\Unit\NullDev\TeeGee\ClassDomain;

use NullDev\TeeGee\ClassDomain\ClassMetaDataFactory;

class ClassMetaDataFactoryTest extends \PHPUnit_Framework_TestCase
{
    public function testCreate()
    {
        $factory = new ClassMetaDataFactory();
        $result  = $factory->create();

        $this->assertInstanceOf('NullDev\TeeGee\ClassDomain\ClassMetaData', $result);
    }
}

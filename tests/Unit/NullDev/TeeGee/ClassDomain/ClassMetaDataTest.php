<?php
namespace Tests\Unit\NullDev\TeeGee\ClassDomain;

use NullDev\TeeGee\ClassDomain\ClassMetaData;

class ClassMetaDataTest extends \PHPUnit_Framework_TestCase
{

    public function testGettersAndSetters()
    {
        $obj = new ClassMetaData();

        $obj->setFilePath('path');
        $this->assertEquals('path', $obj->getFilePath());

        $obj->setClassName('className');
        $this->assertEquals('className', $obj->getClassName());

        $obj->setFullyQualifiedClassName('full-class-name');
        $this->assertEquals('full-class-name', $obj->getFullyQualifiedClassName());

        $obj->setReflectionObject('obj');
        $this->assertEquals('obj', $obj->getReflectionObject());

    }
}

<?php

namespace spec\NullDev\TeeGee\Source;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class SourceMetaDataSpec extends ObjectBehavior
{
    public function it_is_initializable()
    {
        $this->shouldHaveType('NullDev\TeeGee\Source\SourceMetaData');
    }

    public function it_should_have_source_file_path()
    {
        $this->getFilePath();
        $this->setFilePath('path/filename.php');
    }

    public function it_should_have_source_class_name()
    {
        $this->setClassName('SomeClass');
        $this->getClassName()->shouldReturn('SomeClass');
    }

    public function it_should_have_source_fully_qualified_class_name()
    {
        $this->setFullyQualifiedClassName('Vendor\Package\SomeClass');
        $this->getFullyQualifiedClassName()->shouldReturn('Vendor\Package\SomeClass');
    }

    /**
     * @param \ReflectionClass $reflection
     */
    public function it_should_have_source_reflection($reflection)
    {
        $this->setReflection($reflection);
        $this->getReflection()->shouldReturn($reflection);
    }
}

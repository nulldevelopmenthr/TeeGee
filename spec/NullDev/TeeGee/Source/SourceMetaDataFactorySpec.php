<?php

namespace spec\NullDev\TeeGee\Source;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class SourceMetaDataFactorySpec extends ObjectBehavior
{
    public function it_is_initializable()
    {
        $this->shouldHaveType('NullDev\TeeGee\Source\SourceMetaDataFactory');
    }

    public function it_shoud_create_instance()
    {
        $this->create()->shouldReturnAnInstanceOf('NullDev\TeeGee\Source\SourceMetaData');
    }
}

<?php

namespace spec\NullDev\TeeGee\Target;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class TargetMetaDataFactorySpec extends ObjectBehavior
{
    public function it_is_initializable()
    {
        $this->shouldHaveType('NullDev\TeeGee\Target\TargetMetaDataFactory');
    }

    public function it_shoud_create_instance()
    {
        $this->create()->shouldReturnAnInstanceOf('NullDev\TeeGee\Target\TargetMetaData');
    }
}

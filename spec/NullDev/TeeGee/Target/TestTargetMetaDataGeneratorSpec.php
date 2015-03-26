<?php

namespace spec\NullDev\TeeGee\Target;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class TestTargetMetaDataGeneratorSpec extends ObjectBehavior
{
    public function it_is_initializable()
    {
        $this->shouldHaveType('NullDev\TeeGee\Target\TestTargetMetaDataGenerator');
    }
}

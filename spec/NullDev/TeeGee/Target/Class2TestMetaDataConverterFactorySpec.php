<?php

namespace spec\NullDev\TeeGee\Target;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class Class2TestMetaDataConverterFactorySpec extends ObjectBehavior
{
    public function it_is_initializable()
    {
        $this->shouldHaveType('NullDev\TeeGee\Target\Class2TestMetaDataConverterFactory');
    }
}

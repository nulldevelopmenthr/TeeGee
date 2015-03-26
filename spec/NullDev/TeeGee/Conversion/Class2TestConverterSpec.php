<?php

namespace spec\NullDev\TeeGee\Conversion;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class Class2TestConverterSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType('NullDev\TeeGee\Conversion\Class2TestConverter');
    }
}

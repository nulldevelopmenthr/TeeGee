<?php

namespace spec\NullDev\TeeGee\TestDomain;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class TestMetaDataFactorySpec extends ObjectBehavior
{
    public function it_is_initializable()
    {
        $this->shouldHaveType('NullDev\TeeGee\TestDomain\TestMetaDataFactory');
    }
}

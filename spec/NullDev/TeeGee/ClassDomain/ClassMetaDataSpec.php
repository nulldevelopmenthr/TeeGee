<?php

namespace spec\NullDev\TeeGee\ClassDomain;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class ClassMetaDataSpec extends ObjectBehavior
{
    public function it_is_initializable()
    {
        $this->shouldHaveType('NullDev\TeeGee\ClassDomain\ClassMetaData');
    }
}

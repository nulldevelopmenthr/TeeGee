<?php

namespace spec\NullDev\TeeGee\ClassDomain;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class ClassMetaDataFactorySpec extends ObjectBehavior
{
    public function it_is_initializable()
    {
        $this->shouldHaveType('NullDev\TeeGee\ClassDomain\ClassMetaDataFactory');
    }
}

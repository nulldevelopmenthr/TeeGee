<?php

namespace spec\NullDev\TeeGee\TestFileGenerator;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class TestFileSettingsSpec extends ObjectBehavior
{
    public function it_is_initializable()
    {
        $this->shouldHaveType('NullDev\TeeGee\TestFileGenerator\TestFileSettings');
    }
}

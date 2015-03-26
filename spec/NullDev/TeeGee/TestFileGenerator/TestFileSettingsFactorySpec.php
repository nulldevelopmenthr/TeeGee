<?php

namespace spec\NullDev\TeeGee\TestFileGenerator;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class TestFileSettingsFactorySpec extends ObjectBehavior
{
    public function it_is_initializable()
    {
        $this->shouldHaveType('NullDev\TeeGee\TestFileGenerator\TestFileSettingsFactory');
    }

    /**
     */
    public function it_should_create_instance_based_on_given_params()
    {
        $this->create();
    }
}

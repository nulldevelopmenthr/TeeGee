<?php

namespace spec\NullDev\TeeGee\TestDomain;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class TestMetaDataGeneratorSpec extends ObjectBehavior
{
    public function it_is_initializable()
    {
        $this->shouldHaveType('NullDev\TeeGee\TestDomain\TestMetaDataGenerator');
    }

    /**
     * @param NullDev\TeeGee\TestDomain\TestMetaDataFactory                $testMetaDataFactory
     * @param NullDev\TeeGee\TestDomain\Class2TestMetaDataConverterFactory $converterFactory
     */
    public function let($testMetaDataFactory, $converterFactory)
    {
        $this->beConstructedWith($testMetaDataFactory, $converterFactory);
    }
}

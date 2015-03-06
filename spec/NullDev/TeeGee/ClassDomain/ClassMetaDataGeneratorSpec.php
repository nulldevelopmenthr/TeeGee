<?php

namespace spec\NullDev\TeeGee\ClassDomain;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class ClassMetaDataGeneratorSpec extends ObjectBehavior
{
    public function it_is_initializable()
    {
        $this->shouldHaveType('NullDev\TeeGee\ClassDomain\ClassMetaDataGenerator');
    }

    /**
     * @param NullDev\TeeGee\ClassDomain\ClassMetaDataFactory $classMetaDataFactory
     * @param NullDev\Examiner\FileParser\PhpFileParser       $parser
     * @param NullDev\Examiner\PhpFileLoader                  $loader
     * @param NullDev\Examiner\ReflectionClassGenerator       $reflectionGenerator
     */
    public function let($classMetaDataFactory, $parser, $loader, $reflectionGenerator)
    {
        $this->beConstructedWith($classMetaDataFactory, $parser, $loader, $reflectionGenerator);
    }
}

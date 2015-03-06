<?php

namespace spec\NullDev\TeeGee\Source;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class SourceMetaDataGeneratorSpec extends ObjectBehavior
{
    public function it_is_initializable()
    {
        $this->shouldHaveType('NullDev\TeeGee\Source\SourceMetaDataGenerator');
    }

    /**
     * @param NullDev\TeeGee\Source\SourceMetaDataFactory $sourceMetaDataFactory
     * @param NullDev\Examiner\FileParser\PhpFileParser   $parser
     * @param NullDev\Examiner\PhpFileLoader              $loader
     * @param NullDev\Examiner\ReflectionClassGenerator   $reflectionGenerator
     */
    public function let($sourceMetaDataFactory, $parser, $loader, $reflectionGenerator)
    {
        $this->beConstructedWith($sourceMetaDataFactory, $parser, $loader, $reflectionGenerator);
    }

    /**
     * @param NullDev\Examiner\FileParser\PhpFileParseResult $parseResult
     * @param NullDev\TeeGee\Source\SourceMetaData           $sourceMetaData
     * @param ReflectionClass                                $reflection
     */
    public function it_should_generate_source_meta_data_from_given_filepath(
        $sourceMetaDataFactory,
        $parser,
        $loader,
        $reflectionGenerator,
        $parseResult,
        $sourceMetaData,
        $reflection
    ) {
        $parseResult->getFullyQualifiedClassName()->shouldBeCalled()->willReturn('Vendor\Package\SomeClass');
        $parseResult->getClassName()->shouldBeCalled()->willReturn('SomeClass');

        $parser->parse('path-to-a-file.php')->shouldBeCalled()->willReturn($parseResult);

        $loader->load('path-to-a-file.php')->shouldBeCalled();

        $sourceMetaDataFactory->create()->shouldBeCalled()->willReturn($sourceMetaData);

        $reflectionGenerator->generate('Vendor\Package\SomeClass')->willReturn($reflection);

        $this->generate('path-to-a-file.php')->shouldReturn($sourceMetaData);
    }

    /**
     */
    public function it_should_return_false_on_nonexistant_filepath_given($parser)
    {
        $parser->parse('unknown-path')->shouldBeCalled()->willThrow(new \Exception(''));
        $this->generate('unknown-path')->shouldReturn(false);
    }

    /**
     * @param NullDev\Examiner\FileParser\PhpFileParseResult $parseResult
     */
    public function it_should_return_false_on_filepath_not_having_class_found($parser, $parseResult)
    {
        $parseResult->getFullyQualifiedClassName()->shouldBeCalled()->willReturn(null);

        $parser->parse('no-class-in-given-filepath')->shouldBeCalled()->willReturn($parseResult);
        $this->generate('no-class-in-given-filepath')->shouldReturn(false);
    }

    /**
     * @param NullDev\TeeGee\Source\SourceMetaData $sourceMetaData
     */
    public function it_should_easily_provide_new_metadata_instance($sourceMetaDataFactory, $sourceMetaData)
    {
        $sourceMetaDataFactory->create()->shouldBeCalled()->willReturn($sourceMetaData);
        $this->getMetaDataInstance()->shouldReturn($sourceMetaData);
    }
}

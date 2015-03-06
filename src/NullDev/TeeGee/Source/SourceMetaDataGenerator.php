<?php

namespace NullDev\TeeGee\Source;

use NullDev\Examiner\FileParser\PhpFileParser;
use NullDev\Examiner\PhpFileLoader;
use NullDev\Examiner\ReflectionClassGenerator;

class SourceMetaDataGenerator
{
    /**
     * @var SourceMetaDataFactory
     */
    protected $sourceMetaDataFactory;

    /**
     * @var PhpFileParser
     */
    protected $parser;

    /**
     * @var PhpFileLoader
     */
    protected $loader;

    /**
     * @var ReflectionClassGenerator
     */
    protected $reflectionGenerator;

    /**
     * @param SourceMetaDataFactory    $sourceMetaDataFactory
     * @param PhpFileParser            $parser
     * @param PhpFileLoader            $loader
     * @param ReflectionClassGenerator $reflectionGenerator
     */
    public function __construct(
        SourceMetaDataFactory $sourceMetaDataFactory,
        PhpFileParser $parser,
        PhpFileLoader $loader,
        ReflectionClassGenerator $reflectionGenerator
    ) {
        $this->sourceMetaDataFactory = $sourceMetaDataFactory;
        $this->parser                = $parser;
        $this->loader                = $loader;
        $this->reflectionGenerator   = $reflectionGenerator;
    }

    /**
     * @param string $filePath
     *
     * @return bool|SourceMetaData
     */
    public function generate($filePath)
    {
        try {
            $result = $this->parser->parse($filePath);
        } catch (\Exception $e) {
            return false;
        }

        if ($result->getFullyQualifiedClassName() === null) {
            return false;
        }

        $this->loader->load($filePath);

        $metadata = $this->getMetaDataInstance();

        $reflection = $this->reflectionGenerator->generate($result->getFullyQualifiedClassName());

        $metadata->setFilePath($filePath);
        $metadata->setClassName($result->getClassName());
        $metadata->setFullyQualifiedClassName($result->getFullyQualifiedClassName());
        $metadata->setReflection($reflection);

        return $metadata;
    }

    /**
     * @return SourceMetaData
     */
    public function getMetaDataInstance()
    {
        return $this->sourceMetaDataFactory->create();
    }
}

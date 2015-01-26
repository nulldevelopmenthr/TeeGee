<?php

namespace NullDev\TeeGee\ClassDomain;

class ClassMetaDataGenerator
{
    protected $factory;
    protected $parser;
    protected $fileLoader;
    protected $reflectionClassGenerator;

    public function __construct($factory, $parser, $fileLoader, $reflectionClassGenerator)
    {
        $this->factory                  = $factory;
        $this->parser                   = $parser;
        $this->fileLoader               = $fileLoader;
        $this->reflectionClassGenerator = $reflectionClassGenerator;
    }

    public function generate($filename)
    {
        try {
            $result = $this->parser->parse($filename);
        } catch (\Exception $e) {
            return false;
        }

        if ($result->getFullyQualifiedClassName() === null) {
            return false;
        }

        $this->fileLoader->load($filename);

        $reflection = $this->reflectionClassGenerator->generate($result->getFullyQualifiedClassName());

        $metadata = $this->factory->create();

        $metadata->setFilePath($filename);
        $metadata->setClassName($result->getClassName());
        $metadata->setFullyQualifiedClassName($result->getFullyQualifiedClassName());
        $metadata->setReflectionObject($reflection);

        return $metadata;
    }
}

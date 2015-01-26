<?php

namespace NullDev\TeeGee\TestDomain;

class TestMetaDataGenerator
{
    protected $factory;
    protected $converterFactory;

    public function __construct($factory, $converterFactory)
    {
        $this->factory          = $factory;
        $this->converterFactory = $converterFactory;
    }

    public function generateUnit($settings, $classMetaData)
    {
        $converter    = $this->converterFactory->create($classMetaData, $settings);
        $testMetaData = $this->factory->create();

        $testMetaData->setClassName($classMetaData->getClassName());
        $testMetaData->setFullyQualifiedClassName($classMetaData->getFullyQualifiedClassName());
        $testMetaData->setTestClassName($converter->getTestClassName());
        $testMetaData->setTestFullyQualifiedClassName($converter->getUnitTestFqdn());
        $testMetaData->setFilePath($converter->getUnitTestFilePath());
        $testMetaData->setReflectionObject($classMetaData->getReflectionObject());

        return $testMetaData;
    }

    public function generateIntegration($settings, $classMetaData)
    {
        $converter    = $this->converterFactory->create($classMetaData, $settings);
        $testMetaData = $this->factory->create();

        $testMetaData->setClassName($classMetaData->getClassName());
        $testMetaData->setFullyQualifiedClassName($classMetaData->getFullyQualifiedClassName());
        $testMetaData->setTestClassName($converter->getTestClassName());
        $testMetaData->setTestFullyQualifiedClassName($converter->getIntegrationTestFqdn());
        $testMetaData->setFilePath($converter->getIntegrationTestFilePath());
        $testMetaData->setReflectionObject($classMetaData->getReflectionObject());

        return $testMetaData;
    }
}

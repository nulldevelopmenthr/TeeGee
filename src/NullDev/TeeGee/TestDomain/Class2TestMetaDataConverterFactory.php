<?php
namespace NullDev\TeeGee\TestDomain;

class Class2TestMetaDataConverterFactory
{
    public function create($classMetaData, $settings)
    {
        return new Class2TestMetaDataConverter($classMetaData, $settings);
    }
}

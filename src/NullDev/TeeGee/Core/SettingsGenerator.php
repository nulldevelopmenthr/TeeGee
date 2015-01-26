<?php

namespace NullDev\TeeGee\Core;

class SettingsGenerator
{
    protected $settingsFactory;

    public function __construct($settingsFactory)
    {
        $this->settingsFactory = $settingsFactory;
    }

    public function generate($path)
    {
        if (substr($path, -1) !== DIRECTORY_SEPARATOR) {
            $path .= DIRECTORY_SEPARATOR;
        }

        $settings = $this->settingsFactory->create();

        $settings->setRootPath($path);

        $testPath = $path . 'Tests' . DIRECTORY_SEPARATOR;
        $settings->setTestPath($testPath);

        $settings->setUnitTestPath($testPath . 'Unit' . DIRECTORY_SEPARATOR);
        $settings->setFunctionalTestPath($testPath . 'Functional' . DIRECTORY_SEPARATOR);
        $settings->setIntegrationalTestPath($testPath . 'Integration' . DIRECTORY_SEPARATOR);

        return $settings;
    }
}

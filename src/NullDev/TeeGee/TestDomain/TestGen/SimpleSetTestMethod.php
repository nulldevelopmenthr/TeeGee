<?php
namespace NullDev\TeeGee\TestDomain\TestGen;

class SimpleSetTestMethod
{
    protected $testMetaData;

    public function __construct($testMetaData)
    {
        $this->testMetaData = testMetaData;
    }

    public function render($method)
    {
        $template = new \Text_Template($this->getTemplatePath());

        $template->setVar(
            [
                'methodName' => ucfirst($method->name)
            ]
        );

        return $template->render();
    }

    protected function getTemplatePath()
    {
        return __DIR__ . '/../TestTemplate/SimpleSetTestMethod.tpl';
    }
}

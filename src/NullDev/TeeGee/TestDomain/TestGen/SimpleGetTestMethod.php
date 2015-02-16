<?php
namespace NullDev\TeeGee\TestDomain\TestGen;

class SimpleGetTestMethod
{
    protected $testMetaData;

    public function __construct($testMetaData)
    {
        $this->testMetaData = $testMetaData;
    }

    public function render($method)
    {
        $template = new \Text_Template($this->getTemplatePath());

        $template->setVar(
            [
                'methodName' => ucfirst($method->name),
                'method'     => $method->name,
                'value'      => var_export(
                    $this->testMetaData->getReflectionObject()->getProperty(lcfirst(substr($method->name, 3))),
                    true
                )

            ]
        );

        return $template->render();
    }

    protected function getTemplatePath()
    {
        return __DIR__ . '/../TestTemplate/SimpleGetTestMethod.tpl';
    }
}

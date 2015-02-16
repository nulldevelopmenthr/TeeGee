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


        $propertyName = lcfirst(substr($method->name, 3));
        $value = $this->testMetaData->getReflectionObject()->getDefaultProperties()[$propertyName];

        $template->setVar(
            [
                'methodName' => ucfirst($method->name),
                'method'     => $method->name,
                'value'      => var_export(
                    $value,
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

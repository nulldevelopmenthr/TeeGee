<?php
namespace NullDev\TeeGee\TestDomain\TestGen;

class SimpleSetTestMethod
{
    protected $testMetaData;

    public function __construct($testMetaData)
    {
        $this->testMetaData = $testMetaData;
    }

    public function render($method)
    {
        $template = new \Text_Template($this->getTemplatePath());

        $param = array_pop($method->getParameters());

        if ($param->getClass()) {
            $value = "m::mock('" . $param->getClass()->getName() . "')";
        } else {
            $value = '"' . $method->name . '"';
        }

        $template->setVar(
            [
                'methodName' => ucfirst($method->name),
                'method'     => $method->name,
                'value'      => $value,
                'property'   => lcfirst(substr($method->name, 3)),
                'getMethod'  => 'get' . substr($method->name, 3),
            ]
        );

        return $template->render();
    }

    protected function getTemplatePath()
    {
        return __DIR__ . '/../TestTemplate/SimpleSetTestMethod.tpl';
    }
}

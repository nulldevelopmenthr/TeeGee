<?php
namespace NullDev\TeeGee\TestDomain\TestGen;

class MockSetTestMethod
{
    protected $testMetaData;

    public function __construct($testMetaData)
    {
        $this->testMetaData = $testMetaData;
    }

    public function render($method)
    {
        $template = new \Text_Template($this->getTemplatePath());
        $param    = array_pop($method->getParameters());

        if ($param->getClass()) {
            $value = "m::mock('" . $param->getClass()->getName() . "')";
        } else {
            $value = '"' . $method->name . '"';
        }

        $template->setVar(
            [
                'methodName'           => ucfirst($method->name),
                'methodArguments'      => $this->getMethodArgumentsString($method),
                'method'               => $method->name,
                'value'                => $value,
                'property'             => lcfirst(substr($method->name, 3)),
                'getMethod'            => 'get' . substr($method->name, 3),
                'constructorArguments' => $this->getConstructorArgumentsString(),
                'constructor'          => $this->getConstructorString()
            ]
        );

        return $template->render();
    }

    public function getMethodArgumentsString($method)
    {
        $params = [];

        foreach ($method->getParameters() as $methodParam) {
            $params[] = '$mock' . ucfirst($methodParam->name) . ' = m::mock();';
        }

        if (count($params)) {
            $methodArguments = implode(PHP_EOL . '        ', $params);

            return $methodArguments;
        }

        return '//';
    }

    public function getMethodString($method)
    {
        $argumentString = '';

        $arguments = [];

        foreach ($method->getParameters() as $methodParam) {
            $arguments[] = '$mock' . ucfirst($methodParam->name);
        }

        if (count($arguments)) {
            $argumentString = implode(', ', $arguments);
        }

        return $method->name . '(' . $argumentString . ')';
    }

    public function getConstructorArgumentsString()
    {
        $constructor = $this->testMetaData->getConstructorReflection();

        if (null !== $constructor) {
            $params = [];

            foreach ($constructor->getParameters() as $methodParam) {
                if ($methodParam->getClass()) {
                    $mockClass = $methodParam->getClass();
                    $params[]  = '$mock' . ucfirst($methodParam->name) . " = m::mock('" . $mockClass->getName() . "');";
                } else {
                    $params[] = '$mock' . ucfirst($methodParam->name) . " = m::mock();";
                }
            }

            if (count($params)) {
                $constructorArguments = implode(PHP_EOL . '        ', $params);

                return $constructorArguments;
            }
        }

        return '';
    }

    public function getConstructorString()
    {
        $constructor    = $this->testMetaData->getConstructorReflection();
        $argumentString = '';

        if (null !== $constructor) {
            $arguments = [];

            foreach ($constructor->getParameters() as $methodParam) {
                $arguments[] = '$mock' . ucfirst($methodParam->name);
            }

            if (count($arguments)) {
                $argumentString = implode(', ', $arguments);
            }
        }

        return $this->testMetaData->getClassName() . '(' . $argumentString . ')';
    }

    protected function getTemplatePath()
    {
        return __DIR__ . '/../TestTemplate/MockSetTestMethod.tpl';
    }
}

<?php
namespace NullDev\TeeGee\TestDomain\TestGen;

use NullDev\TeeGee\TestMethodGenerator\MockeryGetTestMethod;
use NullDev\TeeGee\TestMethodGenerator\MockerySetTestMethod;
use NullDev\TeeGee\TestMethodGenerator\MockeryTestMethod;
use NullDev\TeeGee\TestMethodGenerator\NothingTestMethod;

class AdvUnitTestGen extends AbstractTestGen
{
    protected function getTemplatePath()
    {
        return __DIR__.'/../TestTemplate/AdvUnitTestClass.tpl';
    }

    public function getVars()
    {
        return [
            'namespace'            => $this->getNamespaceString(),
            'dependencies'         => $this->getDependenciesString(),
            'testClassName'        => $this->testMetaData->getTestClassName(),
            'className'            => $this->testMetaData->getClassName(),
            'constructorArguments' => $this->getConstructorArgumentsString(),
            'constructor'          => $this->getConstructorString(),
            'methods'              => $this->getMethods(),
        ];
    }

    public function getDependencies()
    {
        return [
            $this->testMetaData->getFullyQualifiedClassName(),
            'Mockery as m',
        ];
    }

    /**
     * Returns dependencies string (tested class and Mockery).
     *
     * @return string
     */
    public function getDependenciesString()
    {
        $dependencies = [];

        foreach ($this->getDependencies() as $dependency) {
            $dependencies[] = 'use '.$dependency.';';
        }

        return implode(PHP_EOL, $dependencies);
    }

    public function getConstructorArgumentsString()
    {
        $constructor = $this->getConstructorMethod();
        if (null !== $constructor) {
            $params = [];

            foreach ($constructor->getParameters() as $methodParam) {
                if ($methodParam->getClass()) {
                    $mockClass = $methodParam->getClass();
                    $params[]  = '$mock'.ucfirst($methodParam->getName())." = m::mock('".$mockClass->getName()."');";
                } else {
                    $params[] = '$mock'.ucfirst($methodParam->getName())." = m::mock();";
                }
            }

            if (count($params)) {
                $constructorArguments = implode(PHP_EOL.'        ', $params);

                return $constructorArguments;
            }
        }

        return '';
    }

    public function getConstructorString()
    {
        $constructor    = $this->getConstructorMethod();
        $argumentString = '';

        if (null !== $constructor) {
            $arguments = [];

            foreach ($constructor->getParameters() as $methodParam) {
                $arguments[] = '$mock'.ucfirst($methodParam->getName());
            }

            if (count($arguments)) {
                $argumentString = implode(', ', $arguments);
            }
        }

        return $this->testMetaData->getClassName().'('.$argumentString.')';
    }

    /**
     * @return string
     *
     * @SuppressWarnings(PHPMD.CyclomaticComplexity)
     * @SuppressWarnings(PHPMD.NPathComplexity)
     */
    public function getMethods()
    {
        $methods = [];

        $methodTemplate    = new MockeryTestMethod($this->testMetaData);
        $getMethodTemplate = new MockeryGetTestMethod($this->testMetaData);
        $setMethodTemplate = new MockerySetTestMethod($this->testMetaData);

        foreach ($this->testMetaData->getReflectionObject()->getMethods() as $method) {
            if (!$method->isConstructor()
                && $method->isPublic()
                && $method->class === $this->testMetaData->getFullyQualifiedClassName()
            ) {
                if (substr($method->getName(), 0, 3) === 'get'
                    && $this->testMetaData->hasProperty(lcfirst(substr($method->getName(), 3)))
                    && $this->testMetaData->hasMethod('set'.substr($method->getName(), 3))
                ) {
                    $methods[] = $getMethodTemplate->render($method);
                } elseif (substr($method->getName(), 0, 3) === 'set'
                    && $this->testMetaData->hasMethod('get'.substr($method->getName(), 3))
                    && $method->getNumberOfParameters() === 1
                ) {
                    $methods[] = $setMethodTemplate->render($method);
                } else {
                    $methods[] = $methodTemplate->render($method);
                }
            }
        }

        if (count($methods) === 0) {
            $nothingMethodTemplate = new NothingTestMethod($this->testMetaData);
            $methods[]             = $nothingMethodTemplate->render();
        }

        $content = '';

        if (count($methods)) {
            $content .= implode(PHP_EOL, $methods);
            $content .= PHP_EOL;
        }

        return $content;
    }
}

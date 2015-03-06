<?php
namespace NullDev\TeeGee\TestFileGenerator;

use NullDev\TeeGee\TestFileGenerator\AbstractTestGenerator;
use NullDev\TeeGee\TestMethodGenerator\EmptyTestMethod;
use NullDev\TeeGee\TestMethodGenerator\MockerySetTestMethod;

class BasicUnitTestGenerator extends AbstractTestGenerator
{
    protected function getTemplatePath()
    {
        return __DIR__.'/BasicUnitTest.tpl';
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

            //@TODO: move as dependecy
            $zTodo = new MockerySetTestMethod($this->testMetaData);

            return $zTodo->getMethodDependencyString($constructor);
        }

        return '';
    }

    public function getConstructorString()
    {
        $constructor    = $this->getConstructorMethod();
        $argumentString = '';

        if (null !== $constructor) {

            //@TODO: move as dependecy
            $zTodo = new MockerySetTestMethod($this->testMetaData);

            $argumentString = $zTodo->getMethodDependencyString($constructor);
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

        $methodTemplate    = new EmptyTestMethod($this->testMetaData);
        $getMethodTemplate = new SimpleGetTestMethod($this->testMetaData);
        $setMethodTemplate = new SimpleSetTestMethod($this->testMetaData);

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
            $nothingMethodTemplate = new NothingTestMethod();
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

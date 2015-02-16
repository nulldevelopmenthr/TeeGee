<?php
namespace NullDev\TeeGee\TestDomain\TestGen;

class AdvUnitTestGen extends AbstractTestGen
{

    protected function getTemplatePath()
    {
        return __DIR__ . '/../TestTemplate/AdvUnitTestClass.tpl';
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
            $dependencies[] = 'use ' . $dependency . ';';
        }

        return implode(PHP_EOL, $dependencies);
    }

    public function getConstructorArgumentsString()
    {
        $constructor = $this->getConstructorMethod();
        if (null !== $constructor) {
            $params = [];

            foreach ($constructor->getParameters() as $methodParam) {
                $params[] = '$mock' . ucfirst($methodParam->name) . ' = m::mock();';
            }

            if (count($params)) {
                $constructorArguments  = implode(PHP_EOL . '        ', $params);
                $constructorArguments .= PHP_EOL . PHP_EOL;

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
                $arguments[] = '$mock' . ucfirst($methodParam->name);
            }

            if (count($arguments)) {
                $argumentString = implode(', ', $arguments);
            }
        }

        return $this->testMetaData->getClassName() . '(' . $argumentString . ')';
    }

    public function getMethods()
    {
        $methods = [];

        $methodTemplate = new MockTestMethod($this->testMetaData);

        foreach ($this->testMetaData->getReflectionObject()->getMethods() as $method) {
            if (!$method->isConstructor() && $method->isPublic() && $method->class === $this->testMetaData->getFullyQualifiedClassName()) {
                $methods[] = $methodTemplate->render($method);
            }
        }

        $content = '';

        if (count($methods)) {
            $content .= implode(PHP_EOL, $methods);
            $content .= PHP_EOL;
        }

        return $content;
    }
}

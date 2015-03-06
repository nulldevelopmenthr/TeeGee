<?php
namespace NullDev\TeeGee\TestMethodGenerator;

class MockeryTestMethod extends AbstractTestMethod
{
    /**
     * @var
     */
    protected $templateName = 'MockeryTestMethod';

    /**
     * @param $method
     *
     * @return mixed
     */
    public function getData(\ReflectionMethod $method)
    {
        $data = [
            'methodName'               => ucfirst($method->getName()),
            'testedMethodName'         => $method->getName(),
            'testedMethodArguments'    => $this->getMethodArgumentsString($method),
            'testedMethodDependencies' => $this->getMethodDependencyString($method),
            'testedClassName'          => $this->getClassName(),
            'testedClassArguments'     => $this->getClassArgumentsString(),
            'testedClassDependencies'  => $this->getClassDependencyString(),
        ];

        return $data;
    }

    public function getMethodArguments($method)
    {
        $arguments = [];

        foreach ($method->getParameters() as $methodParam) {
            $arguments[] = '$mock'.ucfirst($methodParam->getName());
        }

        return $arguments;
    }

    public function getMethodArgumentsString($method)
    {
        $arguments = $this->getMethodArguments($method);

        if (count($arguments)) {
            return implode(', ', $arguments);
        } else {
            return '';
        }
    }

    public function getMethodDependencies($method)
    {
        $params = [];

        foreach ($method->getParameters() as $methodParam) {
            if ($methodParam->getClass()) {
                $paramClassName = '\''.$methodParam->getClass()->getName().'\'';
            } else {
                $paramClassName = '';
            }

            $params[] = '$mock'.ucfirst($methodParam->getName()).' = m::mock('.$paramClassName.');';
        }

        return $params;
    }

    public function getMethodDependencyString($method)
    {
        $params = $this->getMethodDependencies($method);

        if (count($params)) {
            $methodArguments = implode(PHP_EOL.'        ', $params);

            return $methodArguments;
        }

        return '//';
    }

    public function getClassName()
    {
        return $this->testClassMetaData->getClassName();
    }

    public function getClassArgumentsString()
    {
        $constructor    = $this->testClassMetaData->getConstructorReflection();
        $argumentString = '';

        if (null !== $constructor) {
            $arguments = $this->getMethodArguments($constructor);

            if (count($arguments)) {
                $argumentString = implode(', ', $arguments);
            }
        }

        return $argumentString;
    }

    public function getClassDependencyString()
    {
        $constructor = $this->testClassMetaData->getConstructorReflection();

        if (null !== $constructor) {
            return $this->getMethodDependencyString($constructor);
        }

        return '//';
    }
}

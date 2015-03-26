<?php
namespace NullDev\TeeGee\TestMethodGenerator;

class SimpleSetTestMethod extends AbstractTestMethod
{
    /**
     * @var
     */
    protected $templateName = 'SimpleSetTestMethod';

    /**
     * @param $method
     *
     * @return mixed
     */
    public function getData(\ReflectionMethod $method)
    {
        $data = [
            'methodName'       => ucfirst($method->getName()),
            'testedMethodName' => $method->getName(),
            'testedValue'      => $this->getTestedValue($method),
            'propertyName'     => $this->extractPropertyName($method),
            'getMethod'        => $this->getGetMethod($method),
        ];

        return $data;
    }

    /**
     * @param \ReflectionMethod $method
     *
     * @return string
     */
    public function getTestedValue(\ReflectionMethod $method)
    {
        $params = $method->getParameters();
        $param  = array_pop($params);

        if ($param->getClass()) {
            return "m::mock('".$param->getClass()->getName()."')";
        } else {
            return var_export($this->extractPropertyName($method), true);
        }
    }

    /**
     * @param \ReflectionMethod $method
     *
     * @return string
     */
    public function getGetMethod(\ReflectionMethod $method)
    {
        return 'get'.substr($method->getName(), 3);
    }

    /**
     * @param \ReflectionMethod $method
     *
     * @return string
     */
    public function extractPropertyName(\ReflectionMethod $method)
    {
        $propertyName = substr($method->getName(), 3);

        return lcfirst($propertyName);
    }
}

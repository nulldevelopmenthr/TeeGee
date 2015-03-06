<?php
namespace NullDev\TeeGee\TestMethodGenerator;

class SimpleGetTestMethod extends AbstractTestMethod
{
    /**
     * @var
     */
    protected $templateName = 'SimpleGetTestMethod';

    /**
     * @param $method
     *
     * @return mixed
     */
    public function getData(\ReflectionMethod $method)
    {
        $value = $this->getDefaultValue($method);

        $data = [
            'methodName'       => ucfirst($method->getName()),
            'testedMethodName' => $method->getName(),
            'testedValue'      => var_export($value, true),
        ];

        return $data;
    }

    /**
     * @param \ReflectionMethod $method
     *
     * @return string
     */
    public function getDefaultValue(\ReflectionMethod $method)
    {
        $propertyName = $this->extractPropertyName($method);

        $defaultProperties = $this->testClassMetaData->getReflectionObject()->getDefaultProperties();

        return $defaultProperties[$propertyName];
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

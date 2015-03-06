<?php
namespace NullDev\TeeGee\TestMethodGenerator;

/**
 * Class EmptyTestMethod.
 */
class EmptyTestMethod extends AbstractTestMethod
{
    /**
     * @var
     */
    protected $templateName = 'EmptyTestMethod';

    /**
     * @param $method
     *
     * @return mixed
     */
    public function getData(\ReflectionMethod $method)
    {
        $data = [
            'methodName' => ucfirst($method->getName()),
        ];

        return $data;
    }
}

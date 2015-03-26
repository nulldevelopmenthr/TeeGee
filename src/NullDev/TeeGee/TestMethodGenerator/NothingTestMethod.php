<?php
namespace NullDev\TeeGee\TestMethodGenerator;

/**
 * Class NothingTestMethod.
 */
class NothingTestMethod extends AbstractTestMethod
{
    /**
     * @var
     */
    protected $templateName = 'EmptyTestMethod';

    /**
     * @param \ReflectionMethod $method
     *
     * @return mixed
     */
    public function getData(\ReflectionMethod $method = null)
    {
        $data = [
            'methodName' => 'Nothing',
        ];

        return $data;
    }

    /**
     * @param \ReflectionMethod $method
     *
     * @return string
     */
    public function render(\ReflectionMethod $method = null)
    {
        $data = $this->getData($method);

        $this->templateEngine->setVar($data);

        return $this->templateEngine->render();
    }
}

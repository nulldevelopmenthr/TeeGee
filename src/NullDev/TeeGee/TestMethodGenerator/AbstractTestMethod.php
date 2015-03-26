<?php
namespace NullDev\TeeGee\TestMethodGenerator;

/**
 * Class AbstractTestMethod.
 */
abstract class AbstractTestMethod
{
    protected $testClassMetaData;

    /**
     * @var
     */
    protected $templateEngine;

    /**
     * @var
     */
    protected $templateName;

    /**
     *
     */
    public function __construct($testClassMetaData)
    {
        $this->testClassMetaData = $testClassMetaData;
        $this->templateEngine    = new \Text_Template($this->getTemplatePath());
    }

    /**
     * @param \ReflectionMethod $method
     *
     * @return string
     */
    public function render(\ReflectionMethod $method)
    {
        $data = $this->getData($method);

        $this->templateEngine->setVar($data);

        return $this->templateEngine->render();
    }

    /**
     * @param \ReflectionMethod $method
     *
     * @return array
     */
    abstract public function getData(\ReflectionMethod $method);

    /**
     * @return string
     */
    public function getTemplatePath()
    {
        return __DIR__.'/Template/'.$this->templateName.'.tpl';
    }
}

<?php
namespace NullDev\TeeGee\TestFileGenerator;

abstract class AbstractTestGenerator
{
    protected $testMetaData;

    public function __construct($testMetaData)
    {
        $this->testMetaData = $testMetaData;
    }

    public function render()
    {
        $template = new \Text_Template($this->getTemplatePath());

        $template->setVar($this->getVars());

        return $template->render();
    }

    abstract protected function getTemplatePath();

    abstract public function getVars();

    /**
     * Extracts namespace by removing leading '/' and class name from fully qualified class name.
     *
     * @return string
     */
    public function getNamespace()
    {
        $className = $this->testMetaData->getTestClassName();
        $fqdn      = $this->testMetaData->getTestFullyQualifiedClassName();

        $namespace = str_replace('\\'.$className, '', $fqdn);

        return $namespace;
    }

    /**
     * @return string
     */
    public function getNamespaceString()
    {
        return 'namespace '.$this->getNamespace().';';
    }

    /**
     * Returns dependencies string.
     *
     * @return string
     */
    abstract public function getDependenciesString();

    public function getConstructorMethod()
    {
        return $this->testMetaData->getConstructorReflection();
    }
}

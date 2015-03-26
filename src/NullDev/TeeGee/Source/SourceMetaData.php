<?php
namespace NullDev\TeeGee\Source;

class SourceMetaData
{
    /**
     * @var string Path to the source file.
     */
    protected $filePath;

    /**
     * @var string Source class name without namespace.
     */
    protected $className;

    /**
     * @var string Source class name with namespace.
     */
    protected $fullyQualifiedClassName;

    /**
     * @var \ReflectionClass Reflection of the source class.
     */
    protected $reflection;

    /**
     * @return mixed
     */
    public function getFilePath()
    {
        return $this->filePath;
    }

    /**
     * @param mixed $sourceFilePath
     *
     * @return $this
     */
    public function setFilePath($sourceFilePath)
    {
        $this->filePath = $sourceFilePath;

        return $this;
    }

    /**
     * @return Source
     */
    public function getClassName()
    {
        return $this->className;
    }

    /**
     * @param Source $sourceClassName
     *
     * @return $this
     */
    public function setClassName($sourceClassName)
    {
        $this->className = $sourceClassName;

        return $this;
    }

    /**
     * @return Source
     */
    public function getFullyQualifiedClassName()
    {
        return $this->fullyQualifiedClassName;
    }

    /**
     * @param Source $sourceFullyQualifiedClassName
     *
     * @return $this
     */
    public function setFullyQualifiedClassName($sourceFullyQualifiedClassName)
    {
        $this->fullyQualifiedClassName = $sourceFullyQualifiedClassName;

        return $this;
    }

    /**
     * @return \ReflectionClass
     */
    public function getReflection()
    {
        return $this->sourceReflection;
    }

    /**
     * @param \ReflectionClass $sourceReflection
     *
     * @return $this
     */
    public function setReflection(\ReflectionClass $sourceReflection)
    {
        $this->sourceReflection = $sourceReflection;

        return $this;
    }
}

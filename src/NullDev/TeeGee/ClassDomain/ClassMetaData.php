<?php

namespace NullDev\TeeGee\ClassDomain;

class ClassMetaData
{
    protected $filePath;
    protected $className;
    protected $fullyQualifiedClassName;
    protected $reflectionObject;

    /**
     * @return mixed
     */
    public function getFilePath()
    {
        return $this->filePath;
    }

    /**
     * @param mixed $filePath
     */
    public function setFilePath($filePath)
    {
        $this->filePath = $filePath;
    }

    /**
     * @return mixed
     */
    public function getClassName()
    {
        return $this->className;
    }

    /**
     * @param mixed $className
     */
    public function setClassName($className)
    {
        $this->className = $className;
    }

    /**
     * @return mixed
     */
    public function getFullyQualifiedClassName()
    {
        return $this->fullyQualifiedClassName;
    }

    /**
     * @param mixed $fullyQualifiedClassName
     */
    public function setFullyQualifiedClassName($fullyQualifiedClassName)
    {
        $this->fullyQualifiedClassName = $fullyQualifiedClassName;
    }

    /**
     * @return mixed
     */
    public function getReflectionObject()
    {
        return $this->reflectionObject;
    }

    /**
     * @param mixed $reflectionObject
     */
    public function setReflectionObject($reflectionObject)
    {
        $this->reflectionObject = $reflectionObject;
    }
}

<?php

namespace NullDev\TeeGee\TestDomain;

class TestMetaData
{
    protected $filePath;
    protected $className;
    protected $fullyQualifiedClassName;
    protected $testClassName;
    protected $testFullyQualifiedClassName;
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
    public function getTestClassName()
    {
        return $this->testClassName;
    }

    /**
     * @param mixed $testClassName
     */
    public function setTestClassName($testClassName)
    {
        $this->testClassName = $testClassName;
    }

    /**
     * @return mixed
     */
    public function getTestFullyQualifiedClassName()
    {
        return $this->testFullyQualifiedClassName;
    }

    /**
     * @param mixed $testFullyQualifiedClassName
     */
    public function setTestFullyQualifiedClassName($testFullyQualifiedClassName)
    {
        $this->testFullyQualifiedClassName = $testFullyQualifiedClassName;
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

    public function getConstructorReflection()
    {
        foreach ($this->getReflectionObject()->getMethods() as $method) {
            if ($method->isConstructor()) {
                return $method;
            }
        }

        return null;
    }

    public function hasConstructorParams()
    {
        $constructor = $this->getConstructorReflection();

        if (null === $constructor) {
            return false;
        }
        if (count($constructor->getParameters()) > 0) {
            return true;
        } else {
            return false;
        }

    }

    public function hasProperty($propertyName)
    {
        foreach ($this->getReflectionObject()->getProperties() as $property) {
            if ($property->getName() === $propertyName) {
                return true;
            }
        }

        return false;
    }

    public function hasMethod($methodName)
    {
        foreach ($this->getReflectionObject()->getMethods() as $method) {
            if ($method->getName() === $methodName) {
                return true;
            }
        }

        return false;
    }

}

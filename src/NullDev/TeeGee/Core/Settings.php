<?php

namespace NullDev\TeeGee\Core;

class Settings
{

    protected $rootPath;
    protected $testPath;
    protected $unitTestPath;
    protected $functionalTestPath;
    protected $integrationalTestPath;

    /**
     * @return mixed
     */
    public function getRootPath()
    {
        return $this->rootPath;
    }

    /**
     * @param mixed $rootPath
     */
    public function setRootPath($rootPath)
    {
        $this->rootPath = $rootPath;
    }

    /**
     * @return mixed
     */
    public function getTestPath()
    {
        return $this->testPath;
    }

    /**
     * @param mixed $testPath
     */
    public function setTestPath($testPath)
    {
        $this->testPath = $testPath;
    }

    /**
     * @return mixed
     */
    public function getUnitTestPath()
    {
        return $this->unitTestPath;
    }

    /**
     * @param mixed $unitTestPath
     */
    public function setUnitTestPath($unitTestPath)
    {
        $this->unitTestPath = $unitTestPath;
    }

    /**
     * @return mixed
     */
    public function getFunctionalTestPath()
    {
        return $this->functionalTestPath;
    }

    /**
     * @param mixed $functionalTestPath
     */
    public function setFunctionalTestPath($functionalTestPath)
    {
        $this->functionalTestPath = $functionalTestPath;
    }

    /**
     * @return mixed
     */
    public function getIntegrationalTestPath()
    {
        return $this->integrationalTestPath;
    }

    /**
     * @param mixed $integrationalTestPath
     */
    public function setIntegrationalTestPath($integrationalTestPath)
    {
        $this->integrationalTestPath = $integrationalTestPath;
    }
}

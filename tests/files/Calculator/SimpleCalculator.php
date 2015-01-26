<?php
namespace Calculator;

class SimpleCalculator
{
    protected $arg1;
    protected $arg2;
    protected $arg3;

    public function __construct($arg1, $arg2, $arg3)
    {
        $this->arg1 = $arg1;
        $this->arg2 = $arg2;
        $this->arg3 = $arg3;
    }

    /**
     * @return mixed
     */
    public function getArg1()
    {
        return $this->arg1;
    }

    /**
     * @return mixed
     */
    public function getArg2()
    {
        return $this->arg2;
    }

    /**
     * @return mixed
     */
    public function getArg3()
    {
        return $this->arg3;
    }
}

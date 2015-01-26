<?php
namespace Calculator;

interface CalculatorInterface
{
}

class BasicCalculator implements CalculatorInterface
{
    protected $varA;

    public function __construct()
    {
    }

    /**
     * @return mixed
     */
    public function getVarA()
    {
        return $this->varA;
    }

    /**
     * @param mixed $varA
     */
    public function setVarA($varA)
    {
        $this->varA = $varA;
    }
}

<?php
namespace Calculator;

final class FinalCalculator
{
    protected $varA;
    protected $varB;
    protected $varC;

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

    /**
     * @return mixed
     */
    public function getVarB()
    {
        return $this->varB;
    }

    /**
     * @param mixed $varB
     */
    public function setVarB($varB)
    {
        $this->varB = $varB;
    }

    /**
     * @return mixed
     */
    public function getVarC()
    {
        return $this->varC;
    }

    /**
     * @param mixed $varC
     */
    public function setVarC($varC)
    {
        $this->varC = $varC;
    }
}

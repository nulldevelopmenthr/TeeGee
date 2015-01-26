<?php
namespace Calculator;

require "AbstractCalculator.php";

class AdvancedCalculator extends AbstractCalculator
{
    protected $engine;

    public function __construct($engine)
    {
        $this->engine = $engine;
    }

    public function doSomething()
    {
        return 1 + 2;
    }

    protected function doSomethingProtected()
    {
        return $this->doSomethingPrivate();
    }

    private function doSomethingPrivate()
    {
        return 3 - 2;
    }
}

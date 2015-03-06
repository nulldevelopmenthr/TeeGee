<?php
{namespace}

{dependencies}

/**
 *
 */
class {testClassName} extends \PHPUnit_Framework_TestCase
{
    /**
     * @var {className}
     */
    protected $object;

    /**
     */
    protected function setUp()
    {
        {constructorArguments}
        $this->object = new {testedClassName}({testedClassArguments});
    }
{methods}}

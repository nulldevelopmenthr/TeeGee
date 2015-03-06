    /**
     *
     */
    public function test{methodName}()
    {
        {testedClassDependencies}

        $obj = new {testedClassName}({testedClassArguments});

        {testedMethodDependencies}
        $result = $obj->{testedMethodName}({testedMethodArguments});

        $this->assertEquals({testedValue}, $result);
    }
    /**
     *
     */
    public function test{methodName}()
    {
        {testedClassDependencies}

        $obj = new {testedClassName}({testedClassArguments});

        ${propertyName} = {testedValue};
        $obj->{testedMethodName}(${propertyName});
        $this->assertEquals(${propertyName}, $obj->{getMethod}();
    }
    /**
     *
     */
    public function test{methodName}()
    {
        $this->markTestIncomplete('TODO');

        {testedClassDependencies}

        $obj = new {testedClassName}({testedClassArguments});

        //
        {testedMethodDependencies}
        $result = $obj->{testedMethodName}({testedMethodArguments});

        $this->assertNotNull($result);
    }
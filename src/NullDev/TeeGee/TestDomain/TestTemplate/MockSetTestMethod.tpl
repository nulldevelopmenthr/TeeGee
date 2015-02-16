

    /**
     *
     */
    public function test{methodName}()
    {
        //
        {constructorArguments}
        $obj = new {constructor};

        ${property} = {value};
        $obj->{method}(${property});
        $this->assertEquals(${property}, $obj->{getMethod}());
    }
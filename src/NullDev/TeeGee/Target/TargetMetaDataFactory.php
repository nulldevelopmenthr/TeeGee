<?php

namespace NullDev\TeeGee\Target;

use NullDev\TeeGee\Target\TargetMetaData;

class TargetMetaDataFactory
{
    /**
     * @return TargetMetaData
     */
    public function create()
    {
        return new TargetMetaData();
    }
}

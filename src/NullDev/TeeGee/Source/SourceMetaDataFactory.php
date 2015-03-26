<?php
namespace NullDev\TeeGee\Source;

use NullDev\TeeGee\Source\SourceMetaData;

class SourceMetaDataFactory
{
    /**
     * @return SourceMetaData
     */
    public function create()
    {
        return new SourceMetaData();
    }
}

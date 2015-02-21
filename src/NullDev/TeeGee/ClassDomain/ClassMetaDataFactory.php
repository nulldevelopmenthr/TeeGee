<?php
namespace NullDev\TeeGee\ClassDomain;

class ClassMetaDataFactory
{
    /**
     * Returns a new instance of ClassMetaData.
     *
     * @return ClassMetaData
     */
    public function create()
    {
        return new ClassMetaData();
    }
}

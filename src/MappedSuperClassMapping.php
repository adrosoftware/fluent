<?php

namespace AdroSoftware\Fluent;

use AdroSoftware\Fluent\Mappers\MappedSuperClassMapper;
use AdroSoftware\Fluent\Mappers\MapperSet;

abstract class MappedSuperClassMapping implements Mapping
{
    /**
     * {@inheritdoc}
     */
    public function addMapperTo(MapperSet $mappers)
    {
        $mappers->addMapper($this->mapFor(), new MappedSuperClassMapper($this));
    }
}

<?php

namespace AdroSoftware\Fluent;

use AdroSoftware\Fluent\Mappers\EntityMapper;
use AdroSoftware\Fluent\Mappers\MapperSet;

abstract class EntityMapping implements Mapping
{
    /**
     * {@inheritdoc}
     */
    public function addMapperTo(MapperSet $mappers)
    {
        $mappers->addMapper($this->mapFor(), new EntityMapper($this));
    }
}

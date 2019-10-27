<?php

namespace AdroSoftware\Fluent;

use AdroSoftware\Fluent\Mappers\EmbeddableMapper;
use AdroSoftware\Fluent\Mappers\MapperSet;

abstract class EmbeddableMapping implements Mapping
{
    /**
     * {@inheritdoc}
     */
    public function addMapperTo(MapperSet $mappers)
    {
        $mappers->addMapper($this->mapFor(), new EmbeddableMapper($this));
    }
}

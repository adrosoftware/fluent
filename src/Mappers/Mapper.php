<?php

namespace AdroSoftware\Fluent\Mappers;

use AdroSoftware\Fluent\Fluent;

interface Mapper
{
    /**
     * @param Fluent $builder
     *
     * @return void
     */
    public function map(Fluent $builder);

    /**
     * Returns whether the class with the specified name should have its metadata loaded.
     * This is only the case if it is either mapped as an Entity or a MappedSuperclass.
     *
     * @return bool
     */
    public function isTransient();
}

<?php

namespace Tests\Stubs\Mappings;

use AdroSoftware\Fluent\Fluent;
use AdroSoftware\Fluent\MappedSuperClassMapping;
use Tests\Stubs\MappedSuperClasses\StubMappedSuperClass;

class StubMappedSuperClassMapping extends MappedSuperClassMapping
{
    /**
     * Load the object's metadata through the Metadata Builder object.
     *
     * @param Fluent $builder
     */
    public function map(Fluent $builder)
    {
        $builder->string('name');
    }

    /**
     * Returns the fully qualified name of the entity that this mapper maps.
     * @return string
     */
    public function mapFor()
    {
        return StubMappedSuperClass::class;
    }
}

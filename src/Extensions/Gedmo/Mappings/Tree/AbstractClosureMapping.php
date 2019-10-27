<?php

namespace AdroSoftware\Fluent\Extensions\Gedmo\Mappings\Tree;

use Gedmo\Tree\Entity\MappedSuperclass\AbstractClosure;
use AdroSoftware\Fluent\Builders\GeneratedValue;
use AdroSoftware\Fluent\Fluent;
use AdroSoftware\Fluent\MappedSuperClassMapping;

class AbstractClosureMapping extends MappedSuperClassMapping
{
    /**
     * {@inheritdoc}
     */
    public function mapFor()
    {
        return AbstractClosure::class;
    }

    /**
     * {@inheritdoc}
     */
    public function map(Fluent $builder)
    {
        $builder->integer('id')->unsigned()->primary()->generatedValue(function (GeneratedValue $builder) {
            $builder->identity();
        });
        $builder->integer('depth');
    }
}

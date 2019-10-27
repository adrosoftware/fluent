<?php

namespace AdroSoftware\Fluent\Relations;

use Doctrine\ORM\Mapping\Builder\ClassMetadataBuilder;
use Doctrine\ORM\Mapping\Builder\OneToManyAssociationBuilder;
use AdroSoftware\Fluent\Relations\Traits\Indexable;
use AdroSoftware\Fluent\Relations\Traits\Orderable;
use AdroSoftware\Fluent\Relations\Traits\Ownable;

/**
 * @method $this mappedBy($fieldName)
 */
class OneToMany extends AbstractRelation
{
    use Ownable, Orderable, Indexable;

    /**
     * @var OneToManyAssociationBuilder
     */
    protected $association;

    /**
     * @param ClassMetadataBuilder $builder
     * @param string               $relation
     * @param string               $entity
     *
     * @return OneToManyAssociationBuilder
     */
    protected function createAssociation(ClassMetadataBuilder $builder, $relation, $entity)
    {
        return $this->builder->createOneToMany($relation, $entity);
    }
}

<?php

namespace AdroSoftware\Fluent\Relations;

use Doctrine\ORM\Mapping\Builder\AssociationBuilder;
use Doctrine\ORM\Mapping\Builder\ClassMetadataBuilder;
use AdroSoftware\Fluent\Builders\Traits\Macroable;
use AdroSoftware\Fluent\Builders\Traits\QueuesMacros;
use AdroSoftware\Fluent\Relations\Traits\Ownable;
use AdroSoftware\Fluent\Relations\Traits\Owning;
use AdroSoftware\Fluent\Relations\Traits\Primary;

/**
 * @method $this inversedBy($fieldName)
 * @method $this mappedBy($fieldName)
 */
class OneToOne extends AbstractRelation
{
    use Owning, Ownable, Primary, Macroable, QueuesMacros;

    /**
     * @param ClassMetadataBuilder $builder
     * @param string               $relation
     * @param string               $entity
     *
     * @return AssociationBuilder
     */
    protected function createAssociation(ClassMetadataBuilder $builder, $relation, $entity)
    {
        return $this->builder->createOneToOne(
            $relation,
            $entity
        );
    }

    /**
     * @param string $method
     * @param array  $args
     *
     * @throws \BadMethodCallException
     *
     * @return $this
     */
    public function __call($method, $args)
    {
        if ($this->hasMacro($method)) {
            return $this->queueMacro($method, $args);
        }

        return parent::__call($method, $args);
    }
}

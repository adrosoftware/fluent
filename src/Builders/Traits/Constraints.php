<?php

namespace AdroSoftware\Fluent\Builders\Traits;

use AdroSoftware\Fluent\Buildable;
use AdroSoftware\Fluent\Builders\Index;
use AdroSoftware\Fluent\Builders\Primary;
use AdroSoftware\Fluent\Builders\UniqueConstraint;

trait Constraints
{
    /**
     * {@inheritdoc}
     */
    public function index($columns)
    {
        return $this->constraint(
            Index::class,
            is_array($columns) ? $columns : func_get_args()
        );
    }

    /**
     * {@inheritdoc}
     */
    public function primary($fields)
    {
        return $this->constraint(
            Primary::class,
            is_array($fields) ? $fields : func_get_args()
        );
    }

    /**
     * {@inheritdoc}
     */
    public function unique($columns)
    {
        return $this->constraint(
            UniqueConstraint::class,
            is_array($columns) ? $columns : func_get_args()
        );
    }

    /**
     * @param string $class
     * @param array  $columns
     *
     * @return mixed
     */
    protected function constraint($class, array $columns)
    {
        $constraint = new $class($this->getBuilder(), $columns);

        $this->queue($constraint);

        return $constraint;
    }

    /**
     * @return \Doctrine\ORM\Mapping\Builder\ClassMetadataBuilder
     */
    abstract public function getBuilder();

    /**
     * @param Buildable $buildable
     */
    abstract protected function queue(Buildable $buildable);
}

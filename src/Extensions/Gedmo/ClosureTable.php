<?php

namespace AdroSoftware\Fluent\Extensions\Gedmo;

use Gedmo\Tree\Entity\Repository\ClosureTreeRepository;
use AdroSoftware\Fluent\Buildable;
use AdroSoftware\Fluent\Builders\Delay;
use AdroSoftware\Fluent\Fluent;

class ClosureTable extends TreeStrategy implements Buildable, Delay
{
    /**
     * @var string
     */
    private $closureClass;

    /**
     * ClosureTable constructor.
     *
     * @param Fluent $builder
     * @param string $class
     */
    public function __construct(Fluent $builder, $class)
    {
        parent::__construct($builder);

        $this->closureClass = $class;
    }

    /**
     * Execute the build process.
     */
    public function build()
    {
        $this->builder->entity()->setRepositoryClass(ClosureTreeRepository::class);

        parent::build();
    }

    /**
     * {@inheritdoc}
     */
    protected function getValues()
    {
        return array_merge(parent::getValues(), [
            'strategy' => 'closure',
            'closure'  => $this->closureClass,
        ]);
    }
}

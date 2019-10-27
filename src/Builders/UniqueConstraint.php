<?php

namespace AdroSoftware\Fluent\Builders;

use AdroSoftware\Fluent\Buildable;

class UniqueConstraint extends Index implements Buildable
{
    /**
     * Suffix to be added to the index key name.
     *
     * @var string
     */
    protected $suffix = 'unique';

    /**
     * Execute the build process.
     */
    public function build()
    {
        $this->builder->addUniqueConstraint(
            $this->getColumns(),
            $this->getName()
        );
    }
}

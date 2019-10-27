<?php

namespace AdroSoftware\Fluent\Builders\Inheritance;

class JoinedTableInheritance extends AbstractInheritance
{
    /**
     * Set inheritance type.
     */
    protected function setType()
    {
        $this->builder->setJoinedTableInheritance();
    }
}

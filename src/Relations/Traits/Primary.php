<?php

namespace AdroSoftware\Fluent\Relations\Traits;

/**
 * @method $this makePrimaryKey()
 */
trait Primary
{
    /**
     * @return $this
     */
    public function primary()
    {
        $this->getAssociation()->makePrimaryKey();

        return $this;
    }
}

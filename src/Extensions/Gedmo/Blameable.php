<?php

namespace AdroSoftware\Fluent\Extensions\Gedmo;

use Gedmo\Blameable\Mapping\Driver\Fluent;
use AdroSoftware\Fluent\Buildable;
use AdroSoftware\Fluent\Builders\Field;
use AdroSoftware\Fluent\Extensions\Extension;
use AdroSoftware\Fluent\Relations\ManyToOne;

class Blameable extends AbstractTrackingExtension implements Buildable, Extension
{
    const MACRO_METHOD = 'blameable';

    /**
     * Enable the extension.
     *
     * @return void
     */
    public static function enable()
    {
        Field::macro(self::MACRO_METHOD, function (Field $builder) {
            return new static($builder->getClassMetadata(), $builder->getName());
        });

        ManyToOne::macro(self::MACRO_METHOD, function (ManyToOne $builder) {
            return new static($builder->getClassMetadata(), $builder->getRelation());
        });
    }

    /**
     * Return the name of the actual extension.
     *
     * @return string
     */
    protected function getExtensionName()
    {
        return Fluent::EXTENSION_NAME;
    }
}

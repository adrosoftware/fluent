<?php

namespace AdroSoftware\Fluent\Extensions\Gedmo;

use Gedmo\Timestampable\Mapping\Driver\Fluent as FluentDriver;
use AdroSoftware\Fluent\Buildable;
use AdroSoftware\Fluent\Builders\Field;
use AdroSoftware\Fluent\Extensions\Extension;

class Timestampable extends AbstractTrackingExtension implements Buildable, Extension
{
    const MACRO_METHOD = 'timestampable';

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

        Timestamps::enable();
    }

    /**
     * Return the name of the actual extension.
     *
     * @return string
     */
    protected function getExtensionName()
    {
        return FluentDriver::EXTENSION_NAME;
    }
}

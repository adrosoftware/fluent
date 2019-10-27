<?php

namespace AdroSoftware\Fluent\Extensions\Gedmo;

use Gedmo\IpTraceable\Mapping\Driver\Fluent;
use AdroSoftware\Fluent\Buildable;
use AdroSoftware\Fluent\Builders\Field;
use AdroSoftware\Fluent\Extensions\Extension;

class IpTraceable extends AbstractTrackingExtension implements Buildable, Extension
{
    const MACRO_METHOD = 'ipTraceable';

    /**
     * @return void
     */
    public static function enable()
    {
        Field::macro(static::MACRO_METHOD, function (Field $builder) {
            return new static($builder->getClassMetadata(), $builder->getName());
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

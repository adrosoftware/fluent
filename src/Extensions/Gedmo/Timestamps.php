<?php

namespace AdroSoftware\Fluent\Extensions\Gedmo;

use AdroSoftware\Fluent\Builders\Builder;
use AdroSoftware\Fluent\Fluent;

class Timestamps
{
    const MACRO_METHOD = 'timestamps';

    /**
     * Enable the extension.
     *
     * @return void
     */
    public static function enable()
    {
        Builder::macro(self::MACRO_METHOD, function (Fluent $builder, $createdAt = 'createdAt', $updatedAt = 'updatedAt', $type = 'dateTime') {
            $builder->{$type}($createdAt)->timestampable()->onCreate();
            $builder->{$type}($updatedAt)->timestampable()->onUpdate();
        });
    }
}

<?php

namespace AdroSoftware\Fluent\Extensions\Gedmo;

use AdroSoftware\Fluent\Extensions\Extension;

class Sortable implements Extension
{
    /**
     * @return void
     */
    public static function enable()
    {
        SortablePosition::enable();
        SortableGroup::enable();
    }
}

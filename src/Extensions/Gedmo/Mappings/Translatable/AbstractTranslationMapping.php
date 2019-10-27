<?php

namespace AdroSoftware\Fluent\Extensions\Gedmo\Mappings\Translatable;

use Gedmo\Translatable\Entity\MappedSuperclass\AbstractTranslation;
use AdroSoftware\Fluent\Builders\GeneratedValue;
use AdroSoftware\Fluent\Fluent;
use AdroSoftware\Fluent\MappedSuperClassMapping;

class AbstractTranslationMapping extends MappedSuperClassMapping
{
    /**
     * {@inheritdoc}
     */
    public function mapFor()
    {
        return AbstractTranslation::class;
    }

    /**
     * {@inheritdoc}
     */
    public function map(Fluent $builder)
    {
        $builder->integer('id')->unsigned()->primary()->generatedValue(function (GeneratedValue $builder) {
            $builder->identity();
        });
        $builder->string('locale')->length(8);
        $builder->string('objectClass')->name('object_class');
        $builder->string('field')->length(32);
        $builder->string('foreignKey')->length(64)->name('foreign_key');
        $builder->text('content')->nullable();
    }
}

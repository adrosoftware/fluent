<?php

namespace Tests\Extensions\Gedmo\Mappings\Translatable;

use Gedmo\Translatable\Entity\Repository\TranslationRepository;
use Gedmo\Translatable\Entity\Translation;
use AdroSoftware\Fluent\Builders\Entity;
use AdroSoftware\Fluent\Builders\Index;
use AdroSoftware\Fluent\Builders\UniqueConstraint;
use AdroSoftware\Fluent\Extensions\Gedmo\Mappings\Translatable\TranslationMapping;
use Tests\Extensions\Gedmo\Mappings\MappingTestCase;

class TranslationMappingTest extends MappingTestCase
{
    protected function getMappingClass()
    {
        return TranslationMapping::class;
    }

    protected function getMappedClass()
    {
        return Translation::class;
    }

    protected function configureMocks()
    {
        /** @var Entity|\Mockery\Mock $entity */
        $entity = \Mockery::mock(Entity::class);
        $entity->shouldReceive('setRepositoryClass')->with(TranslationRepository::class)->once()->andReturnSelf();

        /** @var Index|\Mockery\Mock $index */
        $index = \Mockery::mock(Index::class);
        $index->shouldReceive('name')->with('translations_lookup_idx')->once()->andReturnSelf();

        /** @var UniqueConstraint|\Mockery\Mock $unique */
        $unique = \Mockery::mock(UniqueConstraint::class);
        $unique->shouldReceive('name')->with('lookup_unique_idx')->once()->andReturnSelf();

        $this->builder->shouldReceive('table')->with('ext_translations')->once()->andReturnSelf();
        $this->builder->shouldReceive('entity')->once()->andReturn($entity);
        $this->builder->shouldReceive('index')->with(["locale", "object_class", "foreign_key"])->once()->andReturn($index);
        $this->builder->shouldReceive('unique')->with(["locale", "object_class", "field", "foreign_key"])->once()->andReturn($unique);
    }
}

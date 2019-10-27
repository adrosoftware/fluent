# Fluent Mapping Driver

> **This is a fork of [laravel-doctrin/fluent](https://github.com/laravel-doctrine/fluent) with some modifications**


*A fluent mapping driver for Doctrine2*

```
composer require adrosoftware/fluent
```

This mapping driver allows you to manage your mappings in an Object Oriented approach, separating your entities
from your mapping configuration without the need for configuration files like XML or YAML.
This is done by implementing the `AdroSoftware\Fluent\Mapping` interface, or extending the abstract classes
provided with this package for an easier use:
`AdroSoftware\Fluent\EntityMapping`, `AdroSoftware\Fluent\EmbeddableMapping` or `MappedSuperClassMapping`.

This package provides a fluent Builder over Doctrine's `ClassMetadataBuilder`, aimed at easing usage of
Doctrine's mapping concepts in Laravel. The builder adds syntax sugar and implements the same grammar that you
might use in Laravel migrations.

```php
class ScientistMapping extends EntityMapping
{
    /**
     * Returns the fully qualified name of the class that this mapper maps.
     *
     * @return string
     */
    public function mapFor()
    {
        return Scientist::class;
    }

    /**
     * Load the object's metadata through the Metadata Builder object.
     *
     * @param Fluent $builder
     */
    public function map(Fluent $builder)
    {
        $builder->increments('id');
        $builder->embed(Name::class, 'name');
 
        $builder->hasMany(Theory::class, 'theories')->ownedBy('scientist');
    }
}
```


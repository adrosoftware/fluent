<?php

namespace AdroSoftware\Fluent\Extensions\Gedmo;

use Gedmo\Loggable\Mapping\Driver\Fluent;
use AdroSoftware\Fluent\Buildable;
use AdroSoftware\Fluent\Builders\Field;
use AdroSoftware\Fluent\Extensions\ExtensibleClassMetadata;
use AdroSoftware\Fluent\Relations\ManyToOne;
use AdroSoftware\Fluent\Relations\OneToOne;

class Versioned implements Buildable
{
    const MACRO_METHOD = 'versioned';

    /**
     * @var ExtensibleClassMetadata
     */
    private $classMetadata;

    /**
     * @var string
     */
    private $fieldName;

    /**
     * Versioned constructor.
     *
     * @param ExtensibleClassMetadata $classMetadata
     * @param string                  $fieldName
     */
    public function __construct(ExtensibleClassMetadata $classMetadata, $fieldName)
    {
        $this->classMetadata = $classMetadata;
        $this->fieldName = $fieldName;
    }

    public static function enable()
    {
        Field::macro(self::MACRO_METHOD, function (Field $builder) {
            return new static($builder->getClassMetadata(), $builder->getName());
        });

        ManyToOne::macro(self::MACRO_METHOD, function (ManyToOne $builder) {
            return new static($builder->getClassMetadata(), $builder->getRelation());
        });

        OneToOne::macro(self::MACRO_METHOD, function (OneToOne $builder) {
            return new static($builder->getClassMetadata(), $builder->getRelation());
        });
    }

    /**
     * Execute the build process.
     */
    public function build()
    {
        $config = $this->classMetadata->getExtension(Fluent::EXTENSION_NAME);

        $config['loggable'] = true;
        $config['versioned'] = array_unique(array_merge(
            isset($config['versioned']) ? $config['versioned'] : [],
            [
                $this->fieldName,
            ]
        ));

        $this->classMetadata->addExtension(Fluent::EXTENSION_NAME, $config);
    }
}

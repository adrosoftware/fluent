<?php

namespace AdroSoftware\Fluent\Extensions\Gedmo;

use Gedmo\Translatable\Mapping\Driver\Fluent as FluentDriver;
use AdroSoftware\Fluent\Buildable;
use AdroSoftware\Fluent\Builders\Field;
use AdroSoftware\Fluent\Extensions\ExtensibleClassMetadata;
use AdroSoftware\Fluent\Extensions\Extension;

class Translatable implements Buildable, Extension
{
    const MACRO_METHOD = 'translatable';

    /**
     * @var ExtensibleClassMetadata
     */
    protected $classMetadata;

    /**
     * @var string
     */
    protected $fieldName;

    /**
     * @param ExtensibleClassMetadata $classMetadata
     * @param string                  $fieldName
     */
    public function __construct(ExtensibleClassMetadata $classMetadata, $fieldName)
    {
        $this->classMetadata = $classMetadata;
        $this->fieldName = $fieldName;
    }

    /**
     * Return the name of the actual extension.
     *
     * @return string
     */
    public function getExtensionName()
    {
        return FluentDriver::EXTENSION_NAME;
    }

    /**
     * @return void
     */
    public static function enable()
    {
        Field::macro(static::MACRO_METHOD, function (Field $builder) {
            return new static($builder->getClassMetadata(), $builder->getName());
        });

        Locale::enable();
        TranslationClass::enable();
    }

    /**
     * Execute the build process.
     */
    public function build()
    {
        $this->classMetadata->appendExtension($this->getExtensionName(), [
            'fields' => [
                $this->fieldName,
            ],
        ]);
    }
}

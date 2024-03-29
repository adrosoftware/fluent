<?php

namespace AdroSoftware\Fluent\Extensions\Gedmo;

use Gedmo\Exception\InvalidMappingException;
use Gedmo\Tree\Mapping\Driver\Fluent as FluentDriver;
use Gedmo\Tree\Mapping\Validator;
use AdroSoftware\Fluent\Buildable;
use AdroSoftware\Fluent\Builders\Field;
use AdroSoftware\Fluent\Extensions\ExtensibleClassMetadata;

class TreeLevel implements Buildable
{
    const MACRO_METHOD = 'treeLevel';

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
     * Enable TreeLevel.
     */
    public static function enable()
    {
        Field::macro(self::MACRO_METHOD, function (Field $field) {
            return new static($field->getClassMetadata(), $field->getName());
        });
    }

    /**
     * Execute the build process.
     */
    public function build()
    {
        if (!(new Validator())->isValidField($this->classMetadata, $this->fieldName)) {
            throw new InvalidMappingException("Tree level field must be 'integer' in class - {$this->classMetadata->name}");
        }

        $this->classMetadata->mergeExtension($this->getExtensionName(), [
            'level' => $this->fieldName,
        ]);
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
}

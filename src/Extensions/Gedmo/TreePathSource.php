<?php

namespace AdroSoftware\Fluent\Extensions\Gedmo;

use Gedmo\Exception\InvalidMappingException;
use Gedmo\Tree\Mapping\Driver\Fluent as FluentDriver;
use Gedmo\Tree\Mapping\Validator;
use AdroSoftware\Fluent\Buildable;
use AdroSoftware\Fluent\Builders\Field;
use AdroSoftware\Fluent\Extensions\ExtensibleClassMetadata;

class TreePathSource implements Buildable
{
    const MACRO_METHOD = 'treePathSource';

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
     * Enable TreePathSource.
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
        if (!(new Validator())->isValidFieldForPathSource($this->classMetadata, $this->fieldName)) {
            throw new InvalidMappingException(
                "Tree PathSource field - [{$this->fieldName}] type is not valid. It can be any of the integer variants, double, float or string in class - {$this->classMetadata->name}"
            );
        }

        $this->classMetadata->mergeExtension($this->getExtensionName(), [
            'path_source' => $this->fieldName,
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

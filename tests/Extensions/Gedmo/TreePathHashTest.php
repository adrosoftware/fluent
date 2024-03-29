<?php

namespace Tests\Extensions\Gedmo;

use Doctrine\ORM\Mapping\Builder\ClassMetadataBuilder;
use Gedmo\Exception\InvalidMappingException;
use AdroSoftware\Fluent\Builders\Field;
use AdroSoftware\Fluent\Extensions\ExtensibleClassMetadata;
use Gedmo\Tree\Mapping\Driver\Fluent as TreeDriver;
use AdroSoftware\Fluent\Extensions\Gedmo\TreePathHash;

/**
 * @mixin \PHPUnit_Framework_TestCase
 */
class TreePathHashTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var string
     */
    protected $fieldName;

    /**
     * @var ExtensibleClassMetadata
     */
    protected $classMetadata;

    /**
     * @var TreePathHash
     */
    private $extension;

    protected function setUp()
    {
        $this->fieldName     = 'hash';
        $this->classMetadata = new ExtensibleClassMetadata('foo');
        Field::make(new ClassMetadataBuilder($this->classMetadata), 'integer', $this->fieldName)->build();

        $this->extension = new TreePathHash($this->classMetadata, $this->fieldName);
    }

    public function test_it_should_add_itself_as_a_field_macro()
    {
        TreePathHash::enable();

        $field = Field::make(new ClassMetadataBuilder(
            new ExtensibleClassMetadata('Foo')), 'integer', $this->fieldName
        )->build();

        $this->assertInstanceOf(
            TreePathHash::class,
            call_user_func([$field, TreePathHash::MACRO_METHOD])
        );
    }

    public function test_can_mark_a_field_as_hash()
    {
        $this->getExtension()->build();

        $this->assertBuildResultIs([
            'path_hash' => 'hash',
        ]);
    }

    /**
     * Assert that the resulting build matches exactly with the given array.
     *
     * @param array $expected
     *
     * @return void
     * @throws \PHPUnit_Framework_ExpectationFailedException
     */
    protected function assertBuildResultIs(array $expected)
    {
        $this->assertEquals($expected, $this->classMetadata->getExtension(
            $this->getExtensionName()
        ));
    }

    /**
     * @return TreePathHash
     */
    protected function getExtension()
    {
        return $this->extension;
    }

    /**
     * @return string
     */
    protected function getExtensionName()
    {
        return TreeDriver::EXTENSION_NAME;
    }
}

<?php

namespace Tests\Extensions\Gedmo;

use Doctrine\ORM\Mapping\Builder\ClassMetadataBuilder;
use Gedmo\Exception\InvalidMappingException;
use AdroSoftware\Fluent\Builders\Field;
use AdroSoftware\Fluent\Extensions\ExtensibleClassMetadata;
use Gedmo\Tree\Mapping\Driver\Fluent as TreeDriver;
use AdroSoftware\Fluent\Extensions\Gedmo\TreeLevel;

/**
 * @mixin \PHPUnit_Framework_TestCase
 */
class TreeLevelTest extends \PHPUnit_Framework_TestCase
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
     * @var TreeLevel
     */
    private $extension;

    protected function setUp()
    {
        $this->fieldName     = 'lvl';
        $this->classMetadata = new ExtensibleClassMetadata('foo');
        Field::make(new ClassMetadataBuilder($this->classMetadata), 'integer', $this->fieldName)->build();

        $this->extension = new TreeLevel($this->classMetadata, $this->fieldName);
    }

    public function test_it_should_add_itself_as_a_field_macro()
    {
        TreeLevel::enable();

        $field = Field::make(new ClassMetadataBuilder(
            new ExtensibleClassMetadata('Foo')), 'integer', $this->fieldName
        )->build();

        $this->assertInstanceOf(
            TreeLevel::class,
            call_user_func([$field, TreeLevel::MACRO_METHOD])
        );
    }

    public function test_can_mark_a_field_as_level()
    {
        $this->getExtension()->build();

        $this->assertBuildResultIs([
            'level' => 'lvl',
        ]);
    }

    public function test_level_should_be_integer()
    {
        $this->setExpectedException(InvalidMappingException::class, 'Tree level field must be \'integer\' in class - foo');

        $this->classMetadata = new ExtensibleClassMetadata('foo');
        Field::make(new ClassMetadataBuilder($this->classMetadata), 'string', $this->fieldName)->build();
        $this->extension = new TreeLevel($this->classMetadata, $this->fieldName);

        $this->getExtension()->build();
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
     * @return TreeLevel
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

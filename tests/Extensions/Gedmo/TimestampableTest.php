<?php
namespace Tests\Extensions\Gedmo;

use Doctrine\ORM\Mapping\Builder\ClassMetadataBuilder;
use Gedmo\Timestampable\Mapping\Driver\Fluent as TimestampableDriver;
use AdroSoftware\Fluent\Builders\Builder;
use AdroSoftware\Fluent\Builders\Field;
use AdroSoftware\Fluent\Extensions\ExtensibleClassMetadata;
use AdroSoftware\Fluent\Extensions\Gedmo\AbstractTrackingExtension;
use AdroSoftware\Fluent\Extensions\Gedmo\Timestampable;
use PHPUnit_Framework_TestCase;

class TimestampableTest extends PHPUnit_Framework_TestCase
{
    use TrackingExtensions;

    /**
     * @var Timestampable
     */
    private $extension;

    protected function setUp()
    {
        $this->fieldName     = 'ip';
        $this->classMetadata = new ExtensibleClassMetadata('foo');
        $this->extension     = new Timestampable($this->classMetadata, $this->fieldName);
    }

    public function test_it_should_add_itself_as_a_field_macro()
    {
        Timestampable::enable();

        $field = Field::make(new ClassMetadataBuilder(new ExtensibleClassMetadata('Foo')), 'string', $this->fieldName);

        $this->assertInstanceOf(
            Timestampable::class,
            call_user_func([$field, Timestampable::MACRO_METHOD])
        );
    }

    public function test_it_should_make_itself_a_builder_macro()
    {
        Timestampable::enable();

        $builder = new Builder($cmb = new ClassMetadataBuilder(new ExtensibleClassMetadata('Foo')));

        $this->assertNull(
            call_user_func([$builder, 'timestamps'])
        );
    }

    /**
     * @return AbstractTrackingExtension
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
        return TimestampableDriver::EXTENSION_NAME;
    }
}

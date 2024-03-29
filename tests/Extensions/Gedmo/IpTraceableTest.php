<?php
namespace Tests\Extensions\Gedmo;

use Doctrine\ORM\Mapping\Builder\ClassMetadataBuilder;
use Gedmo\IpTraceable\Mapping\Driver\Fluent as IpTraceableDriver;
use AdroSoftware\Fluent\Builders\Field;
use AdroSoftware\Fluent\Extensions\ExtensibleClassMetadata;
use AdroSoftware\Fluent\Extensions\Gedmo\AbstractTrackingExtension;
use AdroSoftware\Fluent\Extensions\Gedmo\IpTraceable;
use PHPUnit_Framework_TestCase;

class IpTraceableTest extends PHPUnit_Framework_TestCase
{
    use TrackingExtensions;

    /**
     * @var IpTraceable
     */
    private $extension;

    protected function setUp()
    {
        $this->fieldName     = 'ip';
        $this->classMetadata = new ExtensibleClassMetadata('foo');
        $this->extension     = new IpTraceable($this->classMetadata, $this->fieldName);
    }

    public function test_it_should_add_itself_as_a_field_macro()
    {
        IpTraceable::enable();

        $field = Field::make(new ClassMetadataBuilder(new ExtensibleClassMetadata('Foo')), 'string', $this->fieldName);

        $this->assertInstanceOf(
            IpTraceable::class,
            call_user_func([$field, IpTraceable::MACRO_METHOD])
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
        return IpTraceableDriver::EXTENSION_NAME;
    }
}

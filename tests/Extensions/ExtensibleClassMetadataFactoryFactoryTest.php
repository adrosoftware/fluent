<?php
namespace Tests\Extensions;

use Doctrine\ORM\Configuration;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\Mapping\NamingStrategy;
use AdroSoftware\Fluent\Extensions\ExtensibleClassMetadata;
use AdroSoftware\Fluent\Extensions\ExtensibleClassMetadataFactory;
use PHPUnit_Framework_TestCase;

class ExtensibleClassMetadataFactoryTest extends PHPUnit_Framework_TestCase
{
    public function test_it_builds_extensible_class_metadata_objects()
    {
        $em = \Mockery::mock(EntityManager::class);
        $config = \Mockery::mock(Configuration::class);
        $namingStrategy = \Mockery::mock(NamingStrategy::class);

        $em->shouldReceive('getConfiguration')->once()->andReturn($config);
        $config->shouldReceive('getNamingStrategy')->once()->andReturn($namingStrategy);

        $factory = new ExtensionFactoryTest();
        $factory->setEntityManager($em);

        $this->assertInstanceOf(ExtensibleClassMetadata::class, $factory->getClassMetadataInstance());
    }
}

class ExtensionFactoryTest extends ExtensibleClassMetadataFactory {
    /**
     * This is the only sane way of testing the small part of what we do in this factory.
     * Every other test would require infinite mocking.
     *
     * @return ExtensibleClassMetadata
     */
    public function getClassMetadataInstance()
    {
        return $this->newClassMetadataInstance("Foo");
    }
}

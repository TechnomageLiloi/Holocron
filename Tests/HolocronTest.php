<?php

namespace Liloi\Holocron;

use PHPUnit\Framework\TestCase;
use Liloi\Holocron\Holocron;
use Liloi\Holocron\Domain\Sphere\Entity as SphereEntity;
use Liloi\Holocron\Types\Node\Entity as NodeEntity;
use Liloi\Holocron\Types\Atom\Entity as AtomEntity;

/**
 * Check phpUnit testing ability.
 */
class HolocronTest extends TestCase
{
    /**
     * Tests true is indeed true :-)
     */
    public function testCheck()
    {
        $root = __DIR__ . '/Sandbox';
        $this->assertTrue(class_exists('Liloi\Holocron\Holocron'));

        $holocron = Holocron::create($root);

        $this->assertTrue($holocron instanceof Holocron);
        $this->assertEquals($root, $holocron->getRootFolder());

        $this->assertTrue($holocron->get('') instanceof NodeEntity);
        /** @var NodeEntity $rootNode */
        $rootNode = $holocron->get('');
        $this->assertEquals($root, $rootNode->getPath());

        $this->assertTrue($holocron->get('index:json') instanceof AtomEntity);
        $atomIndex = $holocron->get('index:json');
        $this->assertEquals($root . '/index.json', $atomIndex->getPath());

        $this->assertTrue($holocron->get('test:index:json') instanceof AtomEntity);
        $atomIndex = $holocron->get('test:index:json');
        $this->assertEquals($root . '/test/index.json', $atomIndex->getPath());

        $children = $rootNode->getChildren();
        $this->assertEquals(2, $children->count());
    }
}
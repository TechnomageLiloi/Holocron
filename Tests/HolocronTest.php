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

        $idRoot = '';
        $this->assertTrue($holocron->get($idRoot) instanceof NodeEntity);
        /** @var NodeEntity $rootNode */
        $rootNode = $holocron->get($idRoot);
        $this->assertEquals($idRoot, $rootNode->getID());
        $this->assertEquals($root, $rootNode->getPath());

        $idIndexJson = 'index:json';
        $this->assertTrue($holocron->get($idIndexJson) instanceof AtomEntity);
        $atomIndex = $holocron->get($idIndexJson);
        $this->assertEquals($idIndexJson, $atomIndex->getID());
        $this->assertEquals($root . '/index.json', $atomIndex->getPath());

        $idTestIndexJson = 'test:index:json';
        $this->assertTrue($holocron->get($idTestIndexJson) instanceof AtomEntity);
        $atomTestIndex = $holocron->get($idTestIndexJson);
        $this->assertEquals($idTestIndexJson, $atomTestIndex->getID());
        $this->assertEquals($root . '/test/index.json', $atomTestIndex->getPath());

        $children = $rootNode->getChildren();
        $this->assertEquals(2, $children->count());
    }
}
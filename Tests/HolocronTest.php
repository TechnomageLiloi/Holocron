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

        $holocron = Holocron::create($root, '/Sandbox');

        $this->assertTrue($holocron instanceof Holocron);
        $this->assertEquals($root, $holocron->getRootFolder());

        $idRoot = '';
        $this->assertTrue($holocron->get($idRoot) instanceof NodeEntity);
        /** @var NodeEntity $rootNode */
        $rootNode = $holocron->get($idRoot);
        $this->assertEquals($idRoot, $rootNode->getID());
        $this->assertEquals($root, $rootNode->getPath());
        $this->assertEquals('/Sandbox', $rootNode->getLink());

        $idIndexJson = 'index:json';
        $this->assertTrue($holocron->get($idIndexJson) instanceof AtomEntity);
        $atomIndex = $holocron->get($idIndexJson);
        $this->assertEquals($idIndexJson, $atomIndex->getID());
        $this->assertEquals($root . '/index.json', $atomIndex->getPath());
        $this->assertEquals('/Sandbox/index.json', $atomIndex->getLink());

        $idTest = 'test';
        $this->assertTrue($holocron->get($idTest) instanceof NodeEntity);
        /** @var NodeEntity $rootNode */
        $testNode = $holocron->get($idTest);
        $this->assertEquals($idTest, $testNode->getID());
        $this->assertEquals($root . '/test', $testNode->getPath());
        $this->assertEquals('/Sandbox/test', $testNode->getLink());

        $idTestIndexJson = 'test:index:json';
        $this->assertTrue($holocron->get($idTestIndexJson) instanceof AtomEntity);
        $atomTestIndex = $holocron->get($idTestIndexJson);
        $this->assertEquals($idTestIndexJson, $atomTestIndex->getID());
        $this->assertEquals($root . '/test/index.json', $atomTestIndex->getPath());
        $this->assertEquals('/Sandbox/test/index.json', $atomTestIndex->getLink());
        $this->assertEquals('json', $atomTestIndex->getInfo(PATHINFO_EXTENSION));

        $this->assertTrue(is_array($atomTestIndex->getInfo()));

        $children = $rootNode->getChildren();
        $this->assertEquals(2, $children->count());
    }
}
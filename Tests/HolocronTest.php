<?php

namespace Liloi\Holocron;

use PHPUnit\Framework\TestCase;
use Liloi\Holocron\Holocron;
use Liloi\Holocron\Types\Node\Entity as NodeEntity;

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

        $rootNode = $holocron->get('');

        $this->assertEquals($root, $rootNode->getPath());
    }
}
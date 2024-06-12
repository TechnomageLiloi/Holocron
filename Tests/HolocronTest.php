<?php

namespace Liloi\Holocron;

use PHPUnit\Framework\TestCase;
use Liloi\Holocron\Holocron;

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
        $this->assertEquals('Liloi\Holocron\Holocron', Holocron::class);
    }
}
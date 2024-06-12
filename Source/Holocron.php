<?php

namespace Liloi\Holocron;

use Liloi\Judex\Assert;

class Holocron
{
    private ?string $root = null;

    public static function create(string $root): self
    {
        Assert::notEmpty($root);

        $holocron = new self();
        $holocron->root = $root;

        return $holocron;
    }
}
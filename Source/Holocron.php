<?php

namespace Liloi\Holocron;

use Liloi\Holocron\Domain\Atom\Entity as AtomEntity;
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

    public function getRootFolder(): string
    {
        Assert::notNull($this->root);
        return $this->root;
    }

    public function get(string $RID): AtomEntity
    {
        $data = [];
        return AtomEntity::create($data);
    }
}
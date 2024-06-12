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
        $pathLocal = '/' . str_replace(':', '/', $RID);
        $pathGlobal = $this->getRootFolder() . $pathLocal;

        $data = [
            'path' => $pathGlobal,
        ];
        $type = null;

        if(is_dir($pathLocal))
        {
            $type = 'Node';
        }

        Assert::notNull($type);

        $atomTypeClass = "\\Liloi\\Holocron\\$type\\Entity";
        return $atomTypeClass::create($data);
    }
}
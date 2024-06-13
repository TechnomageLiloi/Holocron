<?php

namespace Liloi\Holocron;

use Liloi\Holocron\Domain\Sphere\Entity as SphereEntity;
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

    public function get(string $RID): SphereEntity
    {
        $pathLocal = '/' . str_replace(':', '/', $RID);
        $pathGlobal = rtrim($this->getRootFolder() . $pathLocal, '/');

        $data = [];
        $type = null;

        if(is_dir($pathLocal))
        {
            $type = 'Node';
        }
        else
        {
            $parts = explode('/', $pathGlobal);

            $parts[count($parts) - 2] .= '.' . end($parts);
            array_pop($parts);

            $pathGlobal = implode('/', $parts);

            if(file_exists($pathGlobal))
            {
                $type = 'Atom';
            }
        }

        $data['path'] = $pathGlobal;
        $data['holocron'] = $this;

        Assert::notNull($type);

        $atomTypeClass = "\\Liloi\\Holocron\\Types\\$type\\Entity";
        return $atomTypeClass::create($data);
    }
}
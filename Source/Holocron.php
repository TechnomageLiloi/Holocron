<?php

namespace Liloi\Holocron;

use Liloi\Holocron\Domain\Sphere\Entity as SphereEntity;
use Liloi\Judex\Assert;

class Holocron
{
    private ?string $rootPath = null;
    private ?string $rootLink = null;

    public static function create(
        string $rootPath,
        string $rootLink = '/'
    ): self
    {
        Assert::notEmpty($rootPath);
        Assert::notEmpty($rootLink);

        $holocron = new self();
        $holocron->rootPath = $rootPath;
        $holocron->rootLink = $rootLink;

        return $holocron;
    }

    public function getRootFolder(): string
    {
        Assert::notNull($this->rootPath);
        return $this->rootPath;
    }

    public function getRootLink(): string
    {
        Assert::notNull($this->rootLink);
        return $this->rootLink;
    }

    public function get(string $id): SphereEntity
    {
        $pathLocal = '/' . str_replace(':', '/', $id);
        $pathGlobal = rtrim($this->getRootFolder() . $pathLocal, '/');

        $data = [];
        $type = null;

        if(is_dir($pathGlobal))
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
<?php

namespace Liloi\Holocron\Types\Node;

use Liloi\Holocron\Domain\Sphere\Entity as AbstractEntity;
use Liloi\Holocron\Domain\Sphere\Collection;
use Liloi\Holocron\Types\Atom\Entity as AtomEntity;

class Entity extends AbstractEntity
{
    public function getChildren(): Collection
    {
        $collection = new Collection();

        $parent = $this->getPath();

        if ($handle = opendir($parent))
        {
            while (false !== ($entry = readdir($handle)))
            {
                if (in_array($entry, ['.', '..']))
                {
                    continue;
                }

                $child = $parent . '/' . $entry;
                $parts = pathinfo($child);

                $data = [
                    'path' => $child
                ];

                if(is_dir($child))
                {
                    $collection[] = self::create($data);
                    continue;
                }

                $collection[] = AtomEntity::create($data);
            }

            closedir($handle);
        }

        return $collection;
    }
}
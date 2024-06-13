<?php

namespace Liloi\Holocron\Domain\Sphere;

use Liloi\Stylo\Parser;
use Liloi\Tools\Entity as AbstractEntity;
use Liloi\Holocron\Holocron;

/**
 * @method string getPath(): string
 * @method void setPath(string $value)
 *
 * @method string getHolocron(): Holocron
 * @method void setHolocron(Holocron $value)
 */
class Entity extends AbstractEntity
{
    public function getID(): string
    {
        $global = $this->getPath();
        $local = trim(str_replace($this->getHolocron()->getRootFolder(), '', $global), '/');
        $id = str_replace(array('/', '.'), ':', $local);
        return $id;
    }
}
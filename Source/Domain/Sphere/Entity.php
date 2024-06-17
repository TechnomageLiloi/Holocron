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

    public function getLink(): string
    {
        $global = $this->getPath();
        $local = rtrim(str_replace($this->getHolocron()->getRootFolder(), '', $global), '/');
        return $this->getHolocron()->getRootLink() . $local;
    }

    /**
     * PATHINFO_DIRNAME
     * PATHINFO_BASENAME
     * PATHINFO_EXTENSION
     * PATHINFO_FILENAME
     *
     * @param null $options
     * @return string|string[]
     */
    public function getInfo($options = null)
    {
        if($options === null)
        {
            return pathinfo($this->getPath());
        }

        return pathinfo($this->getPath(), $options);
    }
}
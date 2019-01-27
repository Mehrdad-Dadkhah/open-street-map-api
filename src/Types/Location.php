<?php

namespace MehrdadDadkhah\OSM\Types;

class Location implements TypeInterface
{
    /** @var mixed[] main value of type */
    private $value;

    /** @var mixed[] main value of type */
    private $address;

    /**
     * set value of type function
     *
     * @param mixed $value
     * @return TypeInterface
     */
    public function setValue($value): TypeInterface
    {
        $this->value = $value;
        $this->address = $value->address;

        return $this;
    }

    /**
     * get main value function
     *
     * @return mixed
     */
    public function getValue()
    {
        return $this->value;
    }

    /**
     * get address function
     *
     * @return Json
     */
    public function getAddress()
    {
        return $this->address;
    }
}

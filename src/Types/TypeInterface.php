<?php

namespace MehrdadDadkhah\OSM\Types;

interface TypeInterface
{
    /**
     * set value of type function
     *
     * @param mixed $value
     * @return TypeInterface
     */
    public function setValue($value): TypeInterface;

    /**
     * get main value function
     *
     * @return mixed
     */
    public function getValue();
}

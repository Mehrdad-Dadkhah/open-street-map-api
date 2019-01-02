<?php

namespace MehrdadDadkhah\OSM\Types;

class Distance implements TypeInterface
{
    /** @var $value main value of type */
    private $value;

    const METER_UNIT     = 'meter';
    const KILOMETER_UNIT = 'kilometer';

    /**
     * set value of type function
     *
     * @param mixed $value
     * @return TypeInterface
     */
    public function setValue($value): TypeInterface
    {
        $this->value = $value;

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
     * get value of type in specific unit function
     *
     * @param string $unit
     * @return mixed
     */
    public function getWithUnit(string $unit)
    {
        switch (strtolower($unit)) {
            case self::METER_UNIT:
                return $this->getValue();

            case self::KILOMETER_UNIT:
                return $this->getValue() / 1000;

            default:
                throw new \Exception('Invalid unit. unit can be meter or kilometer.');
        }
    }
}

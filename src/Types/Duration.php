<?php

namespace MehrdadDadkhah\OSM\Types;

class Duration implements TypeInterface
{
    /** @var $value main value of type */
    private $value;

    const SECOND_UNIT = 'second';
    const MINUTE_UNIT = 'minute';
    const HOUR_UNIT   = 'hour';

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
            case self::SECOND_UNIT:
                return $this->getValue();

            case self::MINUTE_UNIT:
                return $this->getValue() / 60;

            case self::HOUR_UNIT:
                return $this->getValue() / 60 / 60;

            default:
                throw new \Exception('Invalid unit. unit can be socond or minute or hour.');
        }
    }
}

<?php

class Timezone extends Matched implements MatchedInterface
{
    const TIMEZONE = 40;

    /**
     * Calculate Timezone
     *
     * @param string $key
     **/
    public static function calculate($key)
    {
        parent::$matches[$key] += self::TIMEZONE;
    }

}
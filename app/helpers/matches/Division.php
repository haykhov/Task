<?php

class Division extends Matched implements MatchedInterface
{
    const DIVISION = 30;

    /**
     * Calculate Division
     *
     * @param string $key
     **/
    public static function calculate($key)
    {
        parent::$matches[$key] += self::DIVISION;
    }

}
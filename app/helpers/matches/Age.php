<?php

class Age extends Matched implements MatchedInterface
{
    const AGE = 30;

    /**
     * Calculate Age
     *
     * @param string $key
     **/
    public static function calculate($key, $key1)
    {
        return self::AGE;
    }

}
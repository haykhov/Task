<?php

class Matched
{
    protected static $matches = [];
    protected static $recommendation = [];

    /**
     * Get Matches
     *
     * @param array $data
     * @return array $recommendation
     **/
    public static function getMatches(array $data)
    {
        for ($i = 1; $i <= count($data); $i++) {
            for ($j = 2; $j <= count($data); $j++) {
                if(($i == $j) || isset(self::$matches[$i.'_'.$j]) || isset(self::$matches[$j.'_'.$i])){
                    continue;
                }
                self::$matches[$i.'_'.$j] = 0;

                if($data[$i]['Division'] == $data[$j]['Division']){
                    Division::calculate($i.'_'.$j);
                }

                if(abs($data[$i]['Age'] - $data[$j]['Age']) <= 5){
                    Age::calculate($i.'_'.$j);
                }

                if($data[$i]['Timezone'] == $data[$j]['Timezone']){
                    Timezone::calculate($i.'_'.$j);
                }
            }
        }

        /* Get Recommendation */
        self::recommendation($data);

        return self::$recommendation;
    }

    /**
     * Get Recommendation
     *
     * @param array $data
     */
    private static function recommendation($data)
    {
        /* Sort Array */
        arsort(self::$matches);

        foreach (self::$matches as $key => $value)
        {
            $keyArr = explode('_', $key);
            array_push(self::$recommendation, ['users' => $data[$keyArr[0]]['Name'] . ' - ' . $data[$keyArr[1]]['Name'], 'percent' => $value.' %']);
        }
    }
}
<?php

class Matched
{
    protected static $matches = [];
    protected static $recommendation = ['users' => [], 'total' => []];

    /**
     * Get Matches
     *
     * @param array $data
     * @return array $recommendation
     **/
    public static function getMatches(array $data)
    {
        /* Users Key Combination array */
        $keyCom = [];

        for ($i = 1; $i < count($data); $i++) {
            /* Max Percent for iteration */
            $maxPercent = 0;
            for ($j = $i + 1; $j <= count($data); $j++) {

                /* Push Key Combination to array to avoid duplications */
                array_push($keyCom, $i . '_' . $j);
                array_push($keyCom, $j . '_' . $i);

                $eachPercent = 0;
                /* Check Division */
                if ($data[$i]['Division'] == $data[$j]['Division']) {
                    $eachPercent += Division::calculate();
                }

                /* Check Age */
                if (abs($data[$i]['Age'] - $data[$j]['Age']) <= 5) {
                    $eachPercent += Age::calculate();
                }

                /* Check Timezone */
                if ($data[$i]['Timezone'] == $data[$j]['Timezone']) {
                    $eachPercent += Timezone::calculate();
                }

                /**
                 * Compare current Percent with Max Percent
                 * If Current is bigger then set it as MAX, remove $matches[$i] element and set a new elm
                 */
                if ($maxPercent < $eachPercent) {
                    $maxPercent = $eachPercent;
                    unset(self::$matches[$i]);
                    self::$matches[$i][$j] = $eachPercent;

                    /* Check If user ID exist on array. If yes compare and remove smaller one */
                    foreach (self::$matches as $key => $each) {
                        if (array_key_exists($i, $each)) {
                            if ($eachPercent < $each[array_key_first($each)]) {
                                unset(self::$matches[$i]);
                            } else {
                                unset(self::$matches[$key]);
                            }
                        }
                    }
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
        $sumPercent = 0;
        if(!empty(self::$matches)){
            foreach (self::$matches as $key => $value) {
                $sumPercent += $value[array_key_first($value)];
                array_push(self::$recommendation['users'], ['users' => $data[$key]['Name'] . ' - ' . $data[array_key_first($value)]['Name'], 'percent' => $value[array_key_first($value)] . ' %']);
            }
            self::$recommendation['total'] = $sumPercent / count(self::$matches) . ' %';
        }else{
            self::$recommendation['total'] = 0 . ' %';
        }
    }
}
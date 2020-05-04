<?php
/**
 * Created by PhpStorm.
 * User: ThinkPad
 * Date: 2020/05/04
 * Time: 15:14
 */

class solution {


    /**
     * @param Integer[] $nums
     * @return Integer
     */
    function jump($nums) {
        $size = count($nums);
        if($size == 1) return 0;
        $reach = 0;
        $nextreach = $nums[0];
        $step = 0;

        for($i = 0; $i < $size; $i++) {
            $nextreach = max($i + $nums[$i], $nextreach);
            if($nextreach >= $size - 1) return $step + 1;
            if($i == $reach) {
                $step++;
                $reach = $nextreach;
            }
        }
        return $step;
    }
}


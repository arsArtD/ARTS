<?php
/**
 * Created by PhpStorm.
 * User: ThinkPad
 * Date: 2020/4/19
 * Time: 22:40
 */

class BaoliSolution {

    /**
     * 暴力破解, 该方法在参数很长时会有问题
     * @param String $s1
     * @param Integer $n1
     * @param String $s2
     * @param Integer $n2
     * @return Integer
     */
    function getMaxRepetitions($s1, $n1, $s2, $n2) {
        if($n1 === 0)
            return 0;
        $index = 0;
        $s2cnt = 0;
        $S1 = str_repeat($s1, $n1);
        $S2 = str_repeat($s2, $n2);
        $S1Len = strlen($S1);
        $S2Len = strlen($S2);

        for($i = 0; $i < $S1Len; $i++) {
            if($S1[$i] === $S2[$index]) {
                $index++;
                if($index === $S2Len) {
                    $s2cnt++;
                    $index = 0;
                }
            }
        }
        return $s2cnt;
    }
}


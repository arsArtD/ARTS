<?php
/**
 * Created by PhpStorm.
 * User: ThinkPad
 * Date: 2020/3/15
 * Time: 22:40
 */
class Solution {

    /**
     * @param String $num1
     * @param String $num2
     * @return String
     */
    function multiply($num1, $num2) {

        /**
        num1的第i位(高位从0开始)和num2的第j位相乘的结果在乘积中的位置是[i+j, i+j+1]
        例: 123 * 45,  123的第1位 2 和45的第0位 4 乘积 08 存放在结果的第[1, 2]位中
        index:    0 1 2 3 4

            1 2 3
         *    4 5
        ---------
              1 5
            1 0
          0 5
        ---------
          0 6 1 5
            1 2
          0 8
        0 4
        ---------
        0 5 5 3 5
        这样我们就可以单独都对每一位进行相乘计算把结果存入相应的index中
         **/

        $n1 = strlen($num1) -1;
        $n2 = strlen($num2) -1;
        if($n1 < 0 || $n2 < 0) return "";

        $mul = [];
        for($i = $n1; $i >= 0; $i--) {
            for($j = $n2; $j >= 0; $j--) {
                $bitmul = ($num1[$i]) * ($num2[$j]);
                $bitmul += $mul[$i + $j + 1]; // 先加低位判断是否有新的进位

                $mul[$i + $j] += floor($bitmul / 10);
                $mul[$i + $j + 1] = $bitmul % 10;
            }
        }
        // 去掉前导0
        $i = 0;
        while($i < count($mul) -  1 && $mul[$i] == 0) {
            $i++;
        }
        $sb = '';
        for(;$i < count($mul); $i++) {
            $sb .= $mul[$i];
        }
        return $sb;
    }
}

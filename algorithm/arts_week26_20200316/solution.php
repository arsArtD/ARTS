<?php
/**
 * Created by PhpStorm.
 * User: ThinkPad
 * Date: 2020/4/6
 * Time: 17:34
 */

class solution {

    /*
     * 问题1：如果 word1[0..i-1] 到 word2[0..j-1] 的变换需要消耗 k 步，那 word1[0..i] 到 word2[0..j] 的变换需要几步呢？

答：先使用 k 步，把 word1[0..i-1] 变换到 word2[0..j-1]，消耗 k 步。再把 word1[i] 改成 word2[j]，就行了。如果 word1[i] == word2[j]，什么也不用做，一共消耗 k 步，否则需要修改，一共消耗 k + 1 步。

问题2：如果 word1[0..i-1] 到 word2[0..j] 的变换需要消耗 k 步，那 word1[0..i] 到 word2[0..j] 的变换需要消耗几步呢？

答：先经过 k 步，把 word1[0..i-1] 变换到 word2[0..j]，消耗掉 k 步，再把 word1[i] 删除，这样，word1[0..i] 就完全变成了 word2[0..j] 了。一共 k + 1 步。

问题3：如果 word1[0..i] 到 word2[0..j-1] 的变换需要消耗 k 步，那 word1[0..i] 到 word2[0..j] 的变换需要消耗几步呢？

答：先经过 k 步，把 word1[0..i] 变换成 word2[0..j-1]，消耗掉 k 步，接下来，再插入一个字符 word2[j], word1[0..i] 就完全变成了 word2[0..j] 了。

从上面三个问题来看，word1[0..i] 变换成 word2[0..j] 主要有三种手段，用哪个消耗少，就用哪个。
     */


    /**
     * @param String $word1
     * @param String $word2
     * @return Integer
     */
    function minDistance($word1, $word2) {
        $m = strlen($word1);
        $n = strlen($word2);

        $cost = [];

        for($i = 0; $i <= $m; $i++) {
            $cost[$i][0] = $i;
        }
        for($j = 0; $j <= $n; $j++) {
            $cost[0][$j] = $j;
        }
        //print_r($cost);exit;
        for($i = 1; $i <= $m; $i++) {
            for($j = 1; $j <= $n; $j++) {
                if($word1[$i-1] == $word2[$j-1]) {
                    $cost[$i][$j] = $cost[$i-1][$j-1];
                } else {
                    $cost[$i][$j]  = 1 + min($cost[$i-1][$j-1], $cost[$i][$j-1], $cost[$i-1][$j]);
                }
            }
        }
        return $cost[$m][$n];
    }

}


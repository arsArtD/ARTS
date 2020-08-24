<?php
/**
 * Created by PhpStorm.
 * User: ThinkPad
 * Date: 2020/8/14
 * Time: 8:43
 */

class Solution
{


    //@ref: https://leetcode-cn.com/problems/subsets/solution/php-liang-chong-jie-fa-die-dai-he-di-gui-by-zzpwes/
    //@ref: https://leetcode-cn.com/problems/subsets/solution/zi-ji-by-leetcode/
    //@ref: https://leetcode-cn.com/problems/subsets/solution/php-jie-fa-liang-chong-hui-su-jie-fa-by-andfly/


    /**
     * 递归
     * @param Integer[] $nums
     * @return Integer[][]
     */
    function subsets($nums) {
        $result = [[]];
        foreach($nums as $num) {
            foreach($result as $item) {
                $tmp = $item;
                $tmp[] = $num;
                $result[] = $tmp;
            }
        }
        return $result;
    }


    /**
     * 递归(分治)
     * @param Integer[] $nums
     * @return Integer[][]
     */
    function subsets1($nums) {
        $result = [];
        $this->subsets1_helpler($nums, 0, [], $result);
        return $result;
    }

    private function subsets1_helpler($nums, $index, $current, &$result) {
        if($index == count($nums)) {
            $result[] = $current;
            return;
        }
        $this->subsets1_helpler($nums, $index+1, $current,$result);
        $current[] = $nums[$index];
        $this->subsets1_helpler($nums, $index+1, $current,$result);
    }


}

//$s = new Solution();
//$result = $s->subsets1([1,2,3]);
//var_dump($result);

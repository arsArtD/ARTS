<?php
/**
 * Created by PhpStorm.
 * User: ThinkPad
 * Date: 2020/12/10
 * Time: 9:02
 */

class Solution
{
    /**
     * @ref https://leetcode-cn.com/problems/permutations/solution/php-hui-su-suan-fa-by-zzpwestlife/
     * 回溯法
     * @param Integer[] $nums
     * @return Integer[][]
     */
    function permute($nums)
    {
        $result = [];
        $count = count($nums);
        if($count == 0) return $result;
        $this->dfs($nums, 0 , [], $result);
        return $result;
    }

    private function dfs($nums, $depth, $path, &$result)
    {
        // terminator
        if ($depth == count($nums)) {
            $result[] = $path;
            return;
        }

        $len = count($nums);
        for ($i = 0; $i < $len; $i++) {
            if (in_array($nums[$i], $path)) continue;
            $path[] = $nums[$i];
            $this->dfs($nums, $depth + 1, $path, $result);
            // 回溯，恢复状态
            array_pop($path);
        }
    }


    /**
     * @ref https://leetcode-cn.com/problems/permutations/solution/quan-pai-lie-by-leetcode-solution-2/
     * @ref https://leetcode-cn.com/problems/permutations/solution/php-hui-su-suan-fa-by-zzpwestlife/
     * @param $nums
     * @return array
     */
    function permute2($nums)
    {
        $n = count($nums);

        $ans = [];

        $this->helper($nums, 0, $n-1, $ans);

        //print_r($ans);

        return $ans;
    }

    // 返回 nums{p,,,q}的全排列
    private function helper($nums, $p, $q, &$result)
    {
        if($p == $q) {
            $result[] = $nums;
        }

        for($i = $p; $i <= $q; $i++) {
            //echo sprintf('p: %s, q:%s, i:%s, nums:%s'.PHP_EOL, $p, $q, $i, json_encode($nums));
            $nums = $this->swap($nums, $p, $i);
            $this->helper($nums, $p+1, $q, $result);
            $nums = $this->swap($nums, $p, $i);
        }
    }

    private function swap($nums, $i, $j)
    {
        $tmp = $nums[$i];
        $nums[$i] = $nums[$j];
        $nums[$j] = $tmp;
        return $nums;
    }

    function permute3(array $nums) {

        $res = [];
        $output = $nums;
        $n = count($nums);
        $this->backtrace($n, $output, $res, 0);
        return $res;
    }

    private function backtrace($n, $output, &$res, $first) {

        if($first == $n) {
            $res[] = $output;
        }

        for($i = $first; $i < $n; $i++) {
            echo sprintf('first:%s, i:%s, nums:%s'.PHP_EOL, $first, $i, json_encode($output));
            $this->swap2($output, $first, $i);
            $this->backtrace($n, $output, $res, $first+1);
            $this->swap2($output, $first, $i);
        }
    }

    private function swap2(&$nums, $i, $j)
    {
        $tmp = $nums[$i];
        $nums[$i] = $nums[$j];
        $nums[$j] = $tmp;
    }
}

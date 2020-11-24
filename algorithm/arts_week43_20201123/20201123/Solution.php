<?php
/**
 * Created by PhpStorm.
 * User: ThinkPad
 * Date: 2020/11/23
 * Time: 9:06
 */

class Solution
{
    /**
     * @param Integer[] $nums1
     * @param Integer $m
     * @param Integer[] $nums2
     * @param Integer $n
     * @return
     */
    function merge(&$nums1, $m, $nums2, $n) {
        foreach($nums2 as $n2Index => $n2Value) {
            $nums1[$m + $n2Index] = $n2Value;
        }
        sort($nums1);
        return $nums1;
    }

    /**
     * @param $nums1
     * @param $m
     * @param $nums2
     * @param $n
     * 时间复杂度： O(n+m)
     * 空间复杂度： O(m)
     * @return
     */
    function merge2(&$nums1, $m, $nums2, $n) {
        $nums1_copy = $nums1;

        $p1 = 0;
        $p2 = 0;
        $p = 0;

        while($p1 < $m && $p2 < $n) {
            if($nums1_copy[$p1] < $nums2[$p2]) {
                $nums1[$p] = $nums1_copy[$p1];
                $p1++;
            } else {
                $nums1[$p] = $nums2[$p2];
                $p2++;
            }
            $p++;
        }

        if($p1 < $m) {
            $this->my_arrayCopy($nums1_copy, $p1, $nums1, $p1+$p2, $m+$n-($p1+$p2));
        }
        if($p2 < $n) {
            $this->my_arrayCopy($nums2, $p2, $nums1, $p1+$p2, $m+$n-($p1+$p2));
        }
        return $nums1;
    }

    /**
     * @param $nums1    from数组
     * @param $p1       from数组起始复制文职
     * @param $nums2    to数组
     * @param $m        to数组起始覆写位置
     * @param $n        to数组覆写长度
     * @return mixed
     */
    public function my_arrayCopy($nums1, $p1, &$nums2, $m, $n) {
        $n1Slice = array_slice($nums1, $p1);
        foreach($n1Slice as $n1sIndex => $n1sValue) {
            if($n1sIndex < $n) {
                $nums2[$m + $n1sIndex] = $n1sValue;
            }
        }
        return $nums2;
    }

    public function merge3(&$nums1, $m, $nums2, $n) {
        $p1 = $m-1;
        $p2 = $n-1;

        $p = $m+$n-1;

        while($p1 >=0 && $p2 >=0) {
            if($nums2[$p2] > $nums1[$p1]) {
                $nums1[$p] = $nums2[$p2];
                $p2--;
            } else {
                $nums1[$p] = $nums1[$p1];
                $p1--;
            }
            $p--;
        }

        $this->my_arrayCopy($nums2, 0, $nums1, 0, $p2+1);

        return $nums1;
    }


}

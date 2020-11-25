<?php
/**
 * Created by PhpStorm.
 * User: ThinkPad
 * Date: 2020/11/25
 * Time: 8:55
 */

class Solution
{
    /**
     * @refer: https://leetcode-cn.com/problems/longest-common-prefix/solution/zui-chang-gong-gong-qian-zhui-by-leetcode-solution/
     * 横向扫描:  LCP(a,b,c,d)=LCP(LCP(LCP(a,b),c),d)
     * 时间复杂度：O(mn) m-字符串数组中字符串的平均长度，n--字符串的数量
     * 空间复杂度：O(1)
     * @param String[] $strs
     * @return String
     */
    function longestCommonPrefix($strs) {
        if(!is_array($strs) || count($strs) == 0)  return  '';

        $prefix = $strs[0];
        $count = count($strs);
        for($i = 0; $i < $count; $i++) {
            $prefix = $this->getlongestCommonPrefixForTwo($prefix, $strs[$i]);
            if(strlen($prefix) == 0) {
                break;
            }
        }
        return $prefix;
    }

    private function getlongestCommonPrefixForTwo(String $s1, String $s2) {
        $len = min(strlen($s1), strlen($s2));
        $index = 0;
        while($index < $len && $s1{$index} == $s2{$index}) {
            $index++;
        }
        return substr($s1, 0, $index);
    }

    /**
     * 纵向扫描: 相对最直观最容易想到的方法
     * 时间复杂度：O(mn) m-字符串数组中字符串的平均长度，n--字符串的数量
     * 空间复杂度：O(1)
     * @param $strs
     * @return bool|mixed|string
     */
    function longestCommonPrefix2($strs) {
        if(!is_array($strs) || count($strs) == 0)  return  '';

        $length = strlen($strs[0]);
        $count = count($strs);
        for($i = 0; $i < $length; $i++) {
            $c = $strs[0]{$i};
            for($j = 1; $j < $count; $j++) {
                if($i == strlen($strs[$j]) || $strs[$j]{$i} != $c) {
                    return substr($strs[0], 0, $i);
                }
            }
        }

        return $strs[0];
    }

    /**
     * 分治
     * 时间复杂度：O(mn) m-字符串数组中字符串的平均长度，n--字符串的数量 T(n) = 2T(n/2) + O(m)
     * 空间复杂度：O(mlogn) 层数最大为logn，每层需要 m 的空间存储返回结果。
     * @param $strs
     * @return bool|mixed|string
     */
    function longestCommonPrefix3($strs) {
        if(!is_array($strs) || count($strs) == 0)  return  '';

        return $this->getlongestCommonPrefixForFenzhi($strs, 0, count($strs) - 1);
    }

    private function getlongestCommonPrefixForFenzhi(array $strs, int $start, int $end) {
        if($start == $end) {
            return $strs[$start];
        } else {
            $mid = floor(($end - $start) /2) + $start;
            $lcpLeft = $this->getlongestCommonPrefixForFenzhi($strs, $start, $mid);
            $lcpend = $this->getlongestCommonPrefixForFenzhi($strs, $mid + 1, $end);
            return $this->commonPrefixForFenzhi($lcpLeft, $lcpend);
        }
    }

    private function commonPrefixForFenzhi(string $lcpleft, string $lcpright) {
        $midLen = min(strlen($lcpleft), strlen($lcpright));
        for($i = 0; $i < $midLen; $i++) {
            if($lcpleft{$i} != $lcpright{$i}) {
                return substr($lcpleft, 0, $i);
            }
        }
        return substr($lcpleft, 0, $midLen);
    }

    /**
     * 二分法
     * 时间复杂度： O(mnlogm)   m-字符串数组中字符串的平均长度，n--字符串的数量
     * 二分查找的迭代执行次数是 )O(logm)，每次迭代最多需要比较 mn 个字符，因此总时间复杂度是 O(mnlogm)
     * 空间复杂度： O(1)
     * @param $strs
     * @return bool|string
     */
    function longestCommonPrefix4($strs) {
        if(!is_array($strs) || count($strs) == 0)  return  '';

        $strlenArr = [];
        foreach($strs as $str) {
            $strlenArr[] = strlen($str);
        }
        // 获取到字符串数组中长度最短的字符串的长度
        $minlen = min($strlenArr);
        $low = 0;
        $high = $minlen;
        while($low < $high) {
            $mid = floor(($high - $low + 1) /2) + $low;
            if($this->isCommonPrefixForErfen($strs, $mid)) {
                $low = $mid;
            } else {
                $high = $mid - 1;
            }
        }
        return substr($strs[0], 0, $low);
    }

    private function isCommonPrefixForErfen(array $strs, int $length) {
        $str0 = substr($strs[0], 0, $length);
        $count = count($strs);
        for($i = 1; $i < $count; $i++) {
            $str = $strs[$i];
            for($j = 0; $j < $length; $j++) {
                if($str0{$j} != $str{$j}) {
                    return false;
                }
            }
        }
        return true;
    }
}

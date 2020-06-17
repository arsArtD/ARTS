<?php
/**
 * Created by PhpStorm.
 * User: ThinkPad
 * Date: 2020/6/9
 * Time: 9:35
 */


//@TODO: 使用DP或者DFS进行处理
class Solution
{
    /**
     * @param Integer $num
     * @return Integer
     */
    function translateNum($num) {
        if($num < 9) return 1;
        //获取输入数字的余数，然后递归的计算翻译方法
        $ba = $num % 100;
        //如果大于9或者大于26的时候，余数不能按照2位数字组合，比如56，只能拆分为5和6；反例25，可以拆分为2和5，也可以作为25一个整体进行翻译。
        if($ba <= 9 || $ba >= 26) return $this->translateNum($num/10);
        return $this->translateNum($num/10) + $this->translateNum($num/100);
    }
}

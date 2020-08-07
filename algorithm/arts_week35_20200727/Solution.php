<?php
/**
 * Created by PhpStorm.
 * User: ThinkPad
 * Date: 2020/8/4
 * Time: 9:43
 */

class Solution
{

    /**  镜像反射法：https://leetcode-cn.com/problems/gray-code/solution/gray-code-jing-xiang-fan-she-fa-by-jyd/
    设 nn 阶格雷码集合为 G(n)G(n)，则 G(n+1)G(n+1) 阶格雷码为：
    给 G(n)G(n) 阶格雷码每个元素二进制形式前面添加 00，得到 G'(n)G
    ′
    (n)；
    设 G(n)G(n) 集合倒序（镜像）为 R(n)R(n)，给 R(n)R(n) 每个元素二进制形式前面添加 11，得到 R'(n)R
    ′
    (n)；
    G(n+1) = G'(n) ∪ R'(n)G(n+1)=G
    ′
    (n)∪R
    ′
    (n) 拼接两个集合即可得到下一阶格雷码。
    根据以上规律，可从 00 阶格雷码推导致任何阶格雷码。
    代码解析：
    由于最高位前默认为 00，因此 G'(n) = G(n)G
    ′
    (n)=G(n)，只需在 res(即 G(n)G(n) )后添加 R'(n)R
    ′
    (n) 即可；
    计算 R'(n)R
    ′
    (n)：执行 head = 1 << i 计算出对应位数，以给 R(n)R(n) 前添加 11 得到对应 R'(n)R
    ′
    (n)；
    倒序遍历 res(即 G(n)G(n) )：依次求得 R'(n)R
    ′
    (n) 各元素添加至 res 尾端，遍历完成后 res(即 G(n+1)G(n+1))。

    作者：jyd
    链接：https://leetcode-cn.com/problems/gray-code/solution/gray-code-jing-xiang-fan-she-fa-by-jyd/
    来源：力扣（LeetCode）
    著作权归作者所有。商业转载请联系作者获得授权，非商业转载请注明出处。
     * @param Integer $n
     * @return Integer[]
     */
    function grayCode($n) {
        $res = [0];
        $head = 1;
        for($i = 0; $i < $n; $i++) {
            for($j  = count($res) -1; $j >= 0; $j--) {
                $res[] = $head + $res[$j];
            }
            $head <<= 1;
        }
        return $res;
    }

}

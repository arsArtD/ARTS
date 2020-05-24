<?php
/**
 * Created by PhpStorm.
 * User: ThinkPad
 * Date: 2020/5/24
 * Time: 21:05
 */

class solution
{

    /*
     * 这道题让我们求两个有序数组的中位数，而且限制了时间复杂度为O(log (m+n))，看到这个时间复杂度，自然而然的想到了应该使用二分查找法来求解。
     * 那么回顾一下中位数的定义，如果某个有序数组长度是奇数，那么其中位数就是最中间那个，如果是偶数，那么就是最中间两个数字的平均值。
     * 这里对于两个有序数组也是一样的，假设两个有序数组的长度分别为m和n，由于两个数组长度之和 m+n 的奇偶不确定，因此需要分情况来讨论，
     * 对于奇数的情况，直接找到最中间的数即可，偶数的话需要求最中间两个数的平均值。为了简化代码，不分情况讨论，我们使用一个小trick，
     * 我们分别找第 (m+n+1) / 2 个，和 (m+n+2) / 2 个，然后求其平均值即可，这对奇偶数均适用。加入 m+n 为奇数的话，
     * 那么其实 (m+n+1) / 2 和 (m+n+2) / 2 的值相等，相当于两个相同的数字相加再除以2，还是其本身。

    这里我们需要定义一个函数来在两个有序数组中找到第K个元素，下面重点来看如何实现找到第K个元素。
    首先，为了避免产生新的数组从而增加时间复杂度，我们使用两个变量i和j分别来标记数组nums1和nums2的起始位置。然后来处理一些边界问题，
    比如当某一个数组的起始位置大于等于其数组长度时，说明其所有数字均已经被淘汰了，相当于一个空数组了，那么实际上就变成了在另一个数组中找数字，
    直接就可以找出来了。还有就是如果K=1的话，那么我们只要比较nums1和nums2的起始位置i和j上的数字就可以了。难点就在于一般的情况怎么处理？
    因为我们需要在两个有序数组中找到第K个元素，为了加快搜索的速度，我们要使用二分法，对K二分，意思是我们需要分别在nums1和nums2中查找第K/2个元素，
    注意这里由于两个数组的长度不定，所以有可能某个数组没有第K/2个数字，所以我们需要先检查一下，数组中到底存不存在第K/2个数字，如果存在就取出来，否
    则就赋值上一个整型最大值。如果某个数组没有第K/2个数字，那么我们就淘汰另一个数字的前K/2个数字即可。有没有可能两个数组都不存在第K/2个数字呢，
    这道题里是不可能的，因为我们的K不是任意给的，而是给的m+n的中间值，所以必定至少会有一个数组是存在第K/2个数字的。最后就是二分法的核心啦，
    比较这两个数组的第K/2小的数字midVal1和midVal2的大小，如果第一个数组的第K/2个数字小的话，那么说明我们要找的数字肯定不在nums1中的前K/2个数字，
    所以我们可以将其淘汰，将nums1的起始位置向后移动K/2个，并且此时的K也自减去K/2，调用递归。反之，我们淘汰nums2中的前K/2个数字，
    并将nums2的起始位置向后移动K/2个，并且此时的K也自减去K/2，调用递归即可。
     */

    /**
     * @param Integer[] $nums1
     * @param Integer[] $nums2
     * @return Float
     */
    function findMedianSortedArrays($nums1, $nums2) {
        $nums1Len = count($nums1);
        $nums2Len = count($nums2);
        $left = floor(($nums1Len + $nums2Len + 1) / 2);
        $right = ceil(($nums1Len + $nums2Len + 1) / 2);
        return round(($this->findKth($nums1, 0, $nums2, 0, $left) + $this->findKth($nums1, 0, $nums2, 0, $right)) / 2, 1);
    }

    /**
     * @param $nums1
     * @param $i           nums1的起始位置
     * @param $nums2
     * @param $j           nums2的起始位置
     * @param $k
     * @return mixed
     */
    public function findKth($nums1, $i, $nums2, $j, $k) {
        $nums1Len = count($nums1);
        $nums2Len = count($nums2);
        if($i >= $nums1Len) return $nums2[$j + $k -1];
        if($j >= $nums2Len) return $nums1[$i+ $k -1];
        if($k == 1) {
            return min($nums1[$i], $nums2[$j]);
        }
        $midVal1 = ($i + floor($k/2) -1 < $nums1Len) ? $nums1[$i + floor($k/2) -1] : PHP_INT_MAX;
        $midVal2 = ($j + floor($k/2) -1 < $nums2Len) ? $nums2[$j + floor($k/2) -1] : PHP_INT_MAX;
        if($midVal1 < $midVal2) {
            return $this->findKth($nums1, $i + floor($k/2), $nums2, $j, $k - floor($k/2));
        } else {
            return $this->findKth($nums1, $i, $nums2, $j + floor($k/2), $k - floor($k/2));
        }
    }
}

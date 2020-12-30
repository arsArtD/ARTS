<?php
/**
 * Created by PhpStorm.
 * User: ThinkPad
 * Date: 2020/12/29
 * Time: 11:38
 */

class Solution
{
    /**
     * @param Integer[] $nums
     * 快排,静态数据推荐
     * @ref https://leetcode-cn.com/problems/kth-largest-element-in-an-array/solution/shu-zu-zhong-de-di-kge-zui-da-yuan-su-by-leetcode-/
     * @param Integer $k
     * 时间复杂度：O(n)
     * 空间复杂度： O(logn)
     * @return Integer
     */
    function findKthLargest(array $nums, int $k) {
        return $this->quickSelect($nums, 0, count($nums) - 1, count($nums) - $k);
    }

    private function quickSelect(array $arr, int $left, int $right, int $index) {
        $q = $this->randomPartition($arr, $left, $right);
        if($q == $index) {
            return $arr[$q];
        } else {
            return $q < $index ? $this->quickSelect($arr, $q + 1, $right, $index) : $this->quickSelect($arr, $left, $q -1, $index);
        }
    }

    private function randomPartition(array &$arr, int $left, int $right) {
        //$i = random_int(PHP_INT_MIN,PHP_INT_MAX) % ($right - $left + 1) + $left;
        $i = rand() % ($right - $left + 1) + $left;
        $this->swap($arr, $i, $right);
        return $this->partition($arr, $left, $right);
    }

    private function partition(array &$arr, int $left, int $right) {
        $x = $arr[$right];
        $i = $left - 1;
        for($j = $left; $j < $right; $j++) {
            if($arr[$j] <= $x) {
                $this->swap($arr, ++$i, $j);
            }
        }
        $this->swap($arr, $i+1, $right);
        return $i + 1;
    }


    /**
     * @ref https://leetcode-cn.com/problems/kth-largest-element-in-an-array/solution/shu-zu-zhong-de-di-kge-zui-da-yuan-su-by-leetcode-/
     * 大顶堆
     * @param array $nums
     * @param int $k
     * @return mixed
     */
    function findKthLargest1(array $nums, int $k) {
        $heapSize = count($nums);
        $this->buildMaxHeap($nums, $heapSize);
        for($i = count($nums) -1; $i >= count($nums) -$k +1; $i--) {
            $this->swap($nums, 0, $i);
            --$heapSize;
            $this->maxHeapify($nums, 0, $heapSize);
        }
        return $nums[0];
    }

    private function buildMaxHeap(array &$arr, int $heapSize) {
        for($i = $heapSize >> 2; $i >= 0; --$i) {
            $this->maxHeapify($arr, $i, $heapSize);
        }
    }

    private function maxHeapify(array &$arr, int $i, int $heapSize) {
        $left = $i * 2 + 1;
        $right = $i * 2 + 2;
        $largest = $i;
        if($left < $heapSize && $arr[$left] > $arr[$largest]) {
            $largest = $left;
        }
        if($right < $heapSize && $arr[$right] > $arr[$largest]) {
            $largest = $right;
        }
        if($largest != $i) {
            $this->swap($arr, $i, $largest);
            $this->maxHeapify($arr, $largest, $heapSize);
        }
    }


    public function swap(array &$arr, int $i, int $j) {
        $temp = $arr[$i];
        $arr[$i] = $arr[$j];
        $arr[$j] = $temp;
    }

    /**
     * 调用系统的堆函数, 动态数组推荐
     * @ref https://leetcode-cn.com/problems/kth-largest-element-in-an-array/solution/php-bao-li-pai-xu-jie-fa-zui-xiao-dui-jie-fa-by-zz/
     * @param array $nums
     * @param int $k
     * @return mixed
     */
    function findKthLargest2(array $nums, int $k) {
        $heapSize = count($nums);
        $heap = new SplMinHeap();

        for($i = 0; $i < $heapSize; ++$i) {
            if($heap->count() < $k) {
                $heap->insert($nums[$i]);
            } elseif($heap->top() < $nums[$i]) {
                $heap->extract();
                $heap->insert($nums[$i]);
            }
        }

        return $heap->top();
    }

    function findKthLargest3(array $nums, int $k) {
        rsort($nums);
        return $nums[$k - 1];
    }
}

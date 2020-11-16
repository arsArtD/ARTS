<?php
/**
 * Created by PhpStorm.
 * User: ThinkPad
 * Date: 2020/11/11
 * Time: 8:42
 */


class Status {
    public $lSum;  // 表示 [l, r] 内以 l 为左端点的最大子段和
    public $rSum;  // 表示 [l, r] 内以 r 为右端点的最大子段和
    public $mSum;  // 表示 [l, r] 内的最大子段和
    public $iSum;  // 表示 [l, r] 的区间和

    public function __construct(int $lsum, int $rsum, int $msum, int $isum)
    {
        $this->lSum = $lsum;
        $this->rSum = $rsum;
        $this->mSum = $msum;
        $this->iSum = $isum;
        echo sprintf('lsum:%s, rsum: %s, msum: %s, isum: %s'.PHP_EOL,
            $this->lSum, $this->rSum, $this->mSum, $this->iSum);
    }

    public function __toString() {
        return sprintf('lsum:%s, rsum: %s, msum: %s, isum: %s'.PHP_EOL,
            $this->lSum, $this->rSum, $this->mSum, $this->iSum);
    }
}

class Solution1
{

    /**
     * @ref https://leetcode-cn.com/problems/maximum-subarray/solution/zui-da-zi-xu-he-by-leetcode-solution/
     * 分治  线段树
     * @param Integer[] $nums
     * @return Integer
     */
    function maxSubArray($nums) {
        $status = $this->getInfo($nums, 0, count($nums)-1);
        return $status->mSum;
    }

    public function getInfo(array $nums, int $left, int $right) {
        if($left === $right) {
            echo sprintf('curr left: %s, curr right: %s'.PHP_EOL, $left, $right);
            return new Status($nums[$left], $nums[$left], $nums[$left], $nums[$left]);
        }
        $m = ($left + $right) >> 1;
        $lSub = $this->getInfo($nums, $left, $m);
        $rSub = $this->getInfo($nums, $m+1, $right);
        echo sprintf('recored get curr result========: curr left: %s, left result: %s'.PHP_EOL, $left, $lSub);
        echo sprintf('recored get curr result========: curr right: %s, right result: %s'.PHP_EOL, $right, $rSub);
        return $this->pushUp($lSub, $rSub);
    }

    public function pushUp(Status $lSub, Status $rSub) {
        echo sprintf('sum: %s %s, %s, %s'.PHP_EOL, $lSub->lSum, $rSub->mSum, $lSub->rSum, $rSub->lSum);
        $isum = $lSub->iSum + $rSub->iSum;
        $lsum = max($lSub->lSum, $lSub->iSum + $rSub->lSum);
        $rsum = max($rSub->rSum, $rSub->iSum + $lSub->rSum);
        $msum = max(max($lSub->mSum, $rSub->mSum), $lSub->rSum+$rSub->lSum);
        //echo sprintf('lsum: %s, %s, %s'.PHP_EOL, $lSub->lSum, $lSub->iSum, $rSub->lSum);
//        if($lsum == -1 && $rsum == -2) {
//            echo sprintf('get it=================sum: %s %s, %s, %s'.PHP_EOL, $lSub->lSum, $rSub->mSum, $lSub->rSum, $rSub->lSum);
//        }
        return new Status($lsum, $rsum, $msum, $isum);
    }
}

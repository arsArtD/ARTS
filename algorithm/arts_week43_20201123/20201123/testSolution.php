<?php
/**
 * Created by PhpStorm.
 * User: ThinkPad
 * Date: 2020/11/23
 * Time: 9:08
 */

require_once '../../../vendor/autoload.php';
require_once 'Solution.php';
use PHPUnit\Framework\TestCase;

class testSolution extends TestCase
{
    private $cls;
    private $cls1;

    public function __construct()
    {
        $this->cls = new Solution();
    }

    function testMergeHandler() {
        $nums1 = [1,2,3,0,0,0];
        $nums2 = [4,2,6];
        $this->cls->merge2_arrayCopy($nums2, 1, $nums1,3, 1);
        self::assertEquals(json_encode([1,2,3,2,0,0]),json_encode($nums1));
        $this->cls->merge2_arrayCopy($nums2, 0, $nums1,3, 3);
        self::assertEquals(json_encode([1,2,3,4,2,6]),json_encode($nums1));
    }

    function test1()
    {
        $nums1 = [1,2,3,0,0,0];
        $nums2 = [2,5,6];
        $result = $this->cls->merge($nums1, 3, $nums2, count($nums2));
        self::assertEquals(json_encode([1,2,2,3,5,6]), json_encode($result));
    }

    function test2() {
        $nums1 = [1,2,3,0,0,0];
        $nums2 = [2,5,6];
        $result = $this->cls->merge2($nums1, 3, $nums2, count($nums2));
        self::assertEquals(json_encode([1,2,2,3,5,6]), json_encode($result));
    }

    function test3() {
        $nums1 = [1,2,3,0,0,0];
        $nums2 = [2,5,6];
        $result = $this->cls->merge3($nums1, 3, $nums2, count($nums2));
        self::assertEquals(json_encode([1,2,2,3,5,6]), json_encode($result));
    }
}

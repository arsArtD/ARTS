<?php
/**
 * Created by PhpStorm.
 * User: ThinkPad
 * Date: 2020/12/29
 * Time: 11:38
 */

require_once '../../../vendor/autoload.php';
require_once 'Solution.php';
use PHPUnit\Framework\TestCase;

class testSolution extends TestCase
{
    private $cls;

    public function __construct()
    {
        $this->cls = new Solution();
    }

    function test() {

        self::assertEquals(5,  $this->cls->findKthLargest([3,2,1,5,6,4], 2));

        self::assertEquals(4,  $this->cls->findKthLargest([3,2,3,1,2,4,5,5,6], 4));
    }

    function test1() {

        self::assertEquals(5,  $this->cls->findKthLargest1([3,2,1,5,6,4], 2));

        self::assertEquals(4,  $this->cls->findKthLargest1([3,2,3,1,2,4,5,5,6], 4));
    }

    function test2() {
        self::assertEquals(5,  $this->cls->findKthLargest2([3,2,1,5,6,4], 2));

        self::assertEquals(4,  $this->cls->findKthLargest2([3,2,3,1,2,4,5,5,6], 4));

    }

    function test3() {
        self::assertEquals(5,  $this->cls->findKthLargest3([3,2,1,5,6,4], 2));

        self::assertEquals(4,  $this->cls->findKthLargest3([3,2,3,1,2,4,5,5,6], 4));
    }


}

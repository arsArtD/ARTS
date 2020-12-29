<?php
/**
 * Created by PhpStorm.
 * User: ThinkPad
 * Date: 2020/12/28
 * Time: 12:21
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

        self::assertEquals(49,  $this->cls->maxArea([1,8,6,2,5,4,8,3,7]));

        self::assertEquals(1,  $this->cls->maxArea([1,1]));

        self::assertEquals(16,  $this->cls->maxArea([4,3,2,1,4]));

        self::assertEquals(2,  $this->cls->maxArea([1,2,1]));
    }
}

<?php
/**
 * Created by PhpStorm.
 * User: ThinkPad
 * Date: 2020/12/25
 * Time: 12:11
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

        self::assertEquals(json_encode([24, 12, 8, 6]),  json_encode($this->cls->productExceptSelf([1,2,3,4])));

        self::assertEquals(json_encode([24, 12, 8, 6]),  json_encode($this->cls->productExceptSelf1([1,2,3,4])));

    }


}

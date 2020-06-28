<?php
/**
 * Created by PhpStorm.
 * User: ThinkPad
 * Date: 2020/6/28
 * Time: 9:54
 */

require_once '../../vendor/autoload.php';
require_once 'solution.php';
use PHPUnit\Framework\TestCase;

class testSolution extends TestCase
{
    private $cls;
    private $cls2;

    public function __construct()
    {
        $this->cls = new Solution();
    }

    function test1()
    {
        // [1,2,5,3,4,6,7]
        $result = $this->cls->recoverFromPreorder("1-2--3--4-5--6--7");
        $this->assertEquals(1, $result->val);
        $this->assertEquals(2, $result->left->val);
        $this->assertEquals(5, $result->right->val);
        $this->assertEquals(3, $result->left->left->val);
        $this->assertEquals(4, $result->left->right->val);
        $this->assertEquals(6, $result->right->left->val);
        $this->assertEquals(7, $result->right->right->val);
    }
}

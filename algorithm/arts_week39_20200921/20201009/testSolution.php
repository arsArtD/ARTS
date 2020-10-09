<?php
/**
 * Created by PhpStorm.
 * User: ThinkPad
 * Date: 2020/10/09
 * Time: 9:09
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

    function test1()
    {
        $num = 4;
        $rs = $this->cls->canWinNim($num);
        $this->assertEquals(false, $rs);
    }

}

<?php
/**
 * Created by PhpStorm.
 * User: ThinkPad
 * Date: 2020/8/14
 * Time: 9:05
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
        $result = $this->cls->subsets([1,2,3]);
        $this->assertEquals(json_encode([ [], [1],[2],[1,2], [3],[1,3],[2,3],[1,2,3] ]), json_encode($result));

        $result = $this->cls->subsets1([1,2,3]);
        $this->assertEquals(json_encode([ [], [3],[2],[2,3], [1],[1,3],[1,2],[1,2,3] ]), json_encode($result));

    }
}

<?php
/**
 * Created by PhpStorm.
 * User: ThinkPad
 * Date: 2020/12/10
 * Time: 9:02
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

        self::assertTrue(json_encode([[1,2,3],[1,3,2],[2,1,3],[2,3,1],[3,1,2],[3,2,1] ]) === json_encode($this->cls->permute([1,2,3])) );


        self::assertTrue(json_encode([[1,2,3],[1,3,2],[2,1,3],[2,3,1],[3,2,1],[3,1,2] ]) === json_encode($this->cls->permute2([1,2,3])) );

        self::assertTrue(json_encode([[1,2,3],[1,3,2],[2,1,3],[2,3,1],[3,2,1],[3,1,2] ]) === json_encode($this->cls->permute3([1,2,3])) );

    }

    function testLoop() {
        for($i = 0; $i < 3; $i++) {
            echo $i.PHP_EOL;
        }
        self::assertTrue(true);
    }

}

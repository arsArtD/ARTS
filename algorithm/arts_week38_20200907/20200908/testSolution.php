<?php
/**
 * Created by PhpStorm.
 * User: ThinkPad
 * Date: 2020/9/8
 * Time: 8:53
 */

require_once '../../../vendor/autoload.php';
require_once '../../util/ListUtil.php';
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
        $l1 = ListUtil::getListFromArr([4,5,1,9]);
        $this->cls->deleteNode($l1->next);
        $this->assertEquals(json_encode([4,1,9]), json_encode(ListUtil::getResultForArr($l1) ) );
    }

}

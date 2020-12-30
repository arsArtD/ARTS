<?php
/**
 * Created by PhpStorm.
 * User: ThinkPad
 * Date: 2020/12/30
 * Time: 12:23
 */

require_once '../../../vendor/autoload.php';
require_once 'Solution.php';
require_once '../../util/ListUtil.php';
use PHPUnit\Framework\TestCase;

class testSolution extends TestCase
{
    private $cls;

    public function __construct()
    {
        $this->cls = new Solution();
    }

    function test() {

        $arr = [3,2,0,-4];
        $list = ListUtil::getListFromArr($arr);
        $list->next->next->next->next =  $list->next;
        //var_export( $list->next->next->next->next);
        self::assertEquals($list->next,  $this->cls->detectCycle($list));


        $arr = [1,2];
        $list = ListUtil::getListFromArr($arr);
        $list->next =  $list;
        //var_export( $list->next->next->next->next);
        self::assertEquals($list,  $this->cls->detectCycle($list));


        $arr = [1];
        $list = ListUtil::getListFromArr($arr);
        self::assertEquals(null,  $this->cls->detectCycle($list));

    }

    function test1() {
        $arr = [3,2,0,-4];
        $list = ListUtil::getListFromArr($arr);
        $list->next->next->next->next =  $list->next;
        //var_export( $list->next->next->next->next);
        self::assertEquals($list->next,  $this->cls->detectCycle1($list));

        $arr = [1,2];
        $list = ListUtil::getListFromArr($arr);
        $list->next =  $list;
        //var_export( $list->next->next->next->next);
        self::assertEquals($list,  $this->cls->detectCycle1($list));


        $arr = [1];
        $list = ListUtil::getListFromArr($arr);
        self::assertEquals(null,  $this->cls->detectCycle1($list));
    }



}

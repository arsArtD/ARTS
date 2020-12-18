<?php
/**
 * Created by PhpStorm.
 * User: ThinkPad
 * Date: 2020/12/10
 * Time: 9:02
 */

require_once '../../../vendor/autoload.php';
require_once '../../util/TreeSerialize.php';
require_once 'Solution.php';
use PHPUnit\Framework\TestCase;

class testSolution extends TestCase
{
    private $cls;
    private $treeSerialize;

    public function __construct()
    {
        $this->cls = new Solution();
        $this->treeSerialize = new TreeSerialize();
    }

    function test() {

        $arr = $this->treeSerialize->deserialize([3,1,4,null,2]);
        self::assertEquals(1,  $this->cls->kthSmallest($arr, 1));

        $arr = $this->treeSerialize->deserialize([5,3,6,2,4,null,null,1]);
        self::assertEquals(3,  $this->cls->kthSmallest($arr, 3));
    }

    function test1() {

        $arr = $this->treeSerialize->deserialize([3,1,4,null,2]);
        self::assertEquals(1,  $this->cls->kthSmallest1($arr, 1));

        $arr = $this->treeSerialize->deserialize([5,3,6,2,4,null,null,1]);
        self::assertEquals(3,  $this->cls->kthSmallest1($arr, 3));
    }
}

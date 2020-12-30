<?php
/**
 * Created by PhpStorm.
 * User: ThinkPad
 * Date: 2020/12/18
 * Time: 13:35
 */

require_once __DIR__.DIRECTORY_SEPARATOR.'TreeNode.php';

class TreeSerialize
{
    public function serialize($root)
    {
        if($root == null)  return [];

        $res = [];
        $node = $root;
        $queue = [$node];

        while(count($queue) > 0) {
            $node = array_shift($queue);
            if($node == null) {
                $res[] = null;
            } else {
                $res[] = $node->val;
                $queue[] = $node->left;
                $queue[] = $node->right;
            }
        }

        return $res;
    }


    public function deserialize(array $data) {
        if(count($data) == 0) return null;

        $root = new TreeNode(array_shift($data));
        $queue = [$root];
        while(count($queue) > 0) {
            $node = array_shift($queue);
            if(count($data) <= 0) break;
            $left = array_shift($data);
            if($left != null) {
                $node->left = new TreeNode($left);
                $queue[] = $node->left;
            }
            if(count($data) <= 0) break;
            $right = array_shift($data);
            if($right != null) {
                $node->right = new TreeNode($right);
                $queue[] =$node->right;
            }
        }

        return $root;
    }
}


class TreeSerializeTest extends \PHPUnit\Framework\TestCase
{
    private $cls = null;

    public function __construct()
    {
        $this->cls = new TreeSerialize();
    }

    public function test1()
    {
        $data =  [3,1,4,null,2];
        $obj = $this->cls->deserialize($data);
        self::assertEquals(3, $obj->val);
        self::assertEquals(1, $obj->left->val);
        self::assertEquals(2, $obj->left->right->val);
        self::assertEquals(4, $obj->right->val);

        $arr = $this->cls->serialize($obj);
        self::assertEquals(true, is_array($arr));
        self::assertEquals(3, $arr[0]);
        self::assertEquals(1, $arr[1]);
        self::assertEquals(4, $arr[2]);
        self::assertEquals(null, $arr[3]);
        self::assertEquals(2, $arr[4]);

        self::assertTrue(true);
    }
}

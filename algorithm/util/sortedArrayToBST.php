<?php
/**
 * Created by PhpStorm.
 * User: ThinkPad
 * Date: 2020/12/18
 * Time: 11:14
 */

include __DIR__.DIRECTORY_SEPARATOR.'TreeNode.php';


class buildTree
{

    public function buildBstTree($nums, $left, $right) {
        if($left > $right) {
            return null;
        }
        $mid = $left + ceil(($right - $left) /2);
        $root = new TreeNode($nums[$mid]);
        $root->left = $this->buildBstTree($nums, $left, $mid-1);
        $root->right = $this->buildBstTree($nums, $mid+1, $right);
        return $root;
    }

    /**
     * 将有序数组转换为二叉搜索树
     * 将一个按照升序排列的有序数组，转换为一棵高度平衡二叉搜索树
     * @param array $nums
     * @return null|TreeNode
     */
    public function sortedArrayToBST(array $nums)
    {
        return $this->buildBstTree($nums, 0, count($nums) - 1);
    }
}


class buildTreeTest extends \PHPUnit\Framework\TestCase
{
    private $cls = null;

    public function __construct()
    {
        $this->cls = new buildTree();
    }

    public function test1()
    {
        $data =  [-10,-3,0,5,9];
        $result = $this->cls->sortedArrayToBST($data);
        self::assertEquals(0, $result->val);
        self::assertEquals(-3, $result->left->val);
        self::assertEquals(-10, $result->left->left->val);
        self::assertEquals(9, $result->right->val);
        self::assertEquals(5, $result->right->left->val);
        self::assertTrue(true);
    }
}

<?php


require_once '../../vendor/autoload.php';
require_once 'solution.php';
use PHPUnit\Framework\TestCase;

class testSolution extends TestCase
{
    private $cls;

    public function __construct()
    {
        $this->cls = new solution();
    }

    function test1()
    {
        /*

              5
             / \
            5   5
           / \   \
          1   1   5
                   \
                    5

         */
        $root = new TreeNode(5);
        $root->left = new TreeNode(5);
        $root->left->left = new TreeNode(1);
        $root->left->right = new TreeNode(1);
        $root->right = new TreeNode(5);
        $root->right->right = new TreeNode(5);
        $root->right->right->right = new TreeNode(5);
        $this->assertEquals(4, $this->cls->longestUnivaluePath($root));
    }

    function test2()
    {
        /*

            5
           / \
          1   5
         / \   \
        1   1   5
                 \
                  5

       */
        $root = new TreeNode(5);
        $root->left = new TreeNode(1);
        $root->left->left = new TreeNode(1);
        $root->left->right = new TreeNode(1);
        $root->right = new TreeNode(5);
        $root->right->right = new TreeNode(5);
        $root->right->right->right = new TreeNode(5);
        $this->assertEquals(3, $this->cls->longestUnivaluePath($root));
    }

}

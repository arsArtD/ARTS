<?php
/**
 * Created by PhpStorm.
 * User: ThinkPad
 * Date: 2020/8/26
 * Time: 8:51
 */



class ListNode
{
    public $val = 0;
    public $next = null;

    function __construct($val = 0, $next = null)
    {
        $this->val = $val;
        $this->next = $next;
    }
}



class ListUtil
{
    public static function getResultForArr(ListNode $head) {
        $result = [];
        while ($head != null && $head->next != null) {
            $result[] = $head->val;
            $head = $head->next;
        }
        //记录尾指针
        $result[] = $head->val;
        return $result;
    }

    public static function getListFromArr($arr) {
        $head = null;
        if (sizeof($arr) > 0) {
            $head = null;
            $cur = null;

            $listLen = count($arr);
            foreach($arr as $key=>$value) {
                if ($key == 0) {
                    $head = new ListNode($value);
                    if($listLen == 1) break;
                    $head->next = new ListNode($arr[$key+1]);
                    $cur = $head->next;
                } else {
                    if ($key != sizeof($arr)-1) {
                        $cur->next = new ListNode($arr[$key+1]);
                        $cur = $cur->next;
                    }
                }
            }
        }
        return $head;
    }
}

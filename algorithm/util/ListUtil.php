<?php
/**
 * Created by PhpStorm.
 * User: ThinkPad
 * Date: 2020/8/26
 * Time: 8:51
 */



require_once __DIR__.DIRECTORY_SEPARATOR.'ListNode.php';

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


class ListUtilTest extends \PHPUnit\Framework\TestCase
{

    public function test1()
    {
        $data =  [3,1,4,null,2];
        $result = ListUtil::getListFromArr($data);
        var_dump($result);
        self::assertEquals(3, $result->val);
        self::assertEquals(1, $result->next->val);
        self::assertEquals(4, $result->next->next->val);
        self::assertEquals(null, $result->next->next->next->val);
        self::assertEquals(2, $result->next->next->next->next->val);

        self::assertTrue(true);
    }
}


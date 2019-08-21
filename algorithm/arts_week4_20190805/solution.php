<?php
/**
 * Created by PhpStorm.
 * User: ThinkPad
 * Date: 2019/8/12
 * Time: 19:57
 */

//题目参照 readme.md

class Solution {

   // tasks = ["A","A","A","B","B","B"], n = 2

    private $tasks;

    private $taskDisableTime;

    /**
     * @return mixed
     */
    public function getTasks()
    {
        return $this->tasks;
    }

    /**
     * @param mixed $tasks
     */
    public function setTasks($tasks)
    {
        $this->tasks = $tasks;
    }

    /**
     * @return mixed
     */
    public function getTaskDisableTime()
    {
        return $this->taskDisableTime;
    }

    /**
     * @param mixed $taskDisableTime
     */
    public function setTaskDisableTime($taskDisableTime)
    {
        $this->taskDisableTime = $taskDisableTime;
    }

    /**
     * @param String[] $tasks
     * @param Integer $n
     * @return Integer
     */
    function leastInterval($tasks, $n) {
        //var_dump($tasks);
        //统计词频
        $count = array_fill(0,26,0);

        for ($i=0; $i<sizeof($tasks); $i++) {
            $count[ord($tasks[$i])- ord('A')]++;
        }
        uasort($count, function($a,$b){
            return $a > $b ? 1 : -1;
        });
        //var_dump(chr('A'),ord('A'));
        //重新将数组按照出现的次数进行排序
        $count = array_values($count);
        $maxCount = 0;
        for ($i=25; $i >=0; $i--) {
            if ($count[$i] != $count[25]) {
                break;
            }
            $maxCount++;
        }
        //公式算出的值可能会比数组的长度小，取两者中最大的那个
        $result = max(($count[25] - 1) * ($n + 1) + $maxCount , sizeof($tasks));
        //var_dump($result);
        return $result;
    }
}


//$s = new Solution();
//$s->setTasks(["A","A","A","B","B","B"]);
//$s->setTasks(["A","B","A"]);
//$s->setTaskDisableTime(2);
//$s->leastInterval($s->getTasks(), $s->getTaskDisableTime());


/*
 * 解释一下这个公式怎么来的 (count[25] - 1) * (n + 1) + maxCount

假设数组 ["A","A","A","B","B","C"]，n = 2，A的频率最高，记为count = 3，所以两个A之间必须间隔2个任务，
才能满足题意并且是最短时间（两个A的间隔大于2的总时间必然不是最短），因此执行顺序为： A->X->X->A->X->X->A，
这里的X表示除了A以外其他字母，或者是待命，不用关心具体是什么，反正用来填充两个A的间隔的。上面执行顺序的规律是：
有count - 1个A，其中每个A需要搭配n个X，再加上最后一个A，所以总时间为 (count - 1) * (n + 1) + 1
要注意可能会出现多个频率相同且都是最高的任务，比如 ["A","A","A","B","B","B","C","C"]，所以最后会剩下一个A和一个B，因此最后要加上频率最高的不同任务的个数 maxCount
公式算出的值可能会比数组的长度小，如["A","A","B","B"]，n = 0，此时要取数组的长度
 */

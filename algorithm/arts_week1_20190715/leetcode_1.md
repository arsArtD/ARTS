
### 经典的两数之和

* 给定一个整数数组 nums 和一个目标值 target，请你在该数组中找出和为目标值的那 两个 整数，  
  并返回他们的数组下标。    
  你可以假设每种输入只会对应一个答案。但是，你不能重复利用这个数组中同样的元素。  

* 算例1： [3,3] 6 期望 [0,1]
* 算例2： [3,2,4] 6  期望 [1,2]

## 最容易想到的解法
```
class Solution {

    /**
     * @param Integer[] $nums
     * @param Integer $target
     * @return Integer[]
     */
    function twoSum($nums, $target) {
        $result = [];
        $ns = sizeof($nums);
        for ($i = 0; $i < $ns; $i++)
        {
            for ($j = $i+1; $j < $ns; $j++)
            {
                if ($nums[$i]+$nums[$j] == $target)
                {
                    $result = [$i, $j];
                    break;
                }
            }
        }
        return $result;
    }
}
```
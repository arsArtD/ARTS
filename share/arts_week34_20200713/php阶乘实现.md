

```
/**
 * 阶乘
 */
function factorial($n) {    
    //array_product 计算并返回数组的乘积    
    //range 创建一个包含指定范围的元素的数组    
    return array_product(range(1, $n));
}

/**
 * 排列数
 */
function A($n, $m) {    
    return factorial($n)/factorial($n-$m);
}


/**
 * 组合数
 */
function C($n, $m) {    
    return A($n, $m)/factorial($m);
}

/**
 * 排列结果
 */
function arrangement($a, $m) {    
    $r = array();
    $n = count($a);
    if ($m <= 0 || $m > $n) {
        return $r;
    }
    for ($i=0; $i<$n; $i++) {
        $b = $a;
        //从数组中移除选定的元素，并用新元素取代它。该函数也将返回包含被移除元素的数组        $t = array_splice($b, $i, 1);
        if ($m == 1) {
            $r[] = $t;
        } else {
            $c = arrangement($b, $m-1);
            foreach ($c as $v) {
                $r[] = array_merge($t, $v);
            }
        }
    }
    return $r;
}

/**
 * 组合结果
 */
function combination($a, $m) {    $r = array();

    $n = count($a);
    if ($m <= 0 || $m > $n) {
        return $r;
    }

    for ($i=0; $i<$n; $i++) {
        $t = array($a[$i]);
        if ($m == 1) {
            $r[] = $t;
        } else {
            //array_slice() 函数在数组中根据条件取出一段值，并返回。            
            //array_slice(array,start,length,preserve)            
            $b = array_slice($a, $i+1);
            $c = combination($b, $m-1);
            foreach ($c as $v) {
                //array_merge() 函数把一个或多个数组合并为一个数组                $
                r[] = array_merge($t, $v);
            }
        }
    }

    return $r;
}

var_dump(C(5, 3));$res = combination(range(1, 5), 3);$res = var_export($res, true);
error_log($res);?>
```

<?php

//https://www.php.net/manual/zh/function.array-filter.php

$arr = ['a' => 1, 'b' => 2, 'c' => 3, 'd' => 4];

var_dump(array_filter($arr, function($k) {
    return $k == 'b';
}, ARRAY_FILTER_USE_KEY));

var_dump(array_filter($arr, function($v, $k) {
    return $k == 'b' || $v == 4;
}, ARRAY_FILTER_USE_BOTH));  


// removes all NULL, FALSE and Empty Strings but leaves 0 (zero) values
$result = array_filter( $array, 'strlen' );


class Test
{
    public function doFilter($array)
    {
        return array_filter($array, array($this, 'callbackMethodName'));
    }

    protected function callbackMethodName($element)
    {
        return $element % 2 === 0;
    }
}

$example = new Test;
print_r($example->doFilter(range(1, 10)));



$array = array(5, "   ", 2, NULL, 13, "", 7, "\n", 4, "\t");
print_r($array);
$result = array_filter($array, create_function('$a','return preg_match("#\S#", $a);'));                 
print_r($result);//返回非空字符串




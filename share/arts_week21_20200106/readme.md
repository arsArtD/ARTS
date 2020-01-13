
php判断字符串是否符合指定格式：

```
/**
 * 判断时间字符串是否符合指定格式
 * @param $timeStr  时间字符串：“2019.08.13 01:00”
 * @param $format   “Y.m.d H:i”
 * @param $transToTime 是否转换为时间戳,默认不会转换
 * @return
 *     $transToTime为falses时，boolean true--符合，false--不符合
 *     $transToTime为true时，转换失败返回false, 否则返回转换后的时间戳
 */
public static function validateTimeStr($timeStr, $format, $transToTime = false) {
    $validateTime = \DateTime::createFromFormat($format, $timeStr);
    $validateTimeRes = $validateTime && $validateTime->format($format) === $timeStr;
    if($transToTime && $validateTimeRes) {
        return $validateTime->getTimestamp();
    }
    return $validateTimeRes;

}
```

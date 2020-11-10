<?php
/**
 * 创建最近的arts目标目录
 * Created by PhpStorm.
 * User: ThinkPad
 * Date: 2020/11/10
 * Time: 9:01
 */


define('DS', DIRECTORY_SEPARATOR);

$baseDir = dirname(__DIR__).DS;

$srcDir = [
    $baseDir. 'toZhihu',
    $baseDir. 'algorithm',
    $baseDir. 'review',
    $baseDir. 'share',
    $baseDir. 'tip',
];

function getMaxWeek($dir) {
    $files = scandir($dir);
    $files = array_slice($files, 2);
    usort($files, function($a, $b) {
        $wa = str_replace('week', '', explode('_', $a)[1]);
        $wb = str_replace('week', '', explode('_', $b)[1]);
        return  $wa < $wb ? -1 : 1;
    });
    $last = end($files);
    $lastDay = str_replace('.md', '', explode('_', $last)[2]);
    $lastDayTime = strtotime($lastDay);
    // 获取当前最后创建文件的week下下周一的时间
    $nextweekMonday = date("Ymd", mktime(0, 0 , 0,
        date("m", $lastDayTime),
        date("d", $lastDayTime)-date("w", $lastDayTime)+1+14,
        date("Y"))
    );
    return $nextweekMonday;
}

$mdFileName = getMaxWeek($srcDir[0]);

foreach($srcDir as $dir) {
    $dirName = $dir.DS. $mdFileName;

    $mdFile = $dirName.DS.'readme.md';

    $dirType = end(preg_split('/\/|\\\/', $dir));

    if($dirType != 'toZhihu') {
        if(!file_exists($dirName)) {
            //echo $dirName.PHP_EOL;
            @mkdir($dirName);
        }
    } else {
        $mdFile = $dirName.'.md';
    }
    if(!file_exists($mdFile)) {
        touch($mdFile);
    }
}

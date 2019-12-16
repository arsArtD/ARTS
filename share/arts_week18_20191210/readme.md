

php日志文件压缩及下载：

```
$basePath = dirname(APP_PATH);

$fileDownloadHandler = function($filePath) {
    if(file_exists($filePath)) {
        $fileName = basename($filePath);
        // 通用二进制文件下载
        header("Content-Type:application/octet-stream");
        header("Content-Disposition:attachment;filename=".$fileName);
        header("Accept-ranges:bytes");
        header("Accept-Length:".filesize($filePath));
        $h = fopen($filePath, 'r');
        echo fread($h, filesize($filePath));
    } else {
        return false;
    }
};

if(!function_exists('zip_open')) {
    exit("没有zip扩展！");
}

$commandLogPath = $basePath.DIRECTORY_SEPARATOR.'log_output';
//需要压缩的文件
$needDownloadFiles = [];

$handle = opendir($commandLogPath);
while(false !== ($file = readdir($handle))) {

    if ($file != '.' && $file != '..') {
        //目前只读取cron_command_output下的.log文件
        $tempPath = $commandLogPath. DIRECTORY_SEPARATOR.$file;

        if(is_file($tempPath)) {
            $pathinfo = pathinfo($tempPath);
            if($pathinfo['extension'] == 'log') {
                $needDownloadFiles[] = $tempPath;
            }
        }
    }
}

$zip = new \ZipArchive;
$zipName = 'log_output';
// 默认压缩好的压缩包存放的位置
$zipPath  = $commandLogPath.DIRECTORY_SEPARATOR."$zipName.zip";

$zipHandle = $zip->open($zipPath, \ZipArchive::OVERWRITE | \ZipArchive::CREATE);

if($zipHandle !== true) {
    exit("创建命令行输出日志压缩文件失败！");
}

foreach($needDownloadFiles as $filePath) {

    if($zipHandle === true) {

        $date = date("YmdHis",time());
        $zipBaseName = $zipName.'_'.date("YmdHis",time());
        $zip->addFile($filePath);
        //解决文件路径过长的问题
        $zip->renameName($filePath, $zipBaseName.DIRECTORY_SEPARATOR.basename($filePath));
    }
}
$status = $zip->getStatusString();
$zip->close();
if($status !== 'No error') {
    // 如果压缩失败，提示压缩错误
    exit($status);
}

$fileDownloadHandler($zipPath);
```

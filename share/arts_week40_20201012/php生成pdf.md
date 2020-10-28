

mpdf 文档地址： https://mpdf.github.io/    

```php
<?php
 try {
    vendor("mpdf.mpdf");
    $mpdf =  new \Mpdf\Mpdf([
        'mode' => 'zh-CN/utf-8',//页面的模式
        'format' => 'A4',//纸张类型
        'debug' => 'true',
        'tempDir' => RUNTIME_PATH
        /*'orientation' => 'L'*/
    ]);
    $logger = new \Monolog\Logger('name');
    $logger = $logger->pushHandler(new \Monolog\handler\StreamHandler(RUNTIME_PATH.'/debug.log', \Monolog\Logger::DEBUG));
    $mpdf->setLogger($logger);

    // 图片比较多的情况
    $filePath = implode(DS, [APP_PATH, 'cron', 'commands', 'tests','tiku_paper_pdf', 'prod_27464.html']);
    $finalHtml = file_get_contents($filePath);
    echo date('H:i:s').PHP_EOL;

    $mpdf->WriteHTML($finalHtml);
    echo date('H:i:s').PHP_EOL;
    $fileName = 'demo.pdf';
    $mpdf->Output($fileName,\Mpdf\Output\Destination::FILE);
} catch(\Exception $ex) {
    echo $ex->getMessage();
}
```



# excel工具类使用

## composer: "phpoffice/phpspreadsheet":"^1.6"

## 示例代码：

$excelFilePath =  '/home/ftp/demo.xlsx';
$objReader    = \PhpOffice\PhpSpreadsheet\IOFactory::createReader('Xlsx');
$obj_PHPExcel = $objReader->load($excelFilePath, $encode = 'utf-8');
$excelArray   = $obj_PHPExcel->getsheet(0)->toArray();

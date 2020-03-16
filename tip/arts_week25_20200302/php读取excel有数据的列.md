```
// 具体使用详细参照： phpspread
// https://phpspreadsheet.readthedocs.io/en/latest/topics/reading-files/#reading-only-specific-columns-and-rows-from-a-file-read-filters  
$filePath = $file->getPathname();
$objReader = \PhpOffice\PhpSpreadsheet\IOFactory::createReader('Xlsx');
$objReader->setReadDataOnly(TRUE);
$spreadsheet = $objReader->load($filePath);
$spreadsheet->setActiveSheetIndex(0);
$worksheet = $spreadsheet->getActiveSheet();
// Get the highest row and column numbers referenced in the worksheet

/**  Define how many rows we want to read for each "chunk"  **/
$chunkSize = 2048;
/**  Create a new Instance of our Read Filter  **/
$chunkFilter = new ChunkReadFilter();

/**  Tell the Reader that we want to use the Read Filter  **/
$objReader->setReadFilter($chunkFilter);

/**  Loop to read our worksheet in "chunk size" blocks  **/
for ($startRow = 1; $startRow <= 65536; $startRow = $chunkSize+$startRow+1) {
    /**  Tell the Read Filter which rows we want this iteration  **/
    $chunkFilter->setRows($startRow,$chunkSize);
    /**  Load only the rows that match our filter  **/
    $spreadsheet = $objReader->load($filePath);
    //    Do some processing here
    $data = $spreadsheet->getSheet(0)->toArray();
    var_dump($data);
}
```

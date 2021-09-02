<?php declare(strict_types=1);

spl_autoload_register(function ($class_name) {
    require str_replace('\\', '/', "$class_name.php");
});

use App\Service\Documentation\Table\Handler\AnimDataHandler;
use App\Entity\Documentation\Row\AnimData;
use App\Collection\Iterator\ExcelIterator;
use App\Collection\RowCollection;
use App\Service\Validation\TableValidator;

class ExcelIteratorTest
{
    public function dumpExperience(string $filePath, string $fileName, array $columnNames, TableValidator $tableValidator, array $skipColumnValues = [])
    {
        $rowCollection = new RowCollection();

        $excelIterator = new ExcelIterator(
            $filePath,
            $fileName,
            $columnNames,
            $tableValidator,
            $skipColumnValues
        );

        $animDataHandler = new AnimDataHandler();
    
        // for each file row do extra work with iterator:
        foreach($excelIterator as $row)
        {
            $animDataHandler->addRowToCollection($rowCollection, $row);
        }

        $totalRows = $rowCollection->count();
        
        /**
         * for each entity created from $fileName
         * 
         * @var AnimData $entity
         * */
        foreach($rowCollection as $i => $entity)
        {
            print_r(($i+1)."/$totalRows | entity PK: ".$entity->getCofName()." | AnimationSpeed: " . $entity->getAnimationSpeed()."\n");
        }
    
        die;
    }
}

$excelIteratorTest = new ExcelIteratorTest();

$excelIteratorTest->dumpExperience(
    __DIR__.'/AnimData.txt',
    AnimData::FILE_NAME,
    AnimData::COLUMN_NAMES,
    new TableValidator(),
    [
        'CofName' => ['ZZRNHTH', 'ZZNUHTH'], // skip rows 3558 and 3557
        'AnimationSpeed' => ['256'] // remove all rows that have 256 frames animation speed; result = 856 rows
    ]
);
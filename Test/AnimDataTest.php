<?php

declare(strict_types=1);

namespace Test;

use App\Documentation\Table\Handler\{
    AnimDataHandler,
    AnimDataHandlerInterface
};
use App\Documentation\Table\Model\{
    AnimData,
    RowInterface
};
use App\Collection\{
    AnimDataCollection,
    AnimDataCollectionInterface
};
use App\Collection\Iterator\ExcelIterator;
use App\Validation\TableValidator;

class AnimDataTest
{
    public static function testAnimDataIterator(): void
    {
        $animDataCollection = new AnimDataCollection();

        $animDataHandler = new AnimDataHandler();

        $excelIterator = new ExcelIterator(
            dirname(__DIR__).'/AnimData.txt',
            AnimData::FILE_NAME,
            AnimData::COLUMN_NAMES,
            new TableValidator(),
            [
                'CofName' => ['ZZRNHTH', 'ZZNUHTH'], // skip rows 3558 and 3557
                'AnimationSpeed' => ['256'] // skip rows that have 256 frames animation speed
            ]
        );

        $totalRows = static::dumpAnimDataRow($excelIterator, $animDataCollection, $animDataHandler);

        if ($totalRows !== 856) {
            die(' ERROR: Invalid total row number!');
        }
    
        exit(' DONE');
    }

    private static function dumpAnimDataRow(ExcelIterator $excelIterator, AnimDataCollectionInterface $animDataCollection, AnimDataHandlerInterface $animDataHandler): int
    {
        // for each file row do extra work with iterator:
        foreach ($excelIterator as $rowData) {
            // $rowData validation here
            
            $animDataHandler->addRowDataToCollection($animDataCollection, $rowData);
        }

        $totalRows = $animDataCollection->count();
        
        /**
         * for each row object created from specific row from excel table file
         * 
         * @var RowInterface $row
         * */
        foreach ($animDataCollection as $index => $animData) {
            print_r(sprintf("%d/%s | row unique key: %s | | AnimationSpeed: %s\n", ($index + 1), $totalRows, $animData->getCofName(), $animData->getAnimationSpeed()));
        }

        return $totalRows;
    }
}

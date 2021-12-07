<?php

declare(strict_types=1);

namespace App\Documentation\Table\Handler;

use App\Documentation\Table\Model\AnimData;
use App\Collection\Iterator\ExcelIterator;
use App\Collection\AnimDataCollectionInterface;

final class AnimDataHandler implements AnimDataHandlerInterface
{
    public function handle(ExcelIterator $excelIterator, AnimDataCollectionInterface $animDataCollection): void
    {
        // for each file row do extra work with iterator:
        foreach ($excelIterator as $rowData) {
            // $rowData validation here
            
            $this->addRowDataToCollection($animDataCollection, $rowData);
        }
    }

    private function addRowDataToCollection(AnimDataCollectionInterface $animDataCollection, array $rowData): void
    {
        $characterCode = substr($rowData['CofName'], 0, 2) ?: '';
        $attackMode = substr($rowData['CofName'], 2, 2) ?: '';
        $wclass = substr($rowData['CofName'], 4, 3) ?: '';

        $animDataCollection->add((new AnimData)
            ->setCharacterCode($characterCode)
            ->setAttackMode($attackMode)
            ->setWclass($wclass)
            ->setFramesPerDirection((int)$rowData['FramesPerDirection'])
            ->setAnimationSpeed((int)$rowData['AnimationSpeed'])
        );
    }
}

<?php

declare(strict_types=1);

namespace App\Documentation\Table\Handler;

use App\Collection\Iterator\ExcelIterator;
use App\Collection\AnimDataCollectionInterface;

interface AnimDataHandlerInterface
{
    public function handle(ExcelIterator $excelIterator, AnimDataCollectionInterface $animDataCollection): void;
}

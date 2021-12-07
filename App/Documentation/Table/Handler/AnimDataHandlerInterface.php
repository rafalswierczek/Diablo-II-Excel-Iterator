<?php

declare(strict_types=1);

namespace App\Documentation\Table\Handler;

use App\Collection\AnimDataCollectionInterface;

interface AnimDataHandlerInterface
{
    public function addRowDataToCollection(AnimDataCollectionInterface $animDataCollection, array $row): void;
}

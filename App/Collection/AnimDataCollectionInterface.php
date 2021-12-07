<?php

declare(strict_types=1);

namespace App\Collection;

use App\Documentation\Table\Model\AnimData;

interface AnimDataCollectionInterface extends RowCollectionInterface
{
    public function add(AnimData $animData): void;

    public function get(int $index): AnimData;

    /**
     * @return AnimData[]
     */
    public function getAll(): array;
}

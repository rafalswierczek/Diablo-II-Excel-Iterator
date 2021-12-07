<?php

declare(strict_types=1);

namespace App\Documentation\Table\Model;

interface RowInterface
{
    /**
     * Returns associative array of column names and values that identifies unique rows of Table\Model
     */
    public function getUniqueKey(): array;
}

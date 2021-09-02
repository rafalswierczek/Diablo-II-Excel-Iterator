<?php declare(strict_types=1);

namespace App\Entity\Documentation\Row;

interface RowInterface
{
    /**
     * Returns associative array of column names and values that identifies unique rows
     */
    public function getUniqueKey(): array;
}
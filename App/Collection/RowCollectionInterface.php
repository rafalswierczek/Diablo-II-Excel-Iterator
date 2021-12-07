<?php

declare(strict_types=1);

namespace App\Collection;

use App\Documentation\Table\Model\RowInterface;

interface RowCollectionInterface
{
    /**
     * @return RowInterface[]
     */
    public function getAll(): array;

    public function pop(bool $resetIndex = true): void;

    public function remove(int $index, bool $resetIndex = true): void;

    public function resetIndex(): void;

    public function isEmpty(): bool;

    public function count(): int;
}

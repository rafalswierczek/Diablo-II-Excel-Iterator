<?php declare(strict_types=1);

namespace App\Collection;

interface CollectionInterface
{
    public function get(int $index);

    public function getAll(): array;

    public function pop(bool $resetIndex = true);

    public function remove(int $index, bool $resetIndex = true);

    public function resetIndex();

    public function isEmpty(): bool;
}
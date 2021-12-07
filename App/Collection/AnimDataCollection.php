<?php

declare(strict_types=1);

namespace App\Collection;

use App\Documentation\Table\Model\AnimData;
use App\Collection\Iterator\TableIterator;

final class AnimDataCollection implements \IteratorAggregate, \Countable, AnimDataCollectionInterface
{
    /**
     * @var AnimData[]
     */
    protected array $animDataList = [];
    protected \Iterator $iterator;

    public function __construct()
    {
        $this->iterator = new TableIterator($this);
    }

    public function getIterator(): TableIterator
    {
        return $this->iterator;
    }

    public function add(AnimData $animData): void
    {
        $this->animDataList[] = $animData;
    }

    public function get(int $index): AnimData
    {
        return $this->animDataList[$index];
    }

    public function getAll(): array
    {
        return $this->animDataList;
    }

    public function pop(bool $resetIndex = true): void
    {
        unset($this->animDataList[count($this->animDataList) - 1]);

        if ($resetIndex) {
            $this->resetIndex();
        }
    }

    public function remove(int $index, bool $resetIndex = true): void
    {
        unset($this->animDataList[$index]);

        if ($resetIndex) {
            $this->resetIndex();
        }
    }

    public function count(): int
    {
        return count($this->animDataList);
    }

    public function resetIndex(): void
    {
        $this->animDataList = array_values($this->animDataList);
    }

    public function isEmpty(): bool
    {
        return empty($this->animDataList);
    }
}

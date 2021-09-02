<?php declare(strict_types=1);

namespace App\Collection;

abstract class Collection implements \IteratorAggregate, \Countable, CollectionInterface
{
    protected array $elements = [];

    protected \Iterator $iterator;

    public function get(int $index)
    {
        return $this->elements[$index];
    }

    public function getAll(): array
    {
        return $this->elements;
    }

    public function pop(bool $resetIndex = true)
    {
        unset($this->elements[count($this->elements) - 1]);

        if($resetIndex)
            $this->resetIndex();
    }

    public function remove(int $index, bool $resetIndex = true)
    {
        unset($this->elements[$index]);

        if($resetIndex)
            $this->resetIndex();
    }

    public function count(): int
    {
        return count($this->elements);
    }

    public function resetIndex()
    {
        $this->elements = array_values($this->elements);
    }

    public function isEmpty(): bool
    {
        return empty($this->elements) ? true : false;
    }
}
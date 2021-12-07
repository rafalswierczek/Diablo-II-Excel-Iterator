<?php

declare(strict_types=1);

namespace App\Collection\Iterator;

use App\Documentation\Table\Model\RowInterface;
use App\Collection\RowCollection;

class RowIterator implements \Iterator
{
    /**
     * @var RowInterface[]
     */
    private array $table = [];
    private RowCollection $rowCollection;

    public function __construct(RowCollection $rowCollection)
    {
        $this->rowCollection = $rowCollection;
    }

    public function rewind(): void
    {
        $this->table = $this->rowCollection->getAll();
        
        reset($this->table);
    }

    public function current(): RowInterface
    {
        return current($this->table);
    }

    public function key(): int
    {
        return key($this->table);
    }

    public function next(): void
    {
        next($this->table);
    }

    public function valid(): bool
    {
        $row = current($this->table);

        return !empty($row) && $row instanceof RowInterface;
    }
}

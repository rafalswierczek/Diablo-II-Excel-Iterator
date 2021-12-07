<?php

declare(strict_types=1);

namespace App\Collection;

use App\Documentation\Table\Model\RowInterface;
use App\Collection\Iterator\RowIterator;

class RowCollection extends AnimDataCollection
{
    public function __construct()
    {
        $this->iterator = new RowIterator($this);
    }

    public function getIterator(): RowIterator
    {
        return $this->iterator;
    }

    public function add(RowInterface $row)
    {
        $this->elements[] = $row;
    }
}

<?php declare(strict_types=1);

namespace App\Collection;

use App\Entity\Documentation\Row\RowInterface;
use App\Collection\Iterator\RowIterator;

class RowCollection extends Collection
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
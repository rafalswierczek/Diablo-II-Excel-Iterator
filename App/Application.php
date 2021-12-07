<?php

declare(strict_types=1);

namespace App;

use Test\AnimDataTest;

class Application
{
    public function run(): void
    {
        AnimDataTest::testAnimDataIterator();
    }
}

<?php

declare(strict_types=1);

spl_autoload_register(function ($class_name) {
    require str_replace('\\', '/', "$class_name.php");
});

use App\Application;

$application = new Application();

$application->run();

<?php

use src\app\App;

require_once '../vendor/autoload.php';

//Collection Test
/*$collect = collect(['sdf', 'sdf']);
print_r($collect);*/

$app = new App();

echo $app->routeCheck();


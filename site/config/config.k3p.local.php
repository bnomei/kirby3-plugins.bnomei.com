<?php

$config = require_once(__DIR__ . '/config.localhost.php');

return array_merge($config, [
    'debug' => true,
]);

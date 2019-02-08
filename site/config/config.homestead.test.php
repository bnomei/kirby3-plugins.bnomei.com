<?php

$config = require_once(__DIR__ . '/config.localhost.php');

return array_merge($config, [
    'bnomei.securityheaders.csp' => require_once(__DIR__.'/csp.php'),
]);
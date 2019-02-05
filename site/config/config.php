<?php


return [
    'debug' => true,

    'bnomei.dotenv.dir' => function () {
        return realpath(kirby()->roots()->index() . '/../');
    },

    'bnomei.instagram.params' => [
        'count' => 4,
    ],
];

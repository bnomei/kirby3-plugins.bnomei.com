<?php


return [
    'debug' => false,

    'bnomei.dotenv.dir' => function () {
        return realpath(kirby()->roots()->index() . '/../');
    },

    'bnomei.instagram.params' => [
        'count' => 4,
    ],

    'routes' => [
        [
            'pattern' => 'feed',
            'method' => 'GET',
            'action'  => function () {
                $options = [
                    'title'       => 'Kirby 3 Plugins developed by Bnomei',
                    'link'        => 'home'
                ];
                $feed = site()->children()->not(page('home'))->not(page('error'))->feed($options);
                return $feed;
            }
        ]
    ]
];

<?php


return [
    'debug' => true,

    'bnomei.dotenv.dir' => function () {
        return realpath(kirby()->roots()->index() . '/../../../');
    },

    'bnomei.instagram.params' => [
        'count' => 4,
    ],

    'bnomei.htmlhead.css' => [
        'assets/css/app.css'
    ],

    'bnomei.htmlhead.js' => [
//        'assets/js/app.js',
        'assets/js/rainbow-custom.min.js',
    ],

    'bnomei.janitor.log.enabled' => true,
    'bnomei.janitor.jobs' => [
        'heist' => function(Kirby\Cms\Page $page = null, string $data = null) {

            \Bnomei\Janitor::log('heist.mask '.time());

            $grand = \Bnomei\Janitor::lootTheSafe();

            // or trigger a snippet like this:
            // snippet('call-police');

            // $page is Kirby Page Object if job issued by Panel
            $location = $page ? $page->title() : 'Bank';

            // $data is optional [data] prop from the Janitor Panel Field
            $currency = $data ? $data : 'Coins';

            \Bnomei\Janitor::log('heist.exit '.time());

            return [
                'status' => $grand > 0 ? 200 : 404,
                'label' => $grand . ' ' . $currency . '  looted at ' . $location . '!'
            ];
        }
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

<?php


    return [
        'debug' => true,

        'bnomei.dotenv.dir' => function() { return realpath(kirby()->roots()->index() . '/../'); },

//        'bnomei.janitor.log.enabled' => true,
//        'bnomei.janitor.jobs' => [
//            'heist' => function() {
//                \Bnomei\Janitor::log('heist.mask '.time());
//                $grand = \Bnomei\Janitor::lootTheSafe();
//                // or trigger a snippet like this:
//                // snippet('call-police');
//                \Bnomei\Janitor::log('heist.exit '.time());
//                return [
//                    'status' => $grand > 0 ? 200 : 404,
//                    'label' => $grand . ' Grand looted!'
//                ];
//            }
//        ],
    ];
<?php

Kirby::plugin('kirby3pluginsbnomeicom/metatags', [
    'pageMethods' => [
        'head_author' => function () {
            return site()->author();
        },
        'head_description' => function () {
            return $this->description()->isNotEmpty() ? $this->description() : site()->description();
        }
    ]
]);
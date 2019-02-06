<?php

function customConvertHook($file) {
    if($file->extension() == 'gif') {

        $file->cloudconvert(
            [
                'inputformat' => 'gif',
                'outputformat' => 'webm',
                'save' => true, // keep file at cloud to avoid another download from cloud-server
                'converteroptions' => [
                    // https://stackoverflow.com/questions/45588064/error-transparency-encoding-with-auto-alt-ref-does-not-work-when-converting-a#45588400
                    'command' => '-i {INPUTFILE} {OUTPUTFILE} -auto-alt-ref 0',
                ],
            ]
        );

        $file->cloudconvert(
            [
                'inputformat' => 'gif',
                'outputformat' => 'mp4',
            ]
        );
    }
}

return [
    'debug' => false,

    'bnomei.cloudconvert.apikey' => function() {
        return env('CLOUDCONVERT_APIKEY');
    },
    'bnomei.thumbimageoptim.apikey' => function() {
        return env('IMAGEOPTIM_APIKEY');
    },

    'hooks' => [
        'file.create:after' => function($file) {
            customConvertHook($file);
        },
        'file.replace:after' => function($newFile, $oldFile) {
            customConvertHook($newFile);
        },
    ]
];

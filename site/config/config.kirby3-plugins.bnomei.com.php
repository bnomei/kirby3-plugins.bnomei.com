<?php

use Phpcsp\Security\ContentSecurityPolicyHeaderBuilder;

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
    ],

    'bnomei.securityheaders.csp' => function() {
        $policy = new ContentSecurityPolicyHeaderBuilder();

        // root domain
        $sourcesetID = kirby()->site()->title()->value();
        $policy->defineSourceSet($sourcesetID, [kirby()->site()->url()]);

        $directives = [
            ContentSecurityPolicyHeaderBuilder::DIRECTIVE_DEFAULT_SRC,
            ContentSecurityPolicyHeaderBuilder::DIRECTIVE_STYLE_SRC,
            ContentSecurityPolicyHeaderBuilder::DIRECTIVE_SCRIPT_SRC,
            ContentSecurityPolicyHeaderBuilder::DIRECTIVE_IMG_SRC,
            ContentSecurityPolicyHeaderBuilder::DIRECTIVE_FONT_SRC,
            ContentSecurityPolicyHeaderBuilder::DIRECTIVE_CONNECT_SRC,
        ];
        foreach ($directives as $d) {
            $policy->addSourceSet($d, $sourcesetID);
        }

        // rainbows
        // https://github.com/ccampbell/rainbow/issues/223
        // https://github.com/lucaswerkmeister/server-etc/commit/98f8fa621a4ffec5cef66e9c96b287372085235e
        $sourcesetID = 'rainbows';
        $policy->defineSourceSet($sourcesetID, [kirby()->site()->url(), "'unsafe-eval'", "blob:"]);
        $directives = [
            ContentSecurityPolicyHeaderBuilder::DIRECTIVE_DEFAULT_SRC,
            ContentSecurityPolicyHeaderBuilder::DIRECTIVE_SCRIPT_SRC,
        ];
        foreach ($directives as $d) {
            $policy->addSourceSet($d, $sourcesetID);
        }

        // instagram
        $policy->addSourceExpression(ContentSecurityPolicyHeaderBuilder::DIRECTIVE_IMG_SRC, 'scontent.cdninstagram.com');

        return $policy;
    },
];

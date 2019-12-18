<?php
    use Phpcsp\Security\ContentSecurityPolicyHeaderBuilder;

    return function() {
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
        $policy->defineSourceSet($sourcesetID, [kirby()->site()->url(), "'unsafe-eval'", "'unsafe-inline'", "blob:"]);
        $directives = [
            ContentSecurityPolicyHeaderBuilder::DIRECTIVE_DEFAULT_SRC,
            ContentSecurityPolicyHeaderBuilder::DIRECTIVE_STYLE_SRC,
            ContentSecurityPolicyHeaderBuilder::DIRECTIVE_SCRIPT_SRC,
        ];
        foreach ($directives as $d) {
            $policy->addSourceSet($d, $sourcesetID);
        }

        // instagram
        $policy->addSourceExpression(ContentSecurityPolicyHeaderBuilder::DIRECTIVE_IMG_SRC, 'scontent.cdninstagram.com');

        // badgen
        $policy->addSourceExpression(ContentSecurityPolicyHeaderBuilder::DIRECTIVE_IMG_SRC, 'flat.badgen.net');

        return $policy;
    };

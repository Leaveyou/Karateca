<?php

declare(strict_types=1);

namespace PackageVersions;

use Composer\InstalledVersions;
use OutOfBoundsException;

class_exists(InstalledVersions::class);

/**
 * This class is generated by composer/package-versions-deprecated, specifically by
 * @see \PackageVersions\Installer
 *
 * This file is overwritten at every run of `composer install` or `composer update`.
 *
 * @deprecated in favor of the Composer\InstalledVersions class provided by Composer 2. Require composer-runtime-api:^2 to ensure it is present.
 */
final class Versions
{
    /**
     * @deprecated please use {@see self::rootPackageName()} instead.
     *             This constant will be removed in version 2.0.0.
     */
    const ROOT_PACKAGE_NAME = '__root__';

    /**
     * Array of all available composer packages.
     * Dont read this array from your calling code, but use the \PackageVersions\Versions::getVersion() method instead.
     *
     * @var array<string, string>
     * @internal
     */
    const VERSIONS          = array (
  'composer/package-versions-deprecated' => '1.11.99.5@b4f54f74ef3453349c24a845d22392cd31e65f1d',
  'doctrine/annotations' => '1.14.3@fb0d71a7393298a7b232cbf4c8b1f73f3ec3d5af',
  'doctrine/cache' => '2.2.0@1ca8f21980e770095a31456042471a57bc4c68fb',
  'doctrine/collections' => '2.1.2@db8cda536a034337f7dd63febecc713d4957f9ee',
  'doctrine/common' => '3.4.3@8b5e5650391f851ed58910b3e3d48a71062eeced',
  'doctrine/dbal' => '3.6.4@19f0dec95edd6a3c3c5ff1d188ea94c6b7fc903f',
  'doctrine/deprecations' => 'v1.1.1@612a3ee5ab0d5dd97b7cf3874a6efe24325efac3',
  'doctrine/doctrine-bundle' => '2.10.1@f9d59c90b6f525dfc2a2064a695cb56e0ab40311',
  'doctrine/doctrine-migrations-bundle' => '3.2.4@94e6b0fe1a50901d52f59dbb9b4b0737718b2c1e',
  'doctrine/event-manager' => '1.2.0@95aa4cb529f1e96576f3fda9f5705ada4056a520',
  'doctrine/inflector' => '2.0.8@f9301a5b2fb1216b2b08f02ba04dc45423db6bff',
  'doctrine/instantiator' => '2.0.0@c6222283fa3f4ac679f8b9ced9a4e23f163e80d0',
  'doctrine/lexer' => '2.1.0@39ab8fcf5a51ce4b85ca97c7a7d033eb12831124',
  'doctrine/migrations' => '3.6.0@e542ad8bcd606d7a18d0875babb8a6d963c9c059',
  'doctrine/orm' => '2.15.3@4c3bd208018c26498e5f682aaad45fa00ea307d5',
  'doctrine/persistence' => '3.2.0@63fee8c33bef740db6730eb2a750cd3da6495603',
  'doctrine/sql-formatter' => '1.1.3@25a06c7bf4c6b8218f47928654252863ffc890a5',
  'egulias/email-validator' => '4.0.1@3a85486b709bc384dae8eb78fb2eec649bdb64ff',
  'friendsofphp/proxy-manager-lts' => 'v1.0.16@ecadbdc9052e4ad08c60c8a02268712e50427f7c',
  'laminas/laminas-code' => '4.11.0@169123b3ede20a9193480c53de2a8194f8c073ec',
  'monolog/monolog' => '2.9.1@f259e2b15fb95494c83f52d3caad003bbf5ffaa1',
  'phpdocumentor/reflection-common' => '2.2.0@1d01c49d4ed62f25aa84a747ad35d5a16924662b',
  'phpdocumentor/reflection-docblock' => '5.3.0@622548b623e81ca6d78b721c5e029f4ce664f170',
  'phpdocumentor/type-resolver' => '1.7.2@b2fe4d22a5426f38e014855322200b97b5362c0d',
  'phpstan/phpdoc-parser' => '1.22.0@ec58baf7b3c7f1c81b3b00617c953249fb8cf30c',
  'psr/cache' => '2.0.0@213f9dbc5b9bfbc4f8db86d2838dc968752ce13b',
  'psr/container' => '1.1.2@513e0666f7216c7459170d56df27dfcefe1689ea',
  'psr/event-dispatcher' => '1.0.0@dbefd12671e8a14ec7f180cab83036ed26714bb0',
  'psr/link' => '1.1.1@846c25f58a1f02b93a00f2404e3626b6bf9b7807',
  'psr/log' => '2.0.0@ef29f6d262798707a9edd554e2b82517ef3a9376',
  'sensio/framework-extra-bundle' => 'v6.2.10@2f886f4b31f23c76496901acaedfedb6936ba61f',
  'symfony/asset' => 'v5.4.21@1504b6773c6b90118f9871e90a67833b5d1dca3c',
  'symfony/cache' => 'v5.4.25@e2013521c0f07473ae69a01fce0af78fc3ec0f23',
  'symfony/cache-contracts' => 'v2.5.2@64be4a7acb83b6f2bf6de9a02cee6dad41277ebc',
  'symfony/config' => 'v5.4.21@2a6b1111d038adfa15d52c0871e540f3b352d1e4',
  'symfony/console' => 'v5.4.24@560fc3ed7a43e6d30ea94a07d77f9a60b8ed0fb8',
  'symfony/dependency-injection' => 'v5.4.25@f0410c30a6c86bbce6c719c2b5cfc343362b982e',
  'symfony/deprecation-contracts' => 'v3.3.0@7c3aff79d10325257a001fcf92d991f24fc967cf',
  'symfony/doctrine-bridge' => 'v5.4.25@708ed45fbe672536f1d54692d133ea696189b237',
  'symfony/dotenv' => 'v5.4.22@77b7660bfcb85e8f28287d557d7af0046bcd2ca3',
  'symfony/error-handler' => 'v5.4.24@c1b9be3b8a6f60f720bec28c4ffb6fb5b00a8946',
  'symfony/event-dispatcher' => 'v5.4.22@1df20e45d56da29a4b1d8259dd6e950acbf1b13f',
  'symfony/event-dispatcher-contracts' => 'v3.3.0@a76aed96a42d2b521153fb382d418e30d18b59df',
  'symfony/expression-language' => 'v5.4.21@501589522b844b8eecf012c133f0404f0eef77ac',
  'symfony/filesystem' => 'v5.4.25@0ce3a62c9579a53358d3a7eb6b3dfb79789a6364',
  'symfony/finder' => 'v5.4.21@078e9a5e1871fcfe6a5ce421b539344c21afef19',
  'symfony/flex' => 'v1.20.0@49059a10127ac8270957e116a2251ae535d202ac',
  'symfony/form' => 'v5.4.24@813b79a34ab9843b5a01a6f809f1e4a009aaea2e',
  'symfony/framework-bundle' => 'v5.4.25@c9d65bdab4a26e110ec4c87b3aa5de108c0f860d',
  'symfony/http-client' => 'v5.4.25@ccbb572627466f03a3d7aa1b23483787f5969afc',
  'symfony/http-client-contracts' => 'v2.5.2@ba6a9f0e8f3edd190520ee3b9a958596b6ca2e70',
  'symfony/http-foundation' => 'v5.4.25@f66be2706075c5f6325d2fe2b743a57fb5d23f6b',
  'symfony/http-kernel' => 'v5.4.25@f6c92fe64bbdad7616cb90663c24f6350f3ca464',
  'symfony/intl' => 'v5.4.25@4c4cbf57c9623b55e7d19479488bd93fee68450a',
  'symfony/mailer' => 'v5.4.22@6330cd465dfd8b7a07515757a1c37069075f7b0b',
  'symfony/mime' => 'v5.4.23@ae0a1032a450a3abf305ee44fc55ed423fbf16e3',
  'symfony/monolog-bridge' => 'v5.4.22@34be6f0695e4187dbb832a05905fb4c6581ac39a',
  'symfony/monolog-bundle' => 'v3.8.0@a41bbcdc1105603b6d73a7d9a43a3788f8e0fb7d',
  'symfony/notifier' => 'v5.4.22@5ea626671ee3875f32c887467a47697bed83e6d4',
  'symfony/options-resolver' => 'v5.4.21@4fe5cf6ede71096839f0e4b4444d65dd3a7c1eb9',
  'symfony/password-hasher' => 'v5.4.21@7ce4529b2b2ea7de3b6f344a1a41f58201999180',
  'symfony/polyfill-intl-grapheme' => 'v1.27.0@511a08c03c1960e08a883f4cffcacd219b758354',
  'symfony/polyfill-intl-icu' => 'v1.27.0@a3d9148e2c363588e05abbdd4ee4f971f0a5330c',
  'symfony/polyfill-intl-idn' => 'v1.27.0@639084e360537a19f9ee352433b84ce831f3d2da',
  'symfony/polyfill-intl-normalizer' => 'v1.27.0@19bd1e4fcd5b91116f14d8533c57831ed00571b6',
  'symfony/polyfill-mbstring' => 'v1.27.0@8ad114f6b39e2c98a8b0e3bd907732c207c2b534',
  'symfony/polyfill-php73' => 'v1.27.0@9e8ecb5f92152187c4799efd3c96b78ccab18ff9',
  'symfony/polyfill-php80' => 'v1.27.0@7a6ff3f1959bb01aefccb463a0f2cd3d3d2fd936',
  'symfony/polyfill-php81' => 'v1.27.0@707403074c8ea6e2edaf8794b0157a0bfa52157a',
  'symfony/process' => 'v5.4.24@e3c46cc5689c8782944274bb30702106ecbe3b64',
  'symfony/property-access' => 'v5.4.22@ffee082889586b5718347b291e04071f4d07b38f',
  'symfony/property-info' => 'v5.4.24@d43b85b00699b4484964c297575b5c6f9dc5f6e1',
  'symfony/proxy-manager-bridge' => 'v5.4.21@a4cf96f3acfa252503a216bea877478f9621c7c0',
  'symfony/routing' => 'v5.4.25@56bfc1394f7011303eb2e22724f9b422d3f14649',
  'symfony/runtime' => 'v5.4.25@03e9c5d74464213a47a2ad8dc8eb249613701d6f',
  'symfony/security-bundle' => 'v5.4.22@36eddff8266126de032ab528417ad13eb43f6cb5',
  'symfony/security-core' => 'v5.4.22@a801d525c7545332e2ddf7f52c163959354b1650',
  'symfony/security-csrf' => 'v5.4.21@776a538e5f20fb560a182f790979c71455694203',
  'symfony/security-guard' => 'v5.4.22@62d064b1ee682e4617f4c5ddc0d31f73e1a7ecaa',
  'symfony/security-http' => 'v5.4.23@6791856229cc605834d169091981e4eae77dad45',
  'symfony/serializer' => 'v5.4.25@e528ace5951925459cb6620cc4d67c20ed616fdd',
  'symfony/service-contracts' => 'v2.5.2@4b426aac47d6427cc1a1d0f7e2ac724627f5966c',
  'symfony/stopwatch' => 'v5.4.21@f83692cd869a6f2391691d40a01e8acb89e76fee',
  'symfony/string' => 'v5.4.22@8036a4c76c0dd29e60b6a7cafcacc50cf088ea62',
  'symfony/translation' => 'v5.4.24@de237e59c5833422342be67402d487fbf50334ff',
  'symfony/translation-contracts' => 'v2.5.2@136b19dd05cdf0709db6537d058bcab6dd6e2dbe',
  'symfony/twig-bridge' => 'v5.4.22@e5b174464f68be6876046db3ad6e217d9a7dbbac',
  'symfony/twig-bundle' => 'v5.4.21@875d0edfc8df7505c1993419882c4071fc28c477',
  'symfony/validator' => 'v5.4.25@62b6cd0a2da0553db0400c3f13899afbdeefaa77',
  'symfony/var-dumper' => 'v5.4.25@82269f73c0f0f9859ab9b6900eebacbe54954ede',
  'symfony/var-exporter' => 'v6.3.0@db5416d04269f2827d8c54331ba4cfa42620d350',
  'symfony/web-link' => 'v5.4.21@57c03a5e89ed7c2d7a1a09258dfec12f95f95adb',
  'symfony/yaml' => 'v5.4.23@4cd2e3ea301aadd76a4172756296fe552fb45b0b',
  'twig/extra-bundle' => 'v3.6.1@802cc2dd46ec88285d6c7fa85c26ab7f2cd5bc49',
  'twig/twig' => 'v3.6.1@7e7d5839d4bec168dfeef0ac66d5c5a2edbabffd',
  'webmozart/assert' => '1.11.0@11cb2199493b2f8a3b53e7f19068fc6aac760991',
  'myclabs/deep-copy' => '1.11.1@7284c22080590fb39f2ffa3e9057f10a4ddd0e0c',
  'nikic/php-parser' => 'v4.16.0@19526a33fb561ef417e822e85f08a00db4059c17',
  'phar-io/manifest' => '2.0.3@97803eca37d319dfa7826cc2437fc020857acb53',
  'phar-io/version' => '3.2.1@4f7fd7836c6f332bb2933569e566a0d6c4cbed74',
  'phpunit/php-code-coverage' => '9.2.26@443bc6912c9bd5b409254a40f4b0f4ced7c80ea1',
  'phpunit/php-file-iterator' => '3.0.6@cf1c2e7c203ac650e352f4cc675a7021e7d1b3cf',
  'phpunit/php-invoker' => '3.1.1@5a10147d0aaf65b58940a0b72f71c9ac0423cc67',
  'phpunit/php-text-template' => '2.0.4@5da5f67fc95621df9ff4c4e5a84d6a8a2acf7c28',
  'phpunit/php-timer' => '5.0.3@5a63ce20ed1b5bf577850e2c4e87f4aa902afbd2',
  'phpunit/phpunit' => '9.6.9@a9aceaf20a682aeacf28d582654a1670d8826778',
  'sebastian/cli-parser' => '1.0.1@442e7c7e687e42adc03470c7b668bc4b2402c0b2',
  'sebastian/code-unit' => '1.0.8@1fc9f64c0927627ef78ba436c9b17d967e68e120',
  'sebastian/code-unit-reverse-lookup' => '2.0.3@ac91f01ccec49fb77bdc6fd1e548bc70f7faa3e5',
  'sebastian/comparator' => '4.0.8@fa0f136dd2334583309d32b62544682ee972b51a',
  'sebastian/complexity' => '2.0.2@739b35e53379900cc9ac327b2147867b8b6efd88',
  'sebastian/diff' => '4.0.5@74be17022044ebaaecfdf0c5cd504fc9cd5a7131',
  'sebastian/environment' => '5.1.5@830c43a844f1f8d5b7a1f6d6076b784454d8b7ed',
  'sebastian/exporter' => '4.0.5@ac230ed27f0f98f597c8a2b6eb7ac563af5e5b9d',
  'sebastian/global-state' => '5.0.5@0ca8db5a5fc9c8646244e629625ac486fa286bf2',
  'sebastian/lines-of-code' => '1.0.3@c1c2e997aa3146983ed888ad08b15470a2e22ecc',
  'sebastian/object-enumerator' => '4.0.4@5c9eeac41b290a3712d88851518825ad78f45c71',
  'sebastian/object-reflector' => '2.0.4@b4f479ebdbf63ac605d183ece17d8d7fe49c15c7',
  'sebastian/recursion-context' => '4.0.5@e75bd0f07204fec2a0af9b0f3cfe97d05f92efc1',
  'sebastian/resource-operations' => '3.0.3@0f4443cb3a1d92ce809899753bc0d5d5a8dd19a8',
  'sebastian/type' => '3.2.1@75e2c2a32f5e0b3aef905b9ed0b179b953b3d7c7',
  'sebastian/version' => '3.0.2@c6c1022351a901512170118436c764e473f6de8c',
  'symfony/browser-kit' => 'v5.4.21@a866ca7e396f15d7efb6d74a8a7d364d4e05b704',
  'symfony/css-selector' => 'v5.4.21@95f3c7468db1da8cc360b24fa2a26e7cefcb355d',
  'symfony/debug-bundle' => 'v5.4.21@8b4360bf8ce9a917ef8796c5e6065a185d8722bd',
  'symfony/dom-crawler' => 'v5.4.25@d2aefa5a7acc5511422792931d14d1be96fe9fea',
  'symfony/maker-bundle' => 'v1.49.0@ce1d424f76bbb377f1956cc7641e8e2eafe81cde',
  'symfony/phpunit-bridge' => 'v5.4.25@ed279c7839967958ee152c32eaa0eaaeac819404',
  'symfony/web-profiler-bundle' => 'v5.4.24@42dbb751c0363d75a3697775e662d6f21f3d8b83',
  'theseer/tokenizer' => '1.2.1@34a41e998c2183e22995f158c581e7b5e755ab9e',
  'symfony/polyfill-ctype' => '*@',
  'symfony/polyfill-iconv' => '*@',
  'symfony/polyfill-php72' => '*@',
  '__root__' => '1.0.0+no-version-set@',
);

    private function __construct()
    {
    }

    /**
     * @psalm-pure
     *
     * @psalm-suppress ImpureMethodCall we know that {@see InstalledVersions} interaction does not
     *                                  cause any side effects here.
     */
    public static function rootPackageName() : string
    {
        if (!self::composer2ApiUsable()) {
            return self::ROOT_PACKAGE_NAME;
        }

        return InstalledVersions::getRootPackage()['name'];
    }

    /**
     * @throws OutOfBoundsException If a version cannot be located.
     *
     * @psalm-param key-of<self::VERSIONS> $packageName
     * @psalm-pure
     *
     * @psalm-suppress ImpureMethodCall we know that {@see InstalledVersions} interaction does not
     *                                  cause any side effects here.
     */
    public static function getVersion(string $packageName): string
    {
        if (self::composer2ApiUsable()) {
            return InstalledVersions::getPrettyVersion($packageName)
                . '@' . InstalledVersions::getReference($packageName);
        }

        if (isset(self::VERSIONS[$packageName])) {
            return self::VERSIONS[$packageName];
        }

        throw new OutOfBoundsException(
            'Required package "' . $packageName . '" is not installed: check your ./vendor/composer/installed.json and/or ./composer.lock files'
        );
    }

    private static function composer2ApiUsable(): bool
    {
        if (!class_exists(InstalledVersions::class, false)) {
            return false;
        }

        if (method_exists(InstalledVersions::class, 'getAllRawData')) {
            $rawData = InstalledVersions::getAllRawData();
            if (count($rawData) === 1 && count($rawData[0]) === 0) {
                return false;
            }
        } else {
            $rawData = InstalledVersions::getRawData();
            if ($rawData === null || $rawData === []) {
                return false;
            }
        }

        return true;
    }
}

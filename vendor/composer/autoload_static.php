<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInitf4315fc2969cc881871ffef589c09c8f
{
    public static $files = array (
        '7b11c4dc42b3b3023073cb14e519683c' => __DIR__ . '/..' . '/ralouphie/getallheaders/src/getallheaders.php',
        '6e3fae29631ef280660b3cdad06f25a8' => __DIR__ . '/..' . '/symfony/deprecation-contracts/function.php',
        '37a3dc5111fe8f707ab4c132ef1dbc62' => __DIR__ . '/..' . '/guzzlehttp/guzzle/src/functions_include.php',
        '74f78b6b99713ff89d56028b614df71a' => __DIR__ . '/..' . '/libern/qr-code-reader/src/lib/common/customFunctions.php',
    );

    public static $prefixLengthsPsr4 = array (
        'n' => 
        array (
            'nguyenary\\QRCodeMonkey\\' => 23,
        ),
        'c' => 
        array (
            'chillerlan\\Settings\\' => 20,
            'chillerlan\\QRCode\\' => 18,
        ),
        'Z' => 
        array (
            'Zxing\\' => 6,
        ),
        'P' => 
        array (
            'Psr\\Http\\Message\\' => 17,
            'Psr\\Http\\Client\\' => 16,
        ),
        'L' => 
        array (
            'Libern\\QRCodeReader\\' => 20,
        ),
        'G' => 
        array (
            'GuzzleHttp\\Psr7\\' => 16,
            'GuzzleHttp\\Promise\\' => 19,
            'GuzzleHttp\\' => 11,
        ),
        'B' => 
        array (
            'Backend\\' => 8,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'nguyenary\\QRCodeMonkey\\' => 
        array (
            0 => __DIR__ . '/..' . '/nguyenary/qr-code-monkey/src',
        ),
        'chillerlan\\Settings\\' => 
        array (
            0 => __DIR__ . '/..' . '/chillerlan/php-settings-container/src',
        ),
        'chillerlan\\QRCode\\' => 
        array (
            0 => __DIR__ . '/..' . '/chillerlan/php-qrcode/src',
        ),
        'Zxing\\' => 
        array (
            0 => __DIR__ . '/..' . '/libern/qr-code-reader/src/lib',
        ),
        'Psr\\Http\\Message\\' => 
        array (
            0 => __DIR__ . '/..' . '/psr/http-message/src',
            1 => __DIR__ . '/..' . '/psr/http-factory/src',
        ),
        'Psr\\Http\\Client\\' => 
        array (
            0 => __DIR__ . '/..' . '/psr/http-client/src',
        ),
        'Libern\\QRCodeReader\\' => 
        array (
            0 => __DIR__ . '/..' . '/libern/qr-code-reader/src',
        ),
        'GuzzleHttp\\Psr7\\' => 
        array (
            0 => __DIR__ . '/..' . '/guzzlehttp/psr7/src',
        ),
        'GuzzleHttp\\Promise\\' => 
        array (
            0 => __DIR__ . '/..' . '/guzzlehttp/promises/src',
        ),
        'GuzzleHttp\\' => 
        array (
            0 => __DIR__ . '/..' . '/guzzlehttp/guzzle/src',
        ),
        'Backend\\' => 
        array (
            0 => __DIR__ . '/../..' . '/',
        ),
    );

    public static $prefixesPsr0 = array (
        'C' => 
        array (
            'Curl' => 
            array (
                0 => __DIR__ . '/..' . '/curl/curl/src',
            ),
        ),
    );

    public static $classMap = array (
        'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInitf4315fc2969cc881871ffef589c09c8f::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInitf4315fc2969cc881871ffef589c09c8f::$prefixDirsPsr4;
            $loader->prefixesPsr0 = ComposerStaticInitf4315fc2969cc881871ffef589c09c8f::$prefixesPsr0;
            $loader->classMap = ComposerStaticInitf4315fc2969cc881871ffef589c09c8f::$classMap;

        }, null, ClassLoader::class);
    }
}

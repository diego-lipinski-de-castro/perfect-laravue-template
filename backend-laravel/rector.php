<?php

declare(strict_types=1);

use Rector\Config\RectorConfig;
use Rector\CodingStyle\Rector\Encapsed\EncapsedStringsToSprintfRector;

return RectorConfig::configure()
    ->withPaths([
        __DIR__ . '/app',
        __DIR__ . '/bootstrap',
        __DIR__ . '/config',
        __DIR__ . '/public',
        __DIR__ . '/resources',
        __DIR__ . '/routes',
        __DIR__ . '/tests',
    ])
    ->withPhpSets()
    ->withPreparedSets(
        // deadCode: true,
        // codeQuality: true,
        codingStyle: true,
        // typeDeclarations: true,
        typeDeclarationDocblocks: true,
        privatization: true,
        naming: true,
        instanceOf: true,
        earlyReturn: true,
    )
    ->withTypeCoverageLevel(0)
    ->withDeadCodeLevel(0)
    ->withCodeQualityLevel(0)
    ->withImportNames(removeUnusedImports: true)
    ->withSkip([
        EncapsedStringsToSprintfRector::class,
    ]);

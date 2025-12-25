<?php

declare(strict_types=1);

use Rector\CodingStyle\Rector\Encapsed\EncapsedStringsToSprintfRector;
use Rector\Config\RectorConfig;
use RectorLaravel\Rector\Empty_\EmptyToBlankAndFilledFuncRector;
use RectorLaravel\Rector\FuncCall\RemoveDumpDataDeadCodeRector;
use RectorLaravel\Rector\MethodCall\ResponseHelperCallToJsonResponseRector;
use RectorLaravel\Set\LaravelSetList;
use RectorLaravel\Set\LaravelSetProvider;

return RectorConfig::configure()
    ->withPaths([
        __DIR__.'/app',
        __DIR__.'/bootstrap',
        __DIR__.'/config',
        __DIR__.'/public',
        __DIR__.'/resources',
        __DIR__.'/routes',
        __DIR__.'/tests',
    ])
    ->withComposerBased(laravel: true)
    ->withPhpSets()
    ->withSetProviders(LaravelSetProvider::class)
    // ->withSets([
    //     LaravelSetList::LARAVEL_120,
    //     LaravelSetList::ARRAY_STR_FUNCTIONS_TO_STATIC_CALL,
    //     LaravelSetList::LARAVEL_CODE_QUALITY,
    //     LaravelSetList::LARAVEL_COLLECTION,
    //     LaravelSetList::LARAVEL_CONTAINER_STRING_TO_FULLY_QUALIFIED_NAME,
    //     LaravelSetList::LARAVEL_ELOQUENT_MAGIC_METHOD_TO_QUERY_BUILDER,
    //     LaravelSetList::LARAVEL_FACADE_ALIASES_TO_FULL_NAMES,
    //     LaravelSetList::LARAVEL_IF_HELPERS,
    //     LaravelSetList::LARAVEL_STATIC_TO_INJECTION,
    //     LaravelSetList::LARAVEL_TESTING,
    //     LaravelSetList::LARAVEL_TYPE_DECLARATIONS,
    // ])
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
    ->withRules([
        ResponseHelperCallToJsonResponseRector::class,
        EmptyToBlankAndFilledFuncRector::class,
    ])
    ->withConfiguredRule(RemoveDumpDataDeadCodeRector::class, [
        'dd', 'dump', 'var_dump',
    ])
    ->withSkip([
        EncapsedStringsToSprintfRector::class,
    ]);

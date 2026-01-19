<?php

namespace Wexample\SymfonySemanticSchemaWeb\Helper;

use Wexample\SymfonyHelpers\Helper\JsonHelper;

class SchemaLoaderHelper
{
    public static function loadSchema(string $name): object|null
    {
        return JsonHelper::readOrNull(
            self::getSchemaPath($name)
        );
    }

    private static function getSchemaPath(string $name): string
    {
        return __DIR__ . '/../../schema/' . $name . '.json';
    }
}

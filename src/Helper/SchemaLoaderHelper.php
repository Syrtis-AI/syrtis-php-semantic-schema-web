<?php

namespace Wexample\SymfonySemanticSchemaWeb\Helper;

use Wexample\SymfonySemanticSchemaWeb\Loader\SchemaWebLoader;

class SchemaLoaderHelper
{
    public static function loadSchema(string $name): object|null
    {
        return (new SchemaWebLoader())->load($name);
    }
}

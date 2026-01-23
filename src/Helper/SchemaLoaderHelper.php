<?php

namespace Syrtis\SemanticSchemaWeb\Helper;

use Syrtis\SemanticSchemaWeb\Loader\SchemaWebLoader;

class SchemaLoaderHelper
{
    public static function loadSchema(string $name): object|null
    {
        return (new SchemaWebLoader())->load($name);
    }
}

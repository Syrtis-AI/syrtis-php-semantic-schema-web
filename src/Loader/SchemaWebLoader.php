<?php

namespace Syrtis\SemanticSchemaWeb\Loader;

use Syrtis\JsonSchema\Loader\AbstractSchemaLoader;

class SchemaWebLoader extends AbstractSchemaLoader
{
    private const string SCHEMA_BASE_URL = 'https://github.com/Syrtis-AI/syrtis-php-semantic-schema-web/tree/main/schema/';

    protected function getSchemaDirectory(): string
    {
        return __DIR__.'/../../schema';
    }

    protected function getSchemaBaseUrl(): ?string
    {
        return self::SCHEMA_BASE_URL;
    }
}

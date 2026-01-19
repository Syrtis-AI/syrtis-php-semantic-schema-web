<?php

namespace Wexample\SymfonySemanticSchemaWeb\Helper;

use Wexample\SymfonyHelpers\Helper\JsonHelper;

class SchemaLoaderHelper
{
    private const string SCHEMA_BASE_URL = 'https://github.com/Syrtis-AI/syrtis-php-semantic-schema-web/tree/main/schema/';

    private static array $cache = [];

    public static function loadSchema(string $name): object|null
    {
        $path = self::getSchemaPath($name);
        $schema = self::loadSchemaFile($path);

        if (! $schema) {
            return null;
        }

        return self::resolveRefs($schema, []);
    }

    private static function getSchemaPath(string $name): string
    {
        return __DIR__ . '/../../schema/' . $name . '.json';
    }

    private static function loadSchemaFile(string $path): ?object
    {
        if (isset(self::$cache[$path])) {
            return self::$cache[$path];
        }

        $schema = JsonHelper::readOrNull($path);
        if ($schema) {
            self::$cache[$path] = $schema;
        }

        return $schema;
    }

    private static function resolveRefs(mixed $node, array $stack): mixed
    {
        if (is_array($node)) {
            foreach ($node as $key => $value) {
                $node[$key] = self::resolveRefs($value, $stack);
            }

            return $node;
        }

        if (! is_object($node)) {
            return $node;
        }

        if (isset($node->{'$ref'}) && is_string($node->{'$ref'})) {
            $refPath = self::resolveRefPath($node->{'$ref'});
            if ($refPath && ! in_array($refPath, $stack, true)) {
                $schema = self::loadSchemaFile($refPath);
                if ($schema) {
                    return self::resolveRefs($schema, array_merge($stack, [$refPath]));
                }
            }

            return $node;
        }

        foreach ($node as $key => $value) {
            $node->{$key} = self::resolveRefs($value, $stack);
        }

        return $node;
    }

    private static function resolveRefPath(string $ref): ?string
    {
        $ref = explode('#', $ref)[0];

        if ($ref === '') {
            return null;
        }

        if (str_starts_with($ref, self::SCHEMA_BASE_URL)) {
            $ref = substr($ref, strlen(self::SCHEMA_BASE_URL));
        }

        $file = basename($ref);
        if (! str_ends_with($file, '.json')) {
            return null;
        }

        $name = pathinfo($file, PATHINFO_FILENAME);

        return self::getSchemaPath($name);
    }
}

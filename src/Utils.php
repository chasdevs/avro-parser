<?php


namespace AvroParser;


class Utils
{
    public static function renderPhpDefault($default)
    {
        switch (gettype($default)) {
            case 'string':
                return "\"$default\"";
            case 'boolean':
                return $default === true ? 'true' : 'false';
            case 'NULL':
                return 'null';
            default:
                return $default;
        }
    }

    /**
     * @see https://stackoverflow.com/a/15575293
     * @param string ...$paths
     * @return string
     */
    static function joinPaths(string ...$paths): string
    {
        $filteredPaths = [];

        foreach ($paths as $path) {
            if ($path !== '') {
                $filteredPaths[] = $path;
            }
        }

        return preg_replace('#/+#', DIRECTORY_SEPARATOR, join(DIRECTORY_SEPARATOR, $filteredPaths));
    }
}
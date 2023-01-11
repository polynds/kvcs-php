<?php

declare(strict_types=1);
/**
 * happy coding!!!
 */
namespace Kit\Core\FileSystem;

class Path
{
    public const DOT = '.';

    public const DOUBLE_DOT = '..';

    public static function explode(string $path): array
    {
        if (empty($path)) {
            return [];
        }
        $dirname = dirname($path);
        if ($dirname == '.' || empty($dirname)) {
            return [$path];
        }
        return explode(DIRECTORY_SEPARATOR, $dirname);
    }

    public static function split(string $path): array
    {
        $result = [];
        $index = 1;
        $pathArr = self::explode($path);
        while ($index <= count($pathArr)) {
            $result[] = dirname($path, $index);
            ++$index;
        }
        return $result;
    }

    public static function getCurPathName(string $path): string
    {
        $arrs = explode(DIRECTORY_SEPARATOR, $path);
        return end($arrs);
    }

    public static function getAbsolute(string $path): string
    {
        // Cleaning path regarding OS
        $path = mb_ereg_replace('\\\\|/', DIRECTORY_SEPARATOR, $path, 'msr');
        // Check if path start with a separator (UNIX)
        $startWithSeparator = $path[0] === DIRECTORY_SEPARATOR;
        // Check if start with drive letter
        preg_match('/^[a-z]:/', $path, $matches);
        $startWithLetterDir = isset($matches[0]) ? $matches[0] : false;
        // Get and filter empty sub paths
        $subPaths = array_filter(explode(DIRECTORY_SEPARATOR, $path), 'mb_strlen');

        $absolutes = [];
        foreach ($subPaths as $subPath) {
            if ($subPath === '.') {
                continue;
            }
            // if $startWithSeparator is false
            // and $startWithLetterDir
            // and (absolutes is empty or all previous values are ..)
            // save absolute cause that's a relative and we can't deal with that and just forget that we want go up
            if ($subPath === '..'
                && ! $startWithSeparator
                && ! $startWithLetterDir
                && empty(array_filter($absolutes, function ($value) { return ! ($value === '..'); }))
            ) {
                $absolutes[] = $subPath;
                continue;
            }
            if ($subPath === '..') {
                array_pop($absolutes);
                continue;
            }
            $absolutes[] = $subPath;
        }

        return
            (($startWithSeparator ? DIRECTORY_SEPARATOR : $startWithLetterDir) ?
                $startWithLetterDir . DIRECTORY_SEPARATOR : ''
            ) . implode(DIRECTORY_SEPARATOR, $absolutes);
    }
}

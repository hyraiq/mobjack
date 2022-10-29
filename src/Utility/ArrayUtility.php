<?php

declare(strict_types=1);

namespace App\Utility;

/**
 * A helper class to make php *_array functions work more intuitively, and to provide functions not available in the
 * PHP core. This class is intentionally untested as it will be covered by everywhere that uses it anyway.
 */
final class ArrayUtility
{
    private function __construct()
    {
    }

    /**
     * @template     T
     *
     * @psalm-param  T[]             $haystack
     * @psalm-param callable(T):bool $function
     *
     * @psalm-return list<T>
     */
    public static function arrayFilter(array $haystack, callable $function): array
    {
        return \array_values(\array_filter($haystack, $function));
    }

    /**
     * @template     T
     *
     * @psalm-param  T[]             $haystack
     * @psalm-param callable(T):bool $function
     *
     * @psalm-return null|T
     */
    public static function arrayFind(array $haystack, callable $function): mixed
    {
        $filtered = self::arrayFilter($haystack, $function);
        if (0 === \count($filtered)) {
            return null;
        }

        return $filtered[0];
    }
}

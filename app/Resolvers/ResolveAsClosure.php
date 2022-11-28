<?php


namespace App\Resolvers;

use Closure;

trait ResolveAsClosure
{
    public static function resolveAsClosure(): Closure
    {
        return Closure::fromCallable([self::class, 'resolve']);
    }

}

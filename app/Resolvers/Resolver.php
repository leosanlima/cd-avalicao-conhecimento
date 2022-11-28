<?php
namespace App\Resolvers;

interface Resolver
{
    public static function resolve();
    public static function resolveAsClosure(): \Closure;
}

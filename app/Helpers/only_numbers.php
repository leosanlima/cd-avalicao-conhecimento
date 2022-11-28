<?php

if (! function_exists('only_numbers')) {
    function only_numbers($string): int|null {
        if(!$string)
            return null;

        return (int)preg_replace('/[^0-9]/', '', $string);
    }
}

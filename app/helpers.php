<?php

declare(strict_types=1);

if (!function_exists('generateCode')) {
    function generateCode(): int
    {
        return rand(10**5,10**6);
    }
}

if (!function_exists('generateStringDate')) {
    function generateStringDate(string $value): array
    {
        $rangeStringDate = str_split($value);

        unset($rangeStringDate[11], $rangeStringDate[12]);

        $response = implode('', str_replace(" ", ',', $rangeStringDate));

        return explode(',', $response);
    }
}
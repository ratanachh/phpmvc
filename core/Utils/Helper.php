<?php
declare(strict_types=1);

namespace Core\Utils;

class Helper
{
    public static function cleanEmptyValueArray(array $array)
    {
        return array_diff($array, ['']);
    }
}
<?php

/*
 * Site common helper file
 *
 * */

if (!function_exists('generateUserId')) {
    /**
     * Generate string user id for given id.
     *
     * @param int $id
     * @return string
     */
    function generateUserId(int $id): string
    {
        $length = 5;
        $padded_string = str_repeat("0", $length - strlen($id)) . $id;
        return "U" . $padded_string;
    }
}

if (!function_exists('getClass')) {
    /**
     * Get class for styling the component.
     *
     * @param int|float $value
     * @return string
     */
    function getClass($value): string
    {
        if ($value == 0) {
            return 'none-status';
        }
        return ($value > 0) ? 'up-status' : 'down-status';
    }
}
if (!function_exists('percentChange')) {
    /**
     * Generate percentage change between two numbers.
     *
     * @param int|float $old
     * @param int|float $new
     * @param int $precision
     * @return float
     */
    function percentChange($old, $new, int $precision = 2): float
    {
        if ($old == 0) {
            $old++;
            $new++;
        }
        $change = (($new - $old) / $old) * 100;
        return round($change, $precision);
    }
}

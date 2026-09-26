<?php

/**
 * Helper functions for the application.
 *
 * This file is autoloaded via composer.json's "autoload" section.
 */

use Illuminate\Support\Str;

if (!function_exists('format_price')) {
    /**
     * Format a price in Kenyan Shillings.
     *
     * @param  mixed  $price
     * @return string
     */
    function format_price($price)
    {
        return 'KES ' . number_format((float) $price, 0, '.', ',');
    }
}

if (!function_exists('setting')) {
    /**
     * Get a setting value.
     *
     * @param  string  $key
     * @param  mixed  $default
     * @return mixed
     */
    function setting($key, $default = null)
    {
        return config("settings.{$key}", $default);
    }
}

<?php

if (!function_exists('image_url')) {
    function image_url(?string $image): string
    {
        if (empty($image)) {
            return asset('images/gallery.svg');
        }
        if (str_starts_with($image, 'http://') || str_starts_with($image, 'https://')) {
            return $image;
        }
        return asset($image);
    }
}

<?php

if (!function_exists('sort_url')) {
    function sort_url(string $column, ?string $order = 'asc'): string
    {
        $order = request()->get('field') === $column ? ($order === 'asc' ? 'desc' : 'asc') : 'asc';
        return request()->fullUrlWithQuery([
            'field' => $column,
            'order' => $order
        ]);
    }
}

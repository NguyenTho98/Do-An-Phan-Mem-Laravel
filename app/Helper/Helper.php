<?php
if (!function_exists('total_cart')) {
    function total_cart($cart)
    {
        $total = 0;
        foreach ($cart as $item) {
            $total += ($item->price * (100 - $item->options->sale) / 100) * $item->qty;
        }
        return $total;
    }
}

if (!function_exists('get_coupon')) {
    function get_coupon($array, $id)
    {
        foreach ($array as $value) {
            if ($value->id == $id) {
                return $value;
            }
        }
    }
}

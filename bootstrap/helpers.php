<?php

function route_class()
{
    return str_replace('.', '-', Route::currentRouteName());
}

function get_gravatar($email, $size=200)
{
    $grav_url = "https://www.gravatar.com/avatar/" . md5( strtolower( trim( $email ) ) ) . "?s=" . $size;
    return $grav_url;
}
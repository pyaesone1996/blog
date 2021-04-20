<?php

use Illuminate\Support\Facades\Request;

function current_user()
{
    return auth()->user();
}

function active($path, $active = 'active')
{
    return Request::is($path) ? $active : ' ';
}

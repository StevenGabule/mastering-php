<?php

namespace App;
use Illuminate\Support\Env;

if (!function_exists('env')) {
  function env($key, $default = null) {
    return Env::get($key, $default);
  }
}


print env('DB_HELLO', 'TEST');

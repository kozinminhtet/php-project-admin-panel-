<?php

include("../vendor/autoload.php");

use Helpers\Auth;

$user = Auth::check();
print_r($user);

// print_r($user->email);
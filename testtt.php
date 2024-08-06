<?php
include("vendor/autoload.php");

use Libs\Database\MySQL;
use Libs\Database\UsersTable;

$table = new UsersTable(new MySQL());


$r = $table->all();

// print_r($r);

forEach ($r as $e) {
    $e->id;

    // return $e;

    print_r($e->id ."<br>");
}

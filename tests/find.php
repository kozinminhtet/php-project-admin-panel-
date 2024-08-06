<?php
include("../vendor/autoload.php");

use Libs\Database\MySQL;
use Libs\Database\UsersTable;

$table = new UsersTable(new MySQL);
print_r($table->find("alice@gamil.com", "password"));
<?php
include("../vendor/autoload.php");

use Libs\Database\MySQL;
use Libs\Database\UsersTable;
use Helpers\HTTP;

$table = new UsersTable(new MySQL());
$id = $_GET['id'];

$table->suspend($id);

HTTP::redirect('/admin.php');
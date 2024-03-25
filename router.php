<?php
include_once "utils/default.php";
include_once "config/local.php";

$controller = $_GET['controller'];
$action = $_GET['action'];
$id = $_GET['id'];

if(empty($action)) {
    $action = "index";
}

$ctrlName = $controller . "controller";

include "./controllers/$ctrlName.php";

$ctrl = new $ctrlName;
$ctrl->{$action}();
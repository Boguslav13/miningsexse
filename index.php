<?php
session_start();

// Общие настройки движка
require 'settings.php';
// Общие функции движка
require 'functions.php';
// База данных
data_base(DB_DRIVER);
// Функции применимые только к данному проекту
require 'actions/functions.php';


if (isset($_REQUEST['path'])) {
    $requested_page = $_REQUEST['path'] ?: 'index';
} else {
    $requested_vars = explode('/', $_SERVER['REQUEST_URI']);
    $requested_page = strtok($requested_vars[1], '?') ?: 'index';
}

$HTML = '';

if (!file_exists("pages/$requested_page.html")) $requested_page = "index";

$HTML = file_get_contents("pages/$requested_page.html");

$HTML = modules_include($HTML);

if (file_exists("pages/$requested_page.php")) require("pages/$requested_page.php");

$HTML = editable($HTML);

echo $HTML;

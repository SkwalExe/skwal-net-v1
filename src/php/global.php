<?php
include("{$_SERVER['DOCUMENT_ROOT']}/vendor/autoload.php");

$dotenv = Dotenv\Dotenv::createImmutable("{$_SERVER['DOCUMENT_ROOT']}/..");
$dotenv->load();

include("{$_SERVER['DOCUMENT_ROOT']}/php/variables.php");
include("{$_SERVER['DOCUMENT_ROOT']}/php/functions.php");
include("{$_SERVER['DOCUMENT_ROOT']}/php/db.php");

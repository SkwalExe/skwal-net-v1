<?php

$root = $_SERVER['DOCUMENT_ROOT'];
$ip = $_SERVER["REMOTE_ADDR"];
$assets = "$root/assets";
$scripts = "$root/scripts";
$serverData = [
    "ip" => $ip,
];
$version = "1";

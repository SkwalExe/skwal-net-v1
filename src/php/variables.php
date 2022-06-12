<?php

$root = $_SERVER['DOCUMENT_ROOT'];
$ip = $_SERVER["REMOTE_ADDR"];
$assets = "$root/assets";
$scripts = "$root/scripts";

$url = "https://api.github.com/repos/skwalexe/skwal.net/commits/main";
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/80.0.3987.149 Safari/537.36');
$json = curl_exec($ch);
curl_close($ch);
$data = json_decode($json, true);
$version = $data['sha'];

$bio = "Hello 👋 I'm Léopold Koprivnik Ibghy, aka SkwalExe. I'm a 14 y/o French 🇫🇷 programming 💻 and Linux 🐧 lover. I use GitHub everyday since 2022/02/12. I code in rust 🦀, bash 🐚, and web languages 🌐. I also love making online courses.";

$defaultSettings = [
  "borders" => false
];

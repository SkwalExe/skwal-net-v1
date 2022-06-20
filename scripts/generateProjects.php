<?php
// putting all the embed composer module source code right 
// here because my hosting provider doesn't support composer :/
include("../modules/Embed/autoloader.php");

use Embed\Embed;


$curl = curl_init();
curl_setopt($curl, CURLOPT_URL, "https://api.github.com/users/SkwalExe/repos");
curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
curl_setopt($curl, CURLOPT_USERAGENT, "Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/44.0.2403.157 Safari/537.36");
$result = curl_exec($curl);
curl_close($curl);

$data = json_decode($result, true);

$json = [];

foreach ($data as $key => $value) {



    $graph = Embed::create($value['html_url']);

    $image = $graph->image;


    if (!$value['fork']) {
        $json[] = [
            "url" => "https://github.com/SkwalExe/{$value['name']}",
            "name" => $value['name'],
            "description" => $value['description'],
            "image" => $image
        ];
    }
};

$file = fopen("../src/scripts/projects.json", "w");
fwrite($file, json_encode($json));
fclose($file);

<?php
include_once __DIR__."/RouterSystem/classes/class.url_router.php";
$router = new urlRouter();
$router->webLang = "TR";

/** Include your web css and javascript files */
$router->webCSS = ["css/test.css"];
$router->webJS = ["https://code.jquery.com/jquery-3.6.0.min.js","js/test.js"];
/** ADD YOUR URLS */
 
$array = [
    "home" => [
        "path_count" => 2,
        "path_val_req" => true, // if true it need a the value to start
        "meta_keys" => ["key" => "value"],
        "title" => "Home page !",
        "css" => [ ],
        "js" => [ ],
        "callBackFunc" => ""
    ],
 
    "404" => [
        "path_count" => 1,
        "path_val_req" => true, // if true it need a the value to start
        "meta_keys" => ["key" => "value"],
        "title" => "404",
        "css" => [ ],
        "js" => [ ],
        "callBackFunc" =>  ""
    ]

];
$router->add_urlFromArray($array);


if(empty($router->QueryLink)){
    $router->QueryLink = "home";
    $router->getLink = "home";     
}

if(!$router->startRouter()){
    $router->QueryLink = "404";
    $router->getLink = "404";

}

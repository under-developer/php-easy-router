<?php
foreach($router->webCSS as $cssFile){
    if(filter_var($cssFile,FILTER_VALIDATE_URL)){
        echo '<link rel="stylesheet" href="'.$cssFile.'">'.PHP_EOL;
    }else{
        echo '<link rel="stylesheet" href="'.$router->ActucalURLFiltered.$cssFile.'">'.PHP_EOL;  
    }
}

foreach ($router->extractLinkHTMLValue("css") as $cssFile) {
    if(filter_var($cssFile,FILTER_VALIDATE_URL)){
        echo '<link rel="stylesheet" href="'.$cssFile.'">'.PHP_EOL;
    }else{
        echo '<link rel="stylesheet" href="'.$router->ActucalURLFiltered.$cssFile.'">'.PHP_EOL;  
    }
}


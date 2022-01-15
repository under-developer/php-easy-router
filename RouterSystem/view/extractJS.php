<?php
foreach($router->webJS as $jsFile){
    if(filter_var($jsFile,FILTER_VALIDATE_URL)){
        echo "<script src=".$jsFile."></script>".PHP_EOL;
 
    }else{
        echo "<script src=".$router->ActucalURLFiltered.$jsFile."></script>".PHP_EOL;
    }
}

foreach ($router->extractLinkHTMLValue("js") as $jsFile) {
    if(filter_var($jsFile,FILTER_VALIDATE_URL)){
        echo "<script src=".$jsFile."></script>".PHP_EOL;
    }else{
        echo "<script src=".$router->ActucalURLFiltered.$jsFile."></script>".PHP_EOL;
    }
}
<?php
foreach ($router->extractLinkHTMLValue("meta_keys") as $name => $contet) {
    echo '<meta name="'.$name.'" content="'.$contet.'">'.PHP_EOL;
}
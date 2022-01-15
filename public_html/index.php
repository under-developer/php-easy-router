<?php
include_once __DIR__."/../main.php";
?>
<!DOCTYPE html>
<html lang="<?= $router->webLang; ?>">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $router->extractLinkHTMLValue("title"); ?></title>
    <link rel="stylesheet" href="css/test.css">
    <?php include_once __DIR__."/../RouterSystem/view/extractMetaValues.php" ?>
    <!-- Your CSS Files -->
    <?php include_once __DIR__."/../RouterSystem/view/extractCSS.php"; ?>
</head>
<body>
    <?php include_once __DIR__."/../RouterSystem/view/pages/body.php"; ?>
    <!-- Your JavaScript Files -->
    <?php include_once __DIR__."/../RouterSystem/view/extractJS.php"; ?>
</body>
</html>
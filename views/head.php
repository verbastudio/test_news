<?php header('Access-Control-Allow-Origin: *'); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="theme-color" content="#187da0">
    <meta name="viewport" content="width=device-width, initial-scale=1,  maximum-scale=1, user-scalable=no, shrink-to-fit=no">
    <? foreach($array_css as $css) { ?>
        <link href="<?=main_url.$css?>" rel="stylesheet">
    <? } ?>
    <title>Title</title>
</head>
<body>
    <div>

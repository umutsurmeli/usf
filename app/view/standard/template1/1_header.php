<?php

?><!DOCTYPE html>
<html lang="tr">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <meta name="description" content="<?=isset($description)?$description:config('description');?>"/>
    <title><?=isset($title)?$title:config('domain');?></title>
    <?=isset($styles)?$styles:'';?>
  </head>
  <body>

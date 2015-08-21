<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
<html lang="en">
<head>
  <title><?php echo $title ?> - Netgra</title>
  <?php if (isset($css) && !empty($css) && is_array($css)):
            foreach ($css As $k => $v):?>
                <link crossorigin="anonymous" href="<?=$v?>" media="all" rel="stylesheet">
            <?php endforeach;?>
  <?php endif;?>
</head>
<body>
  <h1>Netgra</h1>
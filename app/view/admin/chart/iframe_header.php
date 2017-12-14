<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="https://www.w3.org/1999/xhtml">
    <head>
        <link rel="canonical" href="https://pgybt.in/<?php echo $this->canonical; ?>"/>
        <?php
        if (isset($this->metadata)) {
            echo $this->metadata;
        } else {
            ?>
            <title>PGYBT</title>

        <?php }
        ?>
        <link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.8.16/themes/ui-lightness/jquery-ui.css"/>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

        <link rel="icon" type="image/png" href="/images/pgybtico.ico" />
        <link rel="stylesheet" type="text/css" href="/css/loggedincombine.css"/>
        <script type="text/javascript" src="/js/modernizr.custom.79639.js"></script>
        <script type="text/javascript" src="/js/abetterbrowser.js"></script>
        <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js"></script>
        <script type="text/javascript" src="https://code.jquery.com/jquery-1.8.2.js"></script>

        <script type="text/javascript" src="/assets/global/plugins/chart/amcharts.js" ></script>
        <script type="text/javascript" src="/assets/global/plugins/amcharts/amcharts/pie.js"></script>
        <script type="text/javascript" src="/assets/global/plugins/amcharts/amcharts/serial.js"></script>

        <?php
        if ($this->env == 'PROD') {
            include_once("inc/gatracking.php");
        }
        ?>

    </head>

    <body>

          




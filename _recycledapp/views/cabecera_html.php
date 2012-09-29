<!DOCTYPE html>
<html>
    <head>
        <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1"/>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">        
        <title><?php echo $title; ?></title>
        
        <?php foreach($css as $file): ?>
            <link type="text/css" rel="stylesheet" href="<?php echo $file;?>" />
        <?php endforeach; ?>

        <?php foreach($js as $file): ?>
            <script type="text/javascript" charset="utf-8" src="<?php echo $file;?>"></script>
        <?php endforeach; ?>        
       
    </head>
    <body>               
   

    
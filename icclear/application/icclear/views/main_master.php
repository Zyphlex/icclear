<!DOCTYPE html">

<html>
<head>
    <?php

    // +----------------------------------------------------------
    // | PHP Project - IT Ninjas
    // +----------------------------------------------------------
    // | 
    // |
    // +----------------------------------------------------------
    // | Rob Oosthoek
    // +----------------------------------------------------------

    ?>

    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?php echo $title; ?></title>
    <meta charset="utf-8"> 
    <link rel="stylesheet" type="text/css" 
          href="<?php echo base_url() . APPPATH; ?>css/bootstrap.css" />
    <link rel="stylesheet" type="text/css" 
          href="<?php echo base_url() . APPPATH; ?>css/style.css" />
    <link rel="stylesheet" type="text/css" 
          href="<?php echo base_url() . APPPATH; ?>css/jquery.dataTables.min.css" />
    
    <link rel="icon" type="image/png" 
          href="<?php echo base_url() . APPPATH; ?>img/default/favicon.png"/>
    
    <script src="<?php echo base_url() . APPPATH; ?>js/jquery-1.11.2.min.js"></script>    
    
    <script type="text/javascript">
        var site_url = '<?php echo site_url();?>';
	var img_url = '<?php echo base_url() . APPPATH; ?>';
    </script>
</head>


<body>
    <div id="container">
        <img href="http://rs2img.memecdn.com/Dick-Nosed-Monkey_o_102356.jpg"/>
        <div id="hoofding"><?php echo $header; ?></div>
        <div id="navigatie"><?php echo $nav; ?></div>
        <div class="content" id="inhoud"><?php echo $content; ?></div>
        <div class="footer" id="footer"><?php echo $footer; ?></div>
    </div>
    
  <script src="//code.jquery.com/jquery-1.11.2.min.js"></script>
  <script src="<?php echo base_url() . APPPATH; ?>js/bootstrap.js"></script> 
  <script src="<?php echo base_url() . APPPATH; ?>js/jquery.dataTables.js"></script>    
  
</body>
</html>
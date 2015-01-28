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

    <title><?php echo $title; ?></title>
    <meta charset="utf-8"> 
    <link rel="stylesheet" type="text/css" 
          href="<?php echo base_url() . APPPATH; ?>css/bootstrap.css" />
    <link rel="stylesheet" type="text/css" 
          href="<?php echo base_url() . APPPATH; ?>css/style.css" />
    <link rel="icon" type="image/png" 
          href="<?php echo base_url() . APPPATH; ?>img/default/favicon.png"/>
    
    
    <script type="text/javascript">
        var site_url = '<?php echo site_url();?>';
	var img_url = '<?php echo base_url() . APPPATH; ?>';
    </script>
</head>


<body>
    <div id="container">
        <div id="hoofding"><?php echo $header; ?></div>
        <div id="navigatie"><?php echo $nav; ?></div>
        <div class="content" id="inhoud"><?php echo $content; ?></div>
        <div class="footer" id="footer"><?php echo $footer; ?></div>
    </div>
    
  <script src="//code.jquery.com/jquery-1.11.2.min.js"></script>
  <script src="<?php echo base_url() . APPPATH; ?>js/bootstrap.js"></script>  
  

  
  
</body>
</html>
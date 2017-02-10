<!DOCTYPE html>
<html lang="en">
  <head>
	<title>
		<?php echo $title_for_layout; ?>
	</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">

	<?php
		echo $this->Html->meta('icon');

		echo $this->fetch('meta');
		echo $this->fetch('css');
		echo $this->fetch('script');

    echo $this->Html->css('bootstrap.min');
    echo $this->Html->css('bootstrap-switch.min');
    
    
    //echo $this->Html->css('bootstrap-responsive');
    //echo $this->Html->css('bootstrap-responsive.min');
    echo $this->Html->css('font-awesome');
    echo $this->Html->css('bootstrap-social');
    echo $this->Html->css('jquery.bxslider');
    #echo $this->Html->css('bootstrap-datetimepicker');
    echo $this->Html->css('bootstrap-spinedit');
    echo $this->Html->css('dropzone');
    echo $this->Html->css('colorpicker/css/colorpicker');
    echo $this->Html->css('colorpicker/css/layout');
    echo $this->Html->css('../jquery-ui-1.11.4/jquery-ui');
    echo $this->Html->css('custom');
    
    
    echo $this->Html->script('jquery.min-1.10.2');
    echo $this->Html->script('plugins/jquery.fitvids');
    echo $this->Html->script('jquery.bxslider');
    echo $this->Html->script('jquery.bxslider.min');
    echo $this->Html->script('bootstrap.min');
    echo $this->Html->script('bootstrap-switch.min');
    #echo $this->Html->script('moment');
    #echo $this->Html->script('bootstrap-datetimepicker');
    echo $this->Html->script('bootstrap-spinedit');
    echo $this->Html->script('dropzone');
    echo $this->Html->script('colorpicker/js/colorpicker');
    echo $this->Html->script('../jquery-ui-1.11.4/jquery-ui');
    ?>


    <style type="text/css">
        body{ padding: 70px 0px; }
    </style>
    <style>
    /* This only works with JavaScript, 
       if it's not present, don't show loader */
    .no-js #loader { display: none;  }
    .js #loader { display: block; position: absolute; left: 100px; top: 0; }
    div#loader{
        position: fixed;
    }
  </style>
  <script>
    // Wait for window load
    $(window).load(function() {
      // Animate loader off screen
      $("#loader").fadeOut(1200);
      
    });

    
  </script> 

  </head>

  <body>
    <div id="loader">
    <?php echo $this->Html->image('loading.gif', ['alt' => '']);?>
    <p class="sub-header2">Please Wait...<p>
    </div>

    <div id="waw_bg"></div>
    <div id="waw_bg2"></div>
    
    <?php echo $this->Element('navigation');?>
    
    <div class="container">

			<?php echo $this->Session->flash();?>

			<?php echo $this->fetch('content');?>
     <div class="row">
      <div class="col-md-13 footer">
       
             Copyright 2015 - 2016 © WAWTeam. All rights reserved.
       
      </div>

    </div>
    </div><!-- /.container -->
    
    <script>
        $("#flashMessage").click(function(){
            $("#flashMessage").fadeOut(500);
        });
    </script>
  </body>
</html>
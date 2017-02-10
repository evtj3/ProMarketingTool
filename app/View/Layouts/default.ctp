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

  </head>

  <body>
    <div id="waw_bg"></div>
    <div id="waw_bg2"></div>
    
    <?php //echo $this->Element('navigation');?>
    
    <div class="container">

			<?php //echo $this->Session->flash();?>

			<?php //echo $this->fetch('content');?>
            
                <div class="row">
                	<p class="con_header" style="font-family:'Century Gothic'; font-size:80px;"><span class="glyphicon glyphicon-page"></span> ERROR 404!</p>
                     <p style="font-size:50px; font-family:helvitica,arial,sans-serif;" class="con_header">Opppsss! Something went wrong.</p>
                     <p style="font-size:30px;" class="con_sub_header">Sorry, This Page does not exist.</p>
                    
                 </div>
           

     
    </div><!-- /.container -->
    
    <script>
        $("#flashMessage").click(function(){
            $("#flashMessage").fadeOut(500);
        });
    </script>
  </body>
</html>
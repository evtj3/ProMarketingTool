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
	?>








  	<!-- Latest compiled and minified CSS -->
  	<!--<link rel="stylesheet" href="//netdna.bootstrapcdn.com/bootstrap/3.0.0/css/bootstrap.min.css">-->

  	<!-- Latest compiled and minified JavaScript -->
  	<!--<script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
  	<script src="//netdna.bootstrapcdn.com/bootstrap/3.0.0/js/bootstrap.min.js"></script>-->

    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="//cdnjs.cloudflare.com/ajax/libs/html5shiv/3.6.2/html5shiv.js"></script>
      <script src="//cdnjs.cloudflare.com/ajax/libs/respond.js/1.3.0/respond.min.js"></script>
    <![endif]-->

    <style type="text/css">
    	body{ padding: 70px 0px; }
      #waw_bg2{
        height: 100%;
        opacity:0.2;
        background-color: #0C99D5;
      }

      #waw_bg{
        -webkit-filter: blur(55px);
         filter: blur(55px);
      }
      
      .con_sub_header2 {
   padding: 0 25px 10px;
  

}
    </style>

  </head>

  <body>
    
    <div id="waw_bg"></div>
    <div id="waw_bg2"></div>
    <!---->
    <?php //echo $this->Element('navigation'); ?>
    
    <div class="container">

			<?php echo $this->Session->flash(); ?>

			<?php echo $this->fetch('content'); ?>
     <!--<div class="row">
      
      <div class="col-md-13 footer">
       
             Copyright 2015 © WAWTeam. All rights reserved.
       
      </div>

    </div>
    </div> -->
    <!-- /.container -->
    
    <script>
        $("#flashMessage").click(function(){
            $("#flashMessage").fadeOut(500);
        });
    </script>
  </body>
</html>

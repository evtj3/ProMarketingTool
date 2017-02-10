<div class="bodyContent">
  <p class="con_header">What they're saying?</p>
              <p class="con_sub_header">Official members of WAW Online Marketing Tool</p>
    <?php if(!empty($Testimonial_db)):?>      
    <div class="row">
    
    <div class="col-md-13" >
      
      <div class="slider testimonials">
        <p class="con_sub_header2">Click the image to redirect you to their <b>personal website</b></p>
            <ul class="bxslider4">

              <?php foreach($Testimonial_db as $tdb):?>
               <?php //pr($tdb);?>
               <a href="<?php echo '';?>"><li><?php echo $this->Html->image($tdb['testimonials']['image_path'], ['alt' => $tdb['testimonials']['image_name']]); ?>
               </li></a>

              <?php endforeach;?>
        	</ul>
        </div>
       </div>
    </div>
    <?php endif;?>
    <?php if(!empty($Video_db)):?>
    <!-- Videos-->
    <div class="row wht_bg">
        <div class="col-md-12">
            
            <div class="slider video-3">
              <p class="con_header">WAW Online Marketing Tool Video Tutorial</p>
              <p class="con_sub_header">by: WAW administrator</p>
              <p class="con_sub_header2">Click the video to play. Don't forget to <b>share!</b></p>
            <ul class="bxslider2 video-3-list">
              <?php foreach($Video_db as $vdb):?>
              <li>
                <iframe src="<?php echo $vdb['videos']['youtube_link'];?>" width="500" height="281" frameborder="0" webkitAllowFullScreen mozallowfullscreen= allowFullScreen></iframe>
                </li>
              <?php endforeach;?>
            </ul>
            </div>
 
        </div>
        
    </div>
    <?php endif;?>
</div>

<script type="text/javascript">
$('.bxslider4').bxSlider({
  minSlides: 1,
  maxSlides: 1,
  slideWidth: 880,
  slideMargin: 60,
  auto: true
});
/*
$('.bxslider2').bxSlider({
  video: true,
  useCSS: false
});
*/
</script>
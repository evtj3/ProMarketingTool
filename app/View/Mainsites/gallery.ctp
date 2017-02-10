<div class="bodyContent">
   <?php if(!empty($Video_db)):?>
    <!-- Videos-->
    <div class="row">
        <div class="col-md-13" >
            <p class="con_header">Weekly Events</p>
              <p class="con_sub_header">WAW Member's Activities</p>
              <p class="con_sub_header2"><b>WAW</b> Weekly Videos</p>
            <div class="slider video-2" style="padding:20px;">
              
            <ul class="bxslider2">
               <?php foreach($Video_db as $vdb):?>
                 <?php if($vdb['videos']['video_count'] == 1):?>
                <li>
                <iframe src="<?php echo $vdb['videos']['youtube_link'];?>" width="500" height="281" frameborder="0" webkitAllowFullScreen mozallowfullscreen allowFullScreen></iframe>
                </li>
                  <?php endif;?>
               <?php endforeach;?>
            </ul>
            
            
            </div>
            <div class="slider model_slider gallery_bg">
              <p class="con_sub_header2"><b>WAW</b> Weekly Images</p>
            <ul class="bxslider1">
              <?php foreach($Weeklyevent_db as $wdb):?>
                    <li>
                <?php echo $this->Html->image($wdb['weeklyevents_pics']['image_path'], ['alt' => $wdb['weeklyevents_pics']['image_name']]);?>
                 <a href="#"><?php echo $wdb['weeklyevents_pics']['image_name'];?></a>
                               
               </li>
              <?php endforeach;?>
              
            </ul>
            </div>
 
        </div>
    </div>
  <?php endif;?>
    <br style="clear:both;"/>
    <?php if(!empty($Video_db)):?>
    <div class="row">
        <div class="col-md-13" >
            <p class="con_header">Major Events</p>
              <p class="con_sub_header">WAW Member's Activities</p>
              <p class="con_sub_header2"><b>WAW</b> Major Videos</p>
            <div class="slider video-2" style="padding:20px;">
              
            <ul class="bxslider2">
               <?php foreach($Video_db as $vdb):?>
                 <?php if($vdb['videos']['video_count'] == 2):?>
                <li>
                <iframe src="<?php echo $vdb['videos']['youtube_link'];?>" width="500" height="281" frameborder="0" webkitAllowFullScreen mozallowfullscreen allowFullScreen></iframe>
                </li>
                  <?php endif;?>
               <?php endforeach;?>
            </ul>
            </div>
             <div class="slider model_slider gallery_bg">
              <p class="con_sub_header2"><b>WAW</b> Major Images</p>
            <ul class="bxslider1">
               <?php foreach($Majorevent_db as $wdb):?>
                    <li>
                <?php echo $this->Html->image($wdb['majorevents_pics']['image_path'], ['alt' => $wdb['majorevents_pics']['image_name']]);?>
                 <a href="#"><?php echo $wdb['majorevents_pics']['image_name'];?></a>
                               
               </li>
              <?php endforeach;?>
            </ul>
            </div>
        </div>
    </div>
  <?php endif;?>
</div>

<script type="text/javascript">
$('.bxslider1').bxSlider({
  minSlides: 1,
  maxSlides: 2,
  slideWidth: 800,
  slideMargin: 60,
  auto: true
});
$('.bxslider2').bxSlider({
  video: true,
  useCSS: false
});

</script>
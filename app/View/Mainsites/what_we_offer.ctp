<div class="bodyContent">
   
   <?php if(!empty($Video_db)):?>
    <!-- Videos-->
    <div class="row">
        <div class="col-md-12">
            <p class="con_header">What we offer?</p>
              <p class="con_sub_header">Watch this video for you to find out!</p>
              <p class="con_sub_header2">Don't forget to share!</p>
            <div class="slider video-2">
              
            <ul class="bxslider2">
               <li>
                
                <iframe src="<?php echo $Video_db['videos']['youtube_link'];?>" width="500" height="281" frameborder="0" webkitAllowFullScreen mozallowfullscreen allowFullScreen></iframe>
                
                </li>

            </ul>
            </div>
 
        </div>
    </div>
    <?php endif;?>
    <?php if(!empty($Presentation_db)):?>
    <div class="row">
    
    <div class="col-md-13" >
      <p class="con_header">Vantage Presentation</p>
              <p class="con_sub_header">By: WAW Administrator</p>
      <div class="slider">
        
        <p class="con_sub_header2"></p>
            <ul class="bxslider4" >
               <?php foreach($Presentation_db as $pdb):?>
                 <?php if($pdb['presentations']['presentation1'] == 1):?>  
               <a href="#"><li >
                 <center>
                <?php echo $this->Html->image($pdb['presentations']['image_path'], ['alt' => $pdb['presentations']['image_name']]); ?></center>
               </li>
             </a>
              <?php endif;?>
               <?php endforeach;?>
               
          </ul>
        </div>
       </div>
       <div class="col-md-13" >
      <p class="con_header">WAW Online Marketing Tool Presentation</p>
              <p class="con_sub_header">By: WAW Administrator</p>
      <div class="slider">
        
        <p class="con_sub_header2"></p>
            <ul class="bxslider4" >
               <?php foreach($Presentation_db as $pdb):?>
                 <?php if($pdb['presentations']['presentation2'] == 1):?>  
               <a href="#"><li >
                 <center>
                <?php echo $this->Html->image($pdb['presentations']['image_path'], ['alt' => $pdb['presentations']['image_name']]); ?></center>
               </li>
             </a>
              <?php endif;?>
               <?php endforeach;?>
               
          </ul>
        </div>
       </div>
    </div>
    <?php endif;?>
    <br style="clear:both; margin-top:60px;"/>
    <?php if(!empty($Package_db)):?>
    <div class="row offer_con">

        <div class="col-md-13">
          <br style="clear:both; margin-top:60px;"/>
          <p class="con_header">We offer you this:</p>
          <p class="con_sub_header"><?php echo count($Package_db);?> PACKAGES</p>
        	<ul class="offers" style="padding:30px;">
               <?php foreach($Package_db as $pdb):?>
               <li><a href="#" data-toggle="modal" data-target="#JoinModal">Try It Now!</a><?php echo $this->Html->image($pdb['packages']['image_path'], ['alt' => $pdb['packages']['image_name']]); ?>
               </li>
               <?php endforeach;?>
        	</ul>
        </div>
    </div>
    <?php endif;?>
</div>

<div  class="modal fade" id="JoinModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog">
    <div class="modal-content">
      
      <div class="modal-body">
        
        <div class="row">
            <div class="col-md-12">
            <?php if(!empty($User_db2)):?>
            <p> Please contact <font style="font-weight:bold;"><?php echo $User_db2['users']['firstname'].' '.substr($User_db2['users']['middlename'],(count($User_db2['users']['middlename']) - 1),1).'. '.$User_db2['users']['lastname'].' '.$User_db2['users']['ext'].'.';?></font> for your registration. You can contact the owner of this website through:
              <ul>
                   <li>E-mail: <?php echo $User_db2['users']['email'];?></li>
                   <?php if(!empty($User_db2['users']['facebook'])):?>
                   <li>Facebook page: <a href="<?php echo $User_db2['users']['facebook'];?>"><?php echo $User_db2['users']['facebook'];?></a></li>
                   <?php endif;?>
                   <?php if(!empty($User_db2['users']['twitter'])):?>
                   <li>Twitter page: <a href="<?php echo $User_db2['users']['twitter'];?>"><?php echo $User_db2['users']['twitter'];?></a></li>
                   <?php endif;?>
              </ul>
            </p>
          <?php else:?>
           <p >Opps sorry you can't join through this Main site. 
            <br/><br/>Please, Go back to the one who shared you the link and tell him/her you want to join us as a new WAW member.</p>
           <br/> 
           Thank you.
           <p class="con_sub_header2">by: WAW Administrator</p>
            <?php endif;?>

          </div>
          
        </div>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<script type="text/javascript">

$('.bxslider2').bxSlider({
  video: true,
  useCSS: false
});
$('.bxslider4').bxSlider({
  minSlides: 1,
  maxSlides: 1,
  slideWidth: 1240,
  slideMargin: 5,
  auto: true
});
</script>
<?php 
$user_ses = $this->Session->read('User');
$username_ses = $this->Session->read('User.username');
$usergroup_ses = $this->Session->read('User.group');
 $count = 0;
 foreach($Brand_db as $bdb){
  $count += 1;
    echo '<style type="text/css">';
    echo "
          .".substr($bdb['brands']['brand'],0,strlen($bdb['brands']['brand']*(-1)))."".$count."{
  background-image: url('".$bdb['brands']['image_path']."');
 width: 93%;
 height:90%;
 position: absolute;
 left: 15px;
 bottom:15px;
 z-index: 1;
}
    ";
    echo '</style>';
 }

?>
<div class="bodyContent">
  <?php if(!empty($ProductModel_db)):?>
  <div class="row">

    <div class="col-md-12" >
      
      <div class="slider model_slider"style="display:none;">
            
            <ul class="bxslider1"  >
               <?php foreach($ProductModel_db as $pmdb):?>
               <li>
                <?php echo $this->Html->image($pmdb['models']['image_path'], ['alt' => $pmdb['models']['brand']]);?>
                 <a href="#"><?php echo $pmdb['models']['brand'];?></a>
                               
               </li>
               <?php endforeach;?>
            </ul>
            </div>
    </div><!-- end col md 12 -->
    
  </div><!-- end row -->
<?php endif;?>
  <br style="clear:both; margin-top:60px;"/>
    <div class="row wlcm">
         <div class="col-md-6 wlcm1">
          <h1 style="text-align:center;font-weight:bold;color:#0C99D5;font-size:60px;">Welcome to</h1>
          <h2 style="text-align:right;font-weight:bold;color:#999;font-size:16px;">We are winners</h2>
         </div>
         <div class="col-md-6 wlcm2">
          <?php if(!empty($user_ses)):?>

            <a class="fb_link" href="<?php echo $this->Session->read('User.facebook')?>"><span style="padding:10px;font-size:20px; border:1px solid #fff;" class="fa fa-facebook"></span> <?php echo $this->Session->read('User.facebook');?></a>

          <div class="profile_pic">

            <?php foreach($User_db as $pp):?>


              <?php echo $this->Html->image($pp['image_path'], ['alt' => $pp['image_name']]);?>
              
            <?php endforeach;?>

          </div>
          <?php foreach($User_db as $pp):?>
            <p class="uname"><?php echo $pp['image_name'];?></p>
          <?php endforeach;?>

        <?php else:?>
           
           <?php if(!empty($User_db2)):?>
           
           <a class="fb_link" href="<?php echo $User_db2['users']['facebook'];?>"><span style="padding:10px;font-size:20px; border:1px solid #fff;" class="fa fa-facebook"></span> <?php echo substr($User_db2['users']['facebook'], 0,40); if(substr($User_db2['users']['facebook'], 0,40)){echo '...';}?></a>
          <?php if(!empty($User_db2['ProfilePic'])):?>
          <div class="profile_pic">
              <?php echo $this->Html->image($User_db2['ProfilePic']['0']['image_path'], ['alt' => $User_db2['ProfilePic']['0']['image_name']]);?>
          </div>
          
            <a class="uname" href="#"><?php echo $User_db2['ProfilePic']['0']['image_name'];?></a>
           <?php endif;?>
          <?php endif;?>
         <?php endif;?>
          <h1 style="text-align:center;font-weight:bold;color:#fff;font-size:60px;">WAW<font style="font-size:30px;">Team</font></h1>
          <h2 style="text-align:right;font-weight:bold;color:#fff;font-size:20px;">Online Marketing Tools</h2>
         </div>
    </div>
  <br style="clear:both; margin-top:60px;"/>
  <?php if(!empty($Brand_db)):?>
    <div class="row brands">
         
              <p class="con_sub_header2" style="color:#DDDCD9;" >Check this out! Find what suits you <b>best!</b></p>
         <div class="brand_con">
             <?php $count = 0;?>
             <?php foreach($Brand_db as $bdb): ?>
             <?php $count += 1;?>
             <a href="<?php echo $this->Html->url(array('action' => 'products?bid='.$bdb['brands']['id']));?>"><div class="col-md-4 brnd ">
                  <p><?php echo $bdb['brands']['brand'];?></p><div class="<?php echo substr($bdb['brands']['brand'],0,strlen($bdb['brands']['brand']*(-1))).''.$count;?>"></div>
             </div></a>
             <?php endforeach;?>
            
          </div>
       
    </div>
  <?php endif;?>
    <br style="clear:both; margin-top:50px;"/>
    <?php if(!empty($Qoute_db)):?>
    <div class="row">
       <div class="col-md-12 clothing_bg">
          
           <p class="con_header"><span class="f_qoute">"</span> <?php echo $Qoute_db['qoutes']['qoute'];?>. <span class="f_qoute">"</span></p>
              <p class="con_sub_header">- <?php echo $Qoute_db['qoutes']['author'];?> -</p>
          
       </div>
    </div>
    <?php endif;?>
    <br style="clear:both; "/>
    <?php if(!empty($Product_db)):?>
    <div class="row fe_products">
      <p class="con_header">Featured Products</p>
              <p class="con_sub_header">current products shown are available</p>
              <p class="con_sub_header2">What are you waiting for? <b>shop now!</b></p>
      <div class="col-md-13 featuredProducts">
          <div class="row">
             <div class="col-md-7">
          <!-- -->
            <ul class="fproducts">
               <?php foreach($Product_db as $pdb):?>
               <?php if($pdb['products']['featured'] == 1):?>
               <li>
                <?php if(!empty($user_ses)):?>
                <a href="<?php echo $this->Html->url(array('controller' => $this->Session->read('User.username'),'action' => 'products?pid='.$pdb['products']['brand_id']));?>">Shop Now!</a>
                <img src="<?php echo $pdb['products']['image_path']?>"/>
               <?php else:?>
               <a href="<?php echo $this->Html->url(array('controller' => 'mainsites','action' => 'products?pid='.$pdb['products']['brand_id']));?>">Shop Now!</a>
                <img src="<?php echo $pdb['products']['image_path']?>"/>
               <?php endif;?>
               </li>
               <?php endif;?>
               <?php endforeach;?>
           </ul>
           
            <br style="clear:both;"/>
            <p class="joining"><h10>You want to earn more? <a href="#" class="joinnow-b" data-toggle="modal" data-target="#JoinModal"> JOIN NOW!</a></h10></p>
          <!---->
            </div>
            
            
            <div class="col-md-5 model-1">

            <img src="/waw_images/waw/model.png"/>
           </div>
        </div>
      </div>
    </div>
  <?php endif;?>
    <br style="clear:both;"/>
    <!-- subscribe -->
    <div class="row">
        <div class="col-md-12 subscriptions">
            <p class="subsicon">Subscribe
              <?php if(!empty($User_db2['users']['twitter'])):?>
              <a href="<?php echo $User_db2['users']['twitter'];?>" class="btn btn-social-icon btn-twitter"><span class="fa fa-twitter"></span></a>
            <?php endif;?>
            <?php if(!empty($User_db2['users']['facebook'])):?>
              <a href="<?php echo $User_db2['users']['facebook'];?>" class="btn btn-social-icon btn-facebook"><span class="fa fa-facebook"></span></a></p>
            <?php endif;?>

              <?php if(empty($User_db2)):?>
              <a href="https://www.twitter.com/wawpromarketing" class="btn btn-social-icon btn-twitter"><span class="fa fa-twitter"></span></a>
              <a href="https://www.facebook.com/wawpromarketing" class="btn btn-social-icon btn-facebook"><span class="fa fa-facebook"></span></a></p>
              <?php endif;?>
        </div>
    </div>
   <br style="clear:both;"/>
    <div class="row">
        <div class="col-md-12 stats-1">
            <ul class="stats">
              
              <li>Members <div class="circleBase stastdiv"><?php 
              echo $User_count;
              ?></div></li>
              <li>Products <div class="circleBase stastdiv">
              <?php echo count($Product_db);?>
              </div></li>
            </ul>
        </div>
    </div>
    <br style="clear:both; margin-top:60px;"/>
    <?php if(!empty($Video_db)):?>
    <!-- Videos-->
    <div class="row" style="margin:0 auto;">
        <div class="col-md-12 video-1">
            
            <div class="slider">
              <p class="con_header">WAW Online Marketing Tool Video Tutorial</p>
              <p class="con_sub_header">By: WAW administrator</p>
              <p class="con_sub_header2">You want to know how to use <b>WAW Online Marketing Tool?</b> Wacth this video below. Don't forget to <b>share!</b></p>
            <ul class="bxslider2">
               
               <li>
                
                <iframe src="<?php echo $Video_db['videos']['youtube_link'];?>" width="500" height="281" frameborder="0" webkitAllowFullScreen mozallowfullscreen allowFullScreen></iframe>
                
                </li>
                
            </ul>
            </div>
        </div>
        
    </div>
    <?php endif;?>
    <br style="clear:both; margin-top:60px;"/>
    <?php if(!empty($Product_db)):?>
    <!-- product slider -->
    <div class="row">

        <div class="col-md-12">
        
            <div class="slider">
              <p class="con_header">Available Products</p>
              <p class="con_sub_header">By: WAW administrator</p>
              <p class="con_sub_header2">What are you waiting for? <b>shop now!</b></p>    
            <ul class="bxslider3">
               <?php foreach($Product_db as $pdb):?>
               <li>
                
                <img src="<?php echo $pdb['products']['image_path'];?>"/>
                <a href="<?php echo $this->Html->url(array('controller' => $this->Session->read('User.username'),'action' => 'products?pid='.$pdb['products']['id']));?>"><?php echo $pdb['products']['item_name'];?></a>
               </li>
             <?php endforeach;?>
               
            </ul>
            </div>
 
        </div>
    </div>
  <?php endif;?>
    <br style="clear:both; margin-top:60px;"/>
    
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
$('.model_slider').fadeIn(300);
$('.bxslider1').bxSlider({
  minSlides: 1,
  maxSlides: 3,
  slideWidth: 420,
  slideMargin: 5,
  auto: true
});

$('.bxslider2').bxSlider({
  video: true,
  useCSS: false
});

$('.bxslider3').bxSlider({
  minSlides: 1,
  maxSlides: 4,
  slideWidth: 310,
  slideMargin: 30,
  auto: true
});
</script>
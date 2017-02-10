    <div class="navbar navbar-inverse navbar-fixed-top">
      <div class="container header_con" style="padding:25px; border-bottom: 1px solid #C3C3C3;">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a id="logo" class="navbar-brand" href="
          <?php 
             echo $this->Html->url('/');

          ?>" data-toggle="tooltip" data-placement="bottom">
                                        <h8>WAW</h8><span style="color:#0C99D5;" class="glyphicon glyphicon-globe"></span><h9>team</h9><br/>
                                        <h10>online marketing tools</h10>
                                      </a>
        </div>
        
        <div class="collapse navbar-collapse">
          <ul class="nav navbar-nav">
            <?php 
                $segments = explode('/', trim(parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH), '/'));
                $numSegments = count($segments); 
                $currentSegment = $segments[$numSegments - 1];
                $currentSegment2 = $segments[$numSegments - 2];

                $wawpromarketing = false;
                $what_we_offer = false;
                $what_theyre_saying = false;
                $gallery = false;
                $start_earning_now = false;
                $products = false;

                //pr($currentSegment2);

                $prod_id = 'products/'.$currentSegment;
                switch($currentSegment){
                  case 'home';
                      $wawpromarketing = true;
                  break;
                  case 'home_edit';
                      $wawpromarketing = true;
                  break;
                  case 'what_we_offer';
                      $what_we_offer = true;
                  break;
                  case 'what_we_offer_edit';
                      $what_we_offer = true;
                  break;
                  case 'what_theyre_saying';
                      $what_theyre_saying = true;
                  break;
                  case 'what_theyre_saying_edit';
                      $what_theyre_saying = true;
                  break;
                  case 'gallery';
                      $gallery = true;
                  break;
                  case 'gallery_edit';
                      $gallery = true;
                  break;
                  case 'registration';
                      $start_earning_now = true;
                  break;
                  
                  case 'products';
                      $products = true;
                  break;
                  case 'products_edit';
                      $products = true;
                  break;
                }
                $user_ses = $this->Session->read('User');
                $username_ses = $this->Session->read('User.username');
                $usergroup_ses = $this->Session->read('User.group');
            ?>
            <?php if(!empty($user_ses)):?>
            
            <li <?php if($wawpromarketing) echo 'class="active"'; ?>><a href="<?php echo $this->Html->url(array('controller' => $this->Session->read('User.username'), 'action' => 'home'));?>">Home</a></li>
            <li <?php if($what_we_offer) echo 'class="active"'; ?>><a href="<?php echo $this->Html->url(array('controller' => $this->Session->read('User.username'), 'action' => 'what_we_offer'));?>">What we offer?</a></li>
            <li <?php if($what_theyre_saying) echo 'class="active"'; ?>><a href="<?php echo $this->Html->url(array('controller' => $this->Session->read('User.username'), 'action' => 'what_theyre_saying'));?>">What they're saying?</a></li>
            <li <?php if($start_earning_now) echo 'class="active"'; ?>><a href="<?php echo $this->Html->url(array('controller' => $this->Session->read('User.username'), 'action' => 'registration'));?>">Registration</a></li>
            <li <?php if($gallery) echo 'class="active"'; ?>><a href="<?php echo $this->Html->url(array('controller' => $this->Session->read('User.username'), 'action' => 'gallery'));?>">Gallery</a></li>
            <li <?php if($products) echo 'class="active"'; ?>><a href="<?php echo $this->Html->url(array('controller' => $this->Session->read('User.username'), 'action' => 'products'));?>">Products</a></li>
            
            <?php else:?>

            <li <?php if($wawpromarketing) echo 'class="active"'; ?>><a href="<?php echo $this->Html->url(array('controller' => $currentSegment2, 'action' => 'home'));?>">Home</a></li>
            <li <?php if($what_we_offer) echo 'class="active"'; ?>><a href="<?php echo $this->Html->url(array('controller' => $currentSegment2, 'action' => 'what_we_offer'));?>">What we offer?</a></li>
            <li <?php if($what_theyre_saying) echo 'class="active"'; ?>><a href="<?php echo $this->Html->url(array('controller' => $currentSegment2, 'action' => 'what_theyre_saying'));?>">What they're saying?</a></li>
            <li <?php if($gallery) echo 'class="active"'; ?>><a href="<?php echo $this->Html->url(array('controller' => $currentSegment2, 'action' => 'gallery'));?>">Gallery</a></li>
            <li <?php if($products) echo 'class="active"'; ?>><a href="<?php echo $this->Html->url(array('controller' => $currentSegment2, 'action' => 'products'));?>">Products</a></li>
            
            <?php endif;?>

          </ul>
          <ul class="nav navbar-nav" style="float: right;">
            <?php if(empty($user_ses)):?>
            <li>
              <a href="#" data-toggle="modal" data-target="#myModal">
              Sign in
              </a>
            </li>
          <?php elseif($usergroup_ses == 0 || $usergroup_ses == 1):?>
            <?php
                $enableEditing = false;
                if(!empty($user_ses)){
                  if($usergroup_ses == 0 || $usergroup_ses == 1){
                      $enableEditing = true;
                  }
                }

                if($enableEditing){
                  echo '
                        
                            <li class="edit"><a href="'.$this->Html->url(array('controller' => $this->Session->read('User.username'),'action' => $currentSegment.'_edit' )).'"><span class="glyphicon glyphicon-pencil"></span> Edit this page</a>
                            </li>
                            <li class="edit"><a href="'.$this->Session->read('User.facebook').'"><span class="fa fa-facebook"></span> Facebook</a>
                            </li>
                            <li class="edit"><a target="_blank" href="../app/webroot/js/ckeditor/plugins/fileman/index.html?type=image&CKEditor=TopicContent&CKEditorFuncNum=1&langCode=en"><span class="glyphicon glyphicon-list-alt"></span> File Manager</a>
                            </li>
                        
                  ';
                }
            ?>
            <li >
                <a href="<?php echo $this->Html->url(array('controller' => $this->Session->read('User.username'),'action' => 'profile?uid='.$this->Session->read('User.id'))); ?>">
              <span style="color:#0C99D5;" class="glyphicon glyphicon-user"></span>
              <?php echo $this->Session->read('User.username').' (admin)';?>
              </a>
            </li>

             <li>
               <a href="<?php echo $this->Html->url(array('controller' => 'mainsites','action' => 'logout')); ?>">
                
              Logout
              </a>
             </li>

          <?php elseif($usergroup_ses == 2):?>
            
            <li >
                <a href="<?php echo $this->Html->url(array('controller' => $this->Session->read('User.username'),'action' => 'profile?uid='.$this->Session->read('User.id'))); ?>">
                <span class="glyphicon glyphicon-user"></span>
              <?php echo $this->Session->read('User.username');?>
              </a>
            </li>
             <li>
               <a href="<?php echo $this->Html->url(array('controller' => 'mainsites','action' => 'logout')); ?>">
                
              Logout
              </a>
             </li>
          <?php endif;?> 
             
             
          </ul>
        </div><!--/.nav-collapse -->

      </div>
    </div>
    <?php 
    
    ?>
    <?php 

    if(!empty($user_ses) && $usergroup_ses < 2){
    if($enableEditing){
                  echo '
    <div class="editingTools">
     <ul>';
     if($currentSegment != 'home_edit' ){
     if($currentSegment != 'registration' && $currentSegment != 'what_we_offer_edit' && $currentSegment != 'what_theyre_saying_edit' & $currentSegment != 'gallery_edit' && $currentSegment != 'products_edit'){
     echo'
      <a href="'.$this->Html->url(array('controller' => $this->Session->read('User.username'),'action' => $currentSegment.'_edit' )).'">
         <li ><span style="padding-right:20px;" class="glyphicon glyphicon-pencil"></span>Edit this page
              </li>
       </a>
      ';
     }
      echo '<a href="'.$this->Session->read('User.facebook').'">
         <li ><span style="padding-right:20px;" class="fa fa-facebook"></span>Facebook
              </li>
       </a>';
      }
      echo '<a target="_blank" href="../app/webroot/js/ckeditor/plugins/fileman/index.html?type=image&CKEditor=TopicContent&CKEditorFuncNum=1&langCode=en">
         <li ><span style="padding-right:20px;" class="glyphicon glyphicon-list-alt"></span>File Mananger
              </li>
       </a>';
    if($usergroup_ses == 0){
     echo'
      <a href="'.$this->Html->url(array('controller' => 'mainsites','action' => 'confirmation' )).'">
         <li ><span style="padding-right:20px;" class="glyphicon glyphicon-book"></span> Requests
              </li>
       </a>
      ';
      }
    echo'
    </ul>
     </div>';
   }}?>
    <!--
    <div class="css-shapes-preview">

         <div class="vantage_con">
            <a href="http://vantageinternational.com.ph/site/">Vantage</a>
         </div>
       </div>
       -->
       <!-- modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <p class="con_sub_header2" style="font-family:sans-serif; font-size:30px;"><span class="glyphicon glyphicon-lock"></span> LOGIN</p>
      </div>
      <div class="modal-body">
        
    <div id="login_con" style="width:100%; border:none; height:auto;">
     <?php echo $this->Form->create('Mainsites',array('class' => 'form-horizontal','controller' => 'mainsites','action' => 'login'));?>
  <div class="form-group">
  
    <p class="con_sub_header2" style="font-size:14px;font-style:italic;">Please enter your WAW account to sign in.</p>
    <div class="col-sm-12">
      <input type="email" class="form-control login-inputs" name="email" id="inputEmail3" placeholder="Email">
    </div>
  </div>
  <div class="form-group">
   
    <div class="col-sm-12">
      <input type="password" class="form-control login-inputs" name="password" id="inputPassword3" placeholder="Password">
    </div>
  </div>
  <!--<div class="form-group">
    <div class="col-sm-offset-2 col-sm-10">
      <div class="checkbox">
        <label>
          <input type="checkbox"> Remember me
        </label>
      </div>
    </div>
  </div>-->
  <div class="form-group">
<!--<div class="col-sm-12">
  <p class="con_sub_header2" style="font-size:14px;font-style:italic;"><?php echo $this->Html->link('Register',array('controller' => 'mainsites','action' => 'register'));?> | <?php echo $this->Html->link('Forgot password?',array('controller' => 'mainsites','action' => 'forgot_password'));?></p>
</div>-->
</div>
  <br style="clear:both;"/>

    </div>

      </div>
      <div class="modal-footer">
        <div class="form-group" style="float:right;">
    <div class="col-sm-offset-2 col-sm-10">
      <button type="submit" class="btn btn-info">Sign in</button>
    </div>
  </div>
      </div>
      <?php echo $this->Form->end();?>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<script type="text/javascipt">
$('#myModal').on('shown.bs.modal', function () {
  $('#myInput').focus()
})
</script>
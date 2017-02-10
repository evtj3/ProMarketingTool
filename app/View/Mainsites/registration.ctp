
<div class="bodyContent">
  <?php if(!empty($this->params['url']['msg']) && $this->params['url']['msg'] == 'success' && !empty($this->params['url']['newuid'])):?>
    <div class="alert alert-success">
       <span class="glyphicon glyphicon-check"></span> <label><?php echo $this->params['url']['newuid'];?>'s</label> registration has been sent to WAW administrator. Please wait for confirmation.
    </div>
  <?php elseif(!empty($this->params['url']['msg']) && $this->params['url']['msg'] == 'fail' && !empty($this->params['url']['err']) && $this->params['url']['err'] == 1):?>
    <div class="alert alert-danger">
       <span class="glyphicon glyphicon-remove-sign"></span> <label>Sorry, File Error.</label> Your file is not an image. Please try again.
    </div>
  <?php elseif(!empty($this->params['url']['msg']) && $this->params['url']['msg'] == 'fail' && !empty($this->params['url']['err']) && $this->params['url']['err'] == 2 && !empty($this->params['url']['attno'])):?>
    <div class="alert alert-danger">
       <span class="glyphicon glyphicon-remove-sign"></span> <label>Sorry, File Error.</label> Attachment No. <?php echo $this->params['url']['attno'];?> is already exist.
    </div>
  <?php elseif(!empty($this->params['url']['msg']) && $this->params['url']['msg'] == 'fail' && !empty($this->params['url']['err']) && $this->params['url']['err'] == 3 && !empty($this->params['url']['attno'])):?>
    <div class="alert alert-danger">
       <span class="glyphicon glyphicon-remove-sign"></span> <label>Sorry, File Error.</label> Attachment No. <?php echo $this->params['url']['attno'];?> : File/s are too large, it exceeded the 20MB limit size to be upload.</div>
  <?php elseif(!empty($this->params['url']['msg']) && $this->params['url']['msg'] == 'fail' && !empty($this->params['url']['err']) && $this->params['url']['err'] == 4):?>
    <div class="alert alert-danger">
       <span class="glyphicon glyphicon-remove-sign"></span> <label>Sorry, File Error. Only JPG, JPEG, PNG & GIF files are allowed.</div>
  <?php endif;?>
    <!-- Videos-->
    <div class="row">
        <div class="col-md-13" >
            
            <p class="con_header">Registration</p>
              <p class="con_sub_header">By: WAW Administrator</p>
            
 
        </div>
    </div>
    <br style="clear:both;"/>
    <div class="row">
         
        <div class="col-md-1">
        </div>
        <div class="col-md-10 regis" >

          
             
            <div class="registration_form">
              
            	<p class="con_header">Register a new WAW member</p>
              <p class="con_sub_header">By: WAW Administrator</p>
              <hr/>

              <div class="form-group">
                  <?php 

                 // pr($this->request->params);
                 // pr($this->request->data);

                 ?>
                   <?php //echo $this->Form->create('Mainsites',array('controller' => $currentSegment,'action' => 'registration'));?>
                   <form action="<?php echo $this->Html->url(array('controller' => $currentSegment2,'action' => 'registration'));?>" method="post" enctype="multipart/form-data" /><!---->

                   <div class="row">
                    <br/>
                    <p class="con_sub_header">Personal Information</p>
                    <hr style="clear:both;"/>
                     <div class="col-md-4">
                        <div class="form-group <?php if($this->request->is('post'))echo $fname_msg;?>">
                          <label class="control-label" for="firstname">First Name <?php if($this->request->is('post'))echo $fname_iconmsg;?></label>
                          <input type="text" id="firstname" name="firstname" placeholder= "First Name" class="form-control" value="<?php if($this->request->is('post'))echo $fname;?>"/>
                        </div>
                     </div>
                     <div class="col-md-4">
                      <div class="form-group <?php if($this->request->is('post'))echo $mname_msg;?>">
                       <label class="control-label" for="middlename">Middle Name <?php if($this->request->is('post'))echo $mname_iconmsg;?></label>
                       <input type="text" id="middlename" name="middlename" placeholder="Middle Name" class="form-control" value="<?php if($this->request->is('post'))echo $mname;?>"/>
                      </div>
                      </div>
                      <div class="col-md-4">
                        <div class="form-group <?php if($this->request->is('post'))echo $lname_msg;?>">
                         <label class="control-label" for="lastname">Family Name <?php if($this->request->is('post'))echo $lname_iconmsg;?></label>
                         <input type="text" id="lastname" name="lastname" placeholder="Family Name" class="form-control" value="<?php if($this->request->is('post'))echo $lname;?>"/>
                        </div>
                      </div>
                      
                   </div>
                   <hr style="clear:both;"/>
                   <div class="row">
                     <div class="col-md-4">
                      <div class="form-group <?php if($this->request->is('post'))echo $ext_msg;?>">
                         <label class="control-label" for="ext">Ext <?php if($this->request->is('post'))echo $ext_iconmsg;?></label>
                         <input type="text" id="ext" name="ext" placeholder="Ex. Jr, III" class="form-control" value="<?php if($this->request->is('post'))echo $ext;?>"/>
                      </div>
                      </div>
                      <div class="col-md-4">
                        <div class="form-group <?php if($this->request->is('post'))echo $address_msg;?>">
                       <label  class="control-label" for="address">Address <?php if($this->request->is('post'))echo $address_iconmsg;?></label>
                       <input type="text" id="address" name="address" placeholder="Address" class="form-control" value="<?php if($this->request->is('post'))echo $personal_address;?>"/>
                     </div>
                     </div>
                     <div class="col-md-4">
                      <div class="form-group <?php if($this->request->is('post'))echo $birthdate_msg;?>">
                       <label class="control-label" for="birthdate">Birth Date <?php if($this->request->is('post'))echo $birthdate_iconmsg;?></label>
                       <input type="text" id="birthdate" name="birthdate" placeholder="Date" class="form-control" value="<?php if($this->request->is('post'))echo $birthdate;?>"/>
                      </div>
                     </div>
                   </div>
                  <hr style="clear:both;"/>
                  <div class="row">
                    <br/>
                    <p class="con_sub_header">Social Media</p>
                    <hr style="clear:both;"/>
                     <div class="col-md-6">
                      <div class="form-group <?php if($this->request->is('post'))echo $facebook_msg;?>">
                         <label class="control-label" for="facebook"><span class="fa fa-facebook"></span> <?php if($this->request->is('post'))echo $facebook_iconmsg;?></label>
                         <input type="text" id="facebook" name="facebook" placeholder="facebook page" class="form-control" value="<?php if($this->request->is('post'))echo $facebook;?>"/>
                       </div>
                     </div>
                     <div class="col-md-6">
                      <div class="form-group <?php if($this->request->is('post'))echo $twitter_msg;?>">
                         <label class="control-label" for="twitter"><span class="fa fa-twitter"></span> <?php if($this->request->is('post'))echo $twitter_iconmsg;?></label>
                         <input type="text" id="twitter" name="twitter" placeholder="twitter page" class="form-control" value="<?php if($this->request->is('post'))echo $twitter;?>"/>
                       </div>
                     </div>
                  </div>
                    
                    <hr style="clear:both;"/>
                  <div class="row">
                    <br/>
                    <p class="con_sub_header">User's Login Account</p>
                    <hr style="clear:both;"/>
                    <div class="col-md-6">
                      <div class="form-group <?php if($this->request->is('post'))echo $username_msg;?>">
                          <label class="control-label" for="username">Username <?php if($this->request->is('post'))echo $username_iconmsg;?></label>
                         <input type="text" id="username" name="username" placeholder="Ex. Johnsmith, RudyVan," class="form-control" value="<?php if($this->request->is('post'))echo $username;?>"/>
                         <p style="color:red; font-size:12px; font-style:italic;">* Special Characters are not allowed [!,@,#,$,%,^,&,*,(,),_,etc.], format should be [FirstnameLastname].</p>
                       </div>
                     </div>
                    <hr style="clear:both;"/>
                     <div class="col-md-6">
                      <div class="form-group <?php if($this->request->is('post'))echo $email_msg;?>">
                          <label class="control-label" for="email">E-mail Address <?php if($this->request->is('post'))echo $email_iconmsg;?></label>
                         <input type="email" id="email" name="email" placeholder="E-mail Address" class="form-control" value="<?php if($this->request->is('post'))echo $email;?>"/>
                       </div>
                     </div>
                     <div class="col-md-6">
                      <div class="form-group <?php if($this->request->is('post'))echo $cemail_msg;?>">
                          <label class="control-label" for="cemail">Confirm E-mail Address <?php if($this->request->is('post'))echo $cemail_iconmsg;?></label>
                         <input type="email" id="cemail" name="cemail" placeholder="E-mail Address" class="form-control" value="<?php if($this->request->is('post'))echo $cemail;?>" />
                      </div>
                     </div>
                  </div>
                   <hr style="clear:both;"/>
                  <div class="row">
                     <div class="col-md-6">
                      <div class="form-group <?php if($this->request->is('post'))echo $password_msg;?>">
                          <label class="control-label" for="password">Password <?php if($this->request->is('post'))echo $password_iconmsg;?></label>
                         <input type="password" id="password" name="password" placeholder="Password" class="form-control" />
                      </div>
                     </div>
                     <div class="col-md-6">
                      <div class="form-group <?php if($this->request->is('post'))echo $cpassword_msg;?>">
                          <label class="control-label" for="cpassword">Confirm Password <?php if($this->request->is('post'))echo $cpassword_iconmsg;?></label>
                         <input type="password" id="cpassword" name="cpassword" placeholder="Password" class="form-control" />
                       </div>
                     </div>
                  </div>
                  <hr style="clear:both;"/>
                  <div class="row">
                    <br/>
                    <p class="con_sub_header">Type of Membership</p>
                    <hr style="clear:both;"/>
                     <div class="col-md-6">
                      <div class="form-group">
                         <label class="control-label" for="membership">Select a type of membership</label>
                         <select id="membership" name="membership" class="form-control">
                               <option>Trial</option>
                               <option>Gold</option>
                         </select>
                       </div>
                     </div>
                  </div>
                  <hr style="clear:both;"/>
                  <div class="row">
                    <br/>
                    <p class="con_sub_header">Sponsors</p>
                    <hr style="clear:both;"/>
                     <div class="col-md-6">
                      <div class="form-group <?php if($this->request->is('post'))echo $sponsorsname_msg;?>">
                         <label class="control-label" for="sponsorsname">Sponsor's Name <?php if($this->request->is('post'))echo $sponsorsname_iconmsg;?></label>
                         <input type="text" id="sponsorsname" name="sponsorsname" placeholder="Sponsor's Name" class="form-control" value="<?php if($this->request->is('post'))echo $sponsorsname;?>"/>
                       </div>
                     </div>
                  </div>
                  

                <!--
                  <div class="row">

                    <br/>
                    <p class="con_sub_header">Attachments</p>
                         <hr style="clear:both;"/>
                         <p>[ N O T E ]: 
                          All files are uploaded in

                         <a target="_blank" href="../app/webroot/js/ckeditor/plugins/fileman/index.html?type=image&CKEditor=TopicContent&CKEditorFuncNum=1&langCode=en">
                         File Mananger</a>
                         <p style="font-size:12px;">
                          [ R E M I N D E R ]: Don't forget to attach the reciept of payment
                        </p>
                         </p>
                       
                       <input type="hidden" name="path_to_upload" value="../js/ckeditor/plugins/fileman/Uploads/attachments/"/>
                       <hr style="clear:both;"/>
                       <?php for($x=1;$x<=6;$x++){?>
                       
                       <div class="col-md-6"> 
                          <div class="form-group">
                            <label class="control-label" for="attachments<?php echo $x;?>">Attachment <?php echo $x;?></label>
                            <input type="text" name="attachments<?php echo $x;?>" class="form-control" id="attachments<?php echo $x;?>" placeholder="Put your image filename here.">
                          </div>
                       </div>
                       <?php }?>
                  </div>

                -->
                <div class="form-group">
                
             <!--
                  <div class="row">
                    <br/>
                    <p class="con_sub_header">Attachments</p>
                    <hr style="clear:both;"/>
                  <form action=".././app/webroot/uploads/upload.php" class="dropzone" id="my-awesome-dropzone"></form>
                  </div>
              <hr style="clear:both;"/>
              -->
                <!-- Attachments -->
                <!--<form method="post" action=".././app/webroot/uploads/upload.php" enctype="multipart/form-data" >-->
                  
                  
                  <div class="row">
                    <br/>
                    <p class="con_sub_header">Attachments</p>
                    <p style="font-size:12px;">
                          [ R E M I N D E R ]: Don't forget to attach the reciept of payment
                        </p>
                        <input type="hidden" name="path_to_upload" value="../js/ckeditor/plugins/fileman/Uploads/attachments/"/>
                         <hr style="clear:both;"/>
                     <div class="col-md-4">
                         
                         <input type="file" id="attachments1" name="attachments1" class="form-control" />
                         <input type="file" id="attachments2" name="attachments2" class="form-control" />
                     </div>
                     <div class="col-md-4">
                          <input type="file" id="attachments3" name="attachments3" class="form-control" />
                         <input type="file" id="attachments4" name="attachments4" class="form-control" /> 
                         
                     </div>
                     <div class="col-md-4">
                      <input type="file" id="attachments5" name="attachments5" class="form-control" />
                      <input type="file" id="attachments6" name="attachments6" class="form-control" />
                     </div>
                  </div>
                
                <!--</form>-->
                
                 <!---->
                 </div>
                  <hr style="clear:both;"/>
                  <div class="row">
                    <br/>
                    By clicking the submit request, you agree to our <a href="#">Terms and Conditions</a>.
                    
                  </div>
                  <hr style="clear:both;"/>
                  <input type="submit" value="Submit request to register" class="btn btn-default" />
                </form>

                   <?php //echo $this->Form->end();?>
              </div>
                   <!--
               <div class="form-group">
                 <div class="row">
                    <br/>
                    <p class="con_sub_header">Attachment</p>
                    <hr style="clear:both;"/>
                  <form action=".././app/webroot/uploads/upload.php" class="dropzone" id="my-awesome-dropzone"></form>
                  </div>
               </div>-->
            </div>
            
        </div>
        <div class="col-md-1">
        </div>
    </div>

</div>

<script type="text/javascript">
$('.bxslider1').bxSlider({
  minSlides: 1,
  maxSlides: 1,
  slideWidth: 390,
  slideMargin: 60,
  auto: true
});

</script>
<script>
  $(function() {
    
    $( "#birthdate" ).datepicker( 
      {
     
       dateFormat: "yy-mm-dd"
     }
      //"option", "dateFormat", "yy-mm-dd"

      //"option", "dateFormat", "yy-mm-dd"

      );

  });

  
  </script>
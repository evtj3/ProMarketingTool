<div class="bodyContent" style="margin:0;">
  <div class="log_reg_con">
    <div  id="login_con">
      <a id="logo" class="navbar-brand" href="
          <?php 
             echo $this->Html->url('/');

          ?>" data-toggle="tooltip" data-placement="bottom">
                                        <h8>WAW</h8><span style="color:#0C99D5;" class="glyphicon glyphicon-globe"></span><h9>team</h9><br/>
                                        <h10>online marketing tools</h10>
                                      </a>
<br style="clear:both;"/>
                                      <hr/>
     <?php echo $this->Form->create('Mainsites',array('class' => 'form-horizontal','controller' => 'mainsites','action' => 'login'));?>
  <div class="form-group">
    <br style="clear:both;"/>
    <p class="con_sub_header2" style="font-family:sans-serif; font-size:30px;"><span class="glyphicon glyphicon-lock"></span> LOGIN</p>
    <br style="clear:both;"/>
  
    <p class="con_sub_header2" style="font-size:14px;font-style:italic;"><?php echo $error_message;?></p>
    <div class="col-sm-12 <?php if($isEmailValid == 'yes') echo 'has-success has-feedback'; elseif($isEmailValid == 'no') echo $error_input;?>">
      <input type="email" class="form-control login-inputs" name="email" id="inputEmail3" placeholder="Email" value="<?php if(!empty($this->data)) echo$this->data['email'];?>">
      <?php if($isEmailValid == 'yes') echo '<span class="glyphicon glyphicon-ok form-control-feedback" aria-hidden="true"></span>
  <span id="inputSuccess2Status" class="sr-only">(success)</span>'; elseif($isEmailValid == 'no') echo $error_feedback;?>
    </div>
  </div>
  <div class="form-group">
   
    <div class="col-sm-12 <?php if($isPasswordValid == 'no') echo $error_input;?>">
      <input type="password" class="form-control login-inputs" name="password" id="inputPassword3" placeholder="Password">
      <?php if($isPasswordValid == 'no') echo $error_feedback;?>
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
<!--
<div class="col-sm-12">
  <p class="con_sub_header2" style="font-size:14px;font-style:italic;"><?php echo $this->Html->link('Register',array('controller' => 'mainsites','action' => 'register'));?> | <?php echo $this->Html->link('Forgot password?',array('controller' => 'mainsites','action' => 'forgot_password'));?></p>
</div>-->
</div>
  <br style="clear:both;"/>
  <div class="form-group" style="float:right;">
    <div class="col-sm-offset-2 col-sm-10">
      <button type="submit" class="btn btn-info">Sign in</button>
    </div>
  </div>
  <br style="clear:both"/>
<?php echo $this->Form->end();?>

    </div>
    
</div>
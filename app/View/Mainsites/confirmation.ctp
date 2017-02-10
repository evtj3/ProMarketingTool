<div class="bodyContent">
  <?php if(!empty($this->params['url']['msg']) && $this->params['url']['msg'] == 'success'):?>
    <div class="alert alert-success">
       <span class="glyphicon glyphicon-check"></span> You have created a new duplicated site.
    </div>
  <?php endif;?>
    <!-- Videos-->
    <div class="row">
        <div class="col-md-13" >
          
            <p class="con_header">List of Registration Requests</p>
              <p class="con_sub_header">By: WAW Administrator</p>
            
 
        </div>
    </div>
    <br style="clear:both;"/>
    <div class="row">
         
        <div class="col-md-1">
        </div>
        <div class="col-md-10 regis" >
           <?php echo $this->Form->create('Mainsites',array('controller' => 'mainsites','action' => 'confirmation'));?>
 
            <div class="registration_form">
                <input type="submit" value="Register checked account/s" class="form-control btn btn-default" />
                <hr style="clear:both;"/>
                <?php $count = 0;
                     $countAttachments = 0;
                ?>
                
                <?php foreach($User_db as $udb):?>
                
                <div class="col-md-6 ">
                	<br style="clear:both;"/>
                     <div style="padding:5px;" class="user_card">
                     <p>Date Created: <?php echo $udb['users']['created'];?></p>
                     <p>Name: <?php echo $udb['users']['firstname'].' '.$udb['users']['middlename'].' '.$udb['users']['lastname'].' '.$udb['users']['ext'];?></p>
                     <p>Birth Date: <?php echo $udb['users']['birthdate'];?></p>
                     <p>Type of Membership: <?php echo $udb['users']['membership'];?></p>
                     <p>Referer: <?php 
                     
                     foreach($referer_db as $rfdb){
                        if($rfdb['users']['id'] == $udb['users']['referer_id']){
                        	echo $rfdb['users']['firstname'].' '.$rfdb['users']['middlename'].' '.$rfdb['users']['lastname'].' '.$rfdb['users']['ext'].' ('.$rfdb['users']['username'].')';
                        }
                           
                     }

                     
                     ?></p>
                     <p>Sponsor's Name: <?php echo $udb['users']['sponsorsname'];?></p>

                     <p>Attachments:
                     <div class="row"> 
                     	<div class=" img_preview_con">
                        <?php foreach($udb['Attachment'] as $pp):?>
                         <?php $countAttachments += 1;?>
                         <div style="cursor:pointer;" class="col-md-4 img_preview" data-toggle="modal" data-target="#PreviewModal<?php echo $countAttachments;?>">
                             <img src="<?php echo $pp['image_path'];?>" class="form-control"/>
                         </div>
                        <?php endforeach;?>
                        </div>
                      </div>
                     </p>
                     <p>
                     	<div class="form-group">
                     	  <label>Confirm?</label>
                          <input type="checkbox" value="<?php echo $udb['users']['id'];?>" name="<?php echo $count;?>" class="form-control"/>
                      </div>
                     </p>
                     
                   </div>
                </div>
                <?php $count += 1;?>
                <?php endforeach;?> 
                <hr style="clear:both;"/>
                   <input type="submit" value="Register checked account/s" class="form-control btn btn-default" />
                   
                <br style="clear:both;"/>
                <?php //pr($User_db);?>
            </div>
            
        </div>
        <?php echo $this->Form->end();?>
        <div class="col-md-1">
        </div>
    </div>

</div>


<?php $countAttachments = 0;?>
            <?php foreach($User_db as $udb):?>
                <?php foreach($udb['Attachment'] as $pp):?>
                 <?php $countAttachments += 1;?>
<div  class="modal fade" id="PreviewModal<?php echo $countAttachments;?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog">
    <div class="modal-content attachments-preview">
      
      <div class="modal-body" >
        
        <div class="row">
            <div class="col-md-12">
              <label><?php echo $pp['name'];?></label>
                  <img style="width:100%; height:100%;" src="<?php echo $pp['image_path'];?>" />
            </div>
          
        </div>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<?php endforeach;?>
            <?php endforeach;?>

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
    $( "#birthdate" ).datepicker();
    $( "#birthdate" ).datepicker( "option", "dateFormat", "yy-mm-dd" );
  });
  "option", "dateFormat","yy-mm-dd"
  </script>
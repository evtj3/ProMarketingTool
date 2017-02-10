<?php $user_ses = $this->Session->read('User');
$username_ses = $this->Session->read('User.username');
$usergroup_ses = $this->Session->read('User.group');
?>
<div class="bodyContent">
  
  <p class="con_header">What we offer? page</p>
              <p class="con_sub_header">Editing the What we offer? Page's Content</p>
             <br style="clear:both;"/>
           
  <br style="clear:both;"/>
  <div class="row home_edit_con">
    <div class="col-md-12 ">

            <p class="con_header">WAW Online Marketing Tool Video Tutorials' Section</p>
              <p class="con_sub_header">by: WAW Administrator</p>
              <p class="con_sub_header2">Video for the tutorial</p>
            <?php echo $this->Form->create('Mainsites',array('controller' => 'mainsites','action'=>$currentSegment,'class' =>'form-horizontal'));?>
               <input type="hidden" name="wawTutorial_youtube_pages" value="<?php echo $currentSegment; ?>" />
                <input type="hidden" name="path_to_upload" value="../js/ckeditor/plugins/fileman/Uploads/videos/"/>
                <div class="form-group">
                     
                     <div class="col-sm-12">
                     
                      <br style="clear:both;"/>
                         
                          <label>Youtube: <span style="font-size:20px; "class="fa fa-youtube"></span></label>
                          <input type="text" name="wawTutorial_youtube" value="<?php 
                          if(!empty($Video_db))
                          echo $Video_db['videos']['youtube_link'];
                        ?>" class="form-control" id="wawTutorial_youtube" placeholder="Youtube Page Ex: https://www.youtube.com/embed/189KuJ5AC701"/>
                          <!---->

                     </div>
                     
                </div>
                
                <div class="form-group">
                     <div class="col-sm-offset-11 ">
                           <button type="submit" value="submit_wawTutorial" name="submit_wawTutorial" class="btn btn-default">Update</button>
                     </div>
                </div>
               <div class="form-group image_preview">
                  <label for="wawTutorial" class="">Current Video Updated</label> 
                  <?php if(!empty($Video_db)):?>
                  <div>
                  <p><iframe src="<?php echo $Video_db['videos']['youtube_link'];?>" width="500" height="281" frameborder="0" webkitAllowFullScreen mozallowfullscreen allowFullScreen></iframe>
                  </p><p><?php echo $Video_db['videos']['youtube_link'];?></p>
                </div><?php endif;?>
                </div>
                <!-- -->
             <?php echo $this->Form->end();?>
    </div>
</div>
<br style="clear:both;"/>
<br style="clear:both;"/>
<div class="row home_edit_con">
    <div class="col-md-12 ">
            <p class="con_header">Slider for Vantage Presentations' Section</p>
              <p class="con_sub_header">Total pictures uploaded: <?php echo count($Presentation_db);?></p>
              <p class="con_sub_header2">Images for the presentation</p>
            <?php echo $this->Form->create('Mainsites',array('controller' => 'mainsites','action'=>$currentSegment,'class' =>'form-horizontal'));?>
                <input type="hidden" name="path_to_upload" value="../js/ckeditor/plugins/fileman/Uploads/presentations/"/>
                <div class="form-group">
                     
                     <div class="col-sm-12">
                     
                      <br style="clear:both;"/>
                          <input type="text" name="presentations" class="form-control" id="presentations" placeholder="Put your image filename here.">
                          <br style="clear:both;"/>
                          <input type="text" name="presentations_name" class="form-control" id="presentations_name" placeholder="Image Name">
                         
                     </div>
                     
                </div>
                
                <div class="form-group">
                     <div class="col-sm-offset-11 ">
                           <button type="submit" value="submit_presentations" name="submit_presentations" class="btn btn-default"><span class="glyphicon glyphicon-plus"></span> Upload</button>
                     </div>
                </div>
                <div class="form-group img_preview_con">
                  <label for="presentations" class="">Current Image Uploaded</label> 
                  <div>
                  <?php foreach($Presentation_db as $pmdb):?>
                  <?php if($pmdb['presentations']['presentation1']):?>
                  <div class="col-sm-2 img_preview">
                   <?php echo $this->Html->image($pmdb['presentations']['image_path'], ['alt' => $pmdb['presentations']['image_name'],'class' => 'form-control']);?>
                   <a class="remove_btn" href="<?php echo $this->Html->url(array('controller' => 'mainsites','action' => 'what_we_offer_delete_presentations',$pmdb['presentations']['id']));?>"><span class="glyphicon glyphicon-remove"></span></a>
                   <p style="text-align:center;"><?php echo $pmdb['presentations']['image_name'];?></p>  
                  </div>
                  <?php endif;?>
                  <?php endforeach;?> 
                 </div>              
                </div>
             <?php echo $this->Form->end();?>
    </div>
   
  </div>
<br style="clear:both;"/>
<br style="clear:both;"/>
<div class="row home_edit_con">
    <div class="col-md-12 ">
            <p class="con_header">Slider for WAW Online Marketing Tool Presentations' Section</p>
              <p class="con_sub_header">Total pictures uploaded: <?php echo count($Presentation_db);?></p>
              <p class="con_sub_header2">Images for the presentation</p>
            <?php echo $this->Form->create('Mainsites',array('controller' => 'mainsites','action'=>$currentSegment,'class' =>'form-horizontal'));?>
                <input type="hidden" name="path_to_upload" value="../js/ckeditor/plugins/fileman/Uploads/presentations/"/>
                <div class="form-group">
                     
                     <div class="col-sm-12">
                     
                      <br style="clear:both;"/>
                          <input type="text" name="presentations2" class="form-control" id="presentations2" placeholder="Put your image filename here.">
                          <br style="clear:both;"/>
                          <input type="text" name="presentations2_name" class="form-control" id="presentations2_name" placeholder="Image Name">
                         
                     </div>
                     
                </div>
                
                <div class="form-group">
                     <div class="col-sm-offset-11 ">
                           <button type="submit" value="submit_presentations2" name="submit_presentations2" class="btn btn-default"><span class="glyphicon glyphicon-plus"></span> Upload</button>
                     </div>
                </div>
                <div class="form-group img_preview_con">
                  <label for="presentations2" class="">Current Image Uploaded</label> 
                  <div>
                  <?php foreach($Presentation_db as $pmdb):?>
                  <?php if($pmdb['presentations']['presentation2']):?>
                  <div class="col-sm-2 img_preview">
                   <?php echo $this->Html->image($pmdb['presentations']['image_path'], ['alt' => $pmdb['presentations']['image_name'],'class' => 'form-control']);?>
                   <a class="remove_btn" href="<?php echo $this->Html->url(array('controller' => 'mainsites','action' => 'what_we_offer_delete_presentations',$pmdb['presentations']['id']));?>"><span class="glyphicon glyphicon-remove"></span></a>
                   <p style="text-align:center;"><?php echo $pmdb['presentations']['image_name'];?></p>  
                  </div>
                 <?php endif;?>
                  <?php endforeach;?>
                 </div>              
                </div>
             <?php echo $this->Form->end();?>
    </div>
   
  </div>
  <br style="clear:both;"/>
<br style="clear:both;"/>
<div class="row home_edit_con">
    <div class="col-md-12 ">
            <p class="con_header">Packages' Section</p>
              <p class="con_sub_header">Total pictures uploaded: <?php echo count($Package_db);?></p>
              <p class="con_sub_header2">Images for the package</p>
            <?php echo $this->Form->create('Mainsites',array('controller' => 'mainsites','action'=>$currentSegment,'class' =>'form-horizontal'));?>
                <input type="hidden" name="path_to_upload" value="../js/ckeditor/plugins/fileman/Uploads/packages/"/>
                <div class="form-group">
                     
                     <div class="col-sm-12">
                     
                      <br style="clear:both;"/>
                          <input type="text" name="packages" class="form-control" id="packages" placeholder="Put your image filename here.">
                          <br style="clear:both;"/>
                          <input type="text" name="packages_name" class="form-control" id="packages_name" placeholder="Image Name">
                         
                     </div>
                     
                </div>
                
                <div class="form-group">
                     <div class="col-sm-offset-11 ">
                           <button type="submit" value="submit_packages" name="submit_packages" class="btn btn-default"><span class="glyphicon glyphicon-plus"></span> Upload</button>
                     </div>
                </div>
                <div class="form-group img_preview_con">
                  <label for="packages" class="">Current Image Uploaded</label> 
                  <div>
                  <?php foreach($Package_db as $pmdb):?>
                  <div class="col-sm-2 img_preview">
                   <?php echo $this->Html->image($pmdb['packages']['image_path'], ['alt' => $pmdb['packages']['image_name'],'class' => 'form-control']);?>
                   <a class="remove_btn" href="<?php echo $this->Html->url(array('controller' => 'mainsites','action' => 'what_we_offer_delete_packages',$pmdb['packages']['id']));?>"><span class="glyphicon glyphicon-remove"></span></a>
                   <p style="text-align:center;"><?php echo $pmdb['packages']['image_name'];?></p>  
                  </div>
                  <?php endforeach;?> 
                 </div>              
                </div>
             <?php echo $this->Form->end();?>
    </div>
   
  </div>
</div>
<?php $user_ses = $this->Session->read('User');
$username_ses = $this->Session->read('User.username');
$usergroup_ses = $this->Session->read('User.group');

?>
<div class="bodyContent">
  
  <p class="con_header">Gallery page</p>
              <p class="con_sub_header">Editing the Gallery Page's Content</p>
             <br style="clear:both;"/>
           
<br style="clear:both;"/>
<div class="row home_edit_con">
   <div class="col-md-12 ">

            <p class="con_header">Weekly Events' Section</p>
              <p class="con_sub_header">By: WAW Administrator</p>
              <p class="con_sub_header2">Weekly Video</p>
            <?php echo $this->Form->create('Mainsites',array('controller' => 'mainsites','action'=>$currentSegment,'class' =>'form-horizontal'));?>
               <input type="hidden" name="wawTutorial_youtube_pages" value="<?php echo $currentSegment; ?>" />
                <input type="hidden" name="path_to_upload" value="../js/ckeditor/plugins/fileman/Uploads/videos/"/>
                <div class="form-group">
                     
                     <div class="col-sm-12">
                      
                      
                        <?php if(empty($Video_db1)):?>
                        
                        <br style="clear:both;"/>

                        <label>Youtube: <span style="font-size:20px; "class="fa fa-youtube"></span></label>
                          <input type="hidden" name="total_videos" value="1"/>
                          <input type="text" name="wawTutorial_youtube_add" class="form-control" id="wawTutorial_youtube_add" placeholder="Youtube Page Ex: https://www.youtube.com/embed/189KuJ5AC70"/>
                          <?php else:?>

                          <br style="clear:both;"/>
                          <input type="hidden" name="wawTutorial_youtube_id1" value="<?php echo $Video_db1['videos']['id'];?>"/>
                          <label>Youtube: <span style="font-size:20px; "class="fa fa-youtube"></span></label>
                          <input type="text" name="wawTutorial_youtube1" value="<?php 
                          echo $Video_db1['videos']['youtube_link'];
                        ?>" class="form-control" id="wawTutorial_youtube1" placeholder="Youtube Page"/>

                        <?php endif;?>
                     </div>

                     
                </div>
                <?php if(empty($Video_db1)):?>
                 <div class="form-group">
                     <div class="col-sm-offset-11 ">
                           <button type="submit" value="submit_wawTutorial" name="submit_wawTutorial" class="btn btn-default">Add New</button>
                     </div>
                </div>
              <?php else:?>
              <div class="form-group">
                     <div class="col-sm-offset-11 ">
                           <button type="submit" value="submit_wawTutorial" name="submit_wawTutorial" class="btn btn-default">Update</button>
                     </div>
                </div>
              <?php endif;?>

               <div class="form-group image_preview">
                  <label for="wawTutorial" class="">Current Video Updated</label> 
                  <br style="clear:both;"/>
                  <?php foreach($Video_db as $vdb):?>
                   <?php if($vdb['videos']['video_count'] == 1):?>
                  <div style="float:left; margin-right:20px; ">
                  <p><iframe src="<?php echo $vdb['videos']['youtube_link'];?>" width="500" height="281" frameborder="0" webkitAllowFullScreen mozallowfullscreen allowFullScreen></iframe>
                  </p><p><?php echo $vdb['videos']['youtube_link'];?></p>
                </div>
              <?php endif;?>
                 <?php endforeach;?>
                </div>
                <!-- -->
             <?php echo $this->Form->end();?>

            <hr style="clear:both;"/>
              <p class="con_sub_header2">Weekly Images</p>
            <?php echo $this->Form->create('Mainsites',array('controller' => 'mainsites','action'=>$currentSegment,'class' =>'form-horizontal'));?>
                <input type="hidden" name="path_to_upload" value="../js/ckeditor/plugins/fileman/Uploads/weeklyevents/"/>
                <div class="form-group">
                     
                     <div class="col-sm-12">
                     
                      <br style="clear:both;"/>
                          <input type="text" name="weeklyevents_pics" class="form-control" id="weeklyevents_pics" placeholder="Put your image filename here.">
                          <br style="clear:both;"/>
                          <input type="text" name="weeklyevents_pics_name" class="form-control" id="weeklyevents_pics_name" placeholder="Image Name">
                         
                     </div>
                     
                </div>
                
                <div class="form-group">
                     <div class="col-sm-offset-11 ">
                           <button type="submit" value="submit_weeklyevents_pics" name="submit_weeklyevents_pics" class="btn btn-default"><span class="glyphicon glyphicon-plus"></span> Upload</button>
                     </div>
                </div>
                <div class="form-group img_preview_con">
                  <label for="weeklyevents_pics" class="">Current Image Uploaded</label> 
                  <div>
                  <?php foreach($Weeklyevent_db as $pmdb):?>
                  
                  <div class="col-sm-2 img_preview">
                   <?php echo $this->Html->image($pmdb['weeklyevents_pics']['image_path'], ['alt' => $pmdb['weeklyevents_pics']['image_name'],'class' => 'form-control']);?>
                   <a class="remove_btn" href="<?php echo $this->Html->url(array('controller' => 'mainsites','action' => 'weeklyevents_pics_delete',$pmdb['weeklyevents_pics']['id']));?>"><span class="glyphicon glyphicon-remove"></span></a>
                   <p style="text-align:center;"><?php echo $pmdb['weeklyevents_pics']['image_name'];?></p>  
                  </div>
                 
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
            
            <p class="con_header">Major Events' Section</p>
              <p class="con_sub_header">By: WAW Administrator</p>
              <p class="con_sub_header2">Major Video</p>
            <?php echo $this->Form->create('Mainsites',array('controller' => 'mainsites','action'=>$currentSegment,'class' =>'form-horizontal'));?>
               <input type="hidden" name="wawTutorial_youtube_pages" value="<?php echo $currentSegment; ?>" />
                <input type="hidden" name="path_to_upload" value="../js/ckeditor/plugins/fileman/Uploads/videos/"/>
                <div class="form-group">
                     
                     <div class="col-sm-12">
                      
                     
                        <?php if(empty($Video_db2)):?>
                        <br style="clear:both;"/>

                        <label>Youtube: <span style="font-size:20px; "class="fa fa-youtube"></span></label>
                          <input type="hidden" name="total_videos" value="2"/>
                          <input type="text" name="wawTutorial_youtube_add" class="form-control" id="wawTutorial_youtube_add" placeholder="Youtube Page Ex: https://www.youtube.com/embed/189KuJ5AC70"/>
                       <?php else:?>
                       <br style="clear:both;"/>
                       <input type="hidden" name="wawTutorial_youtube_id2" value="<?php echo $Video_db2['videos']['id'];?>"/>
                          <label>Youtube: <span style="font-size:20px; "class="fa fa-youtube"></span></label>
                          <input type="text" name="wawTutorial_youtube2" value="<?php 
                          echo $Video_db2['videos']['youtube_link'];
                        ?>" class="form-control" id="wawTutorial_youtube2" placeholder="Youtube Page"/>
                     <?php endif;?>
                     </div>

                     
                </div>
                
               
                <?php if(empty($Video_db2)):?>
                 <div class="form-group">
                     <div class="col-sm-offset-11 ">
                           <button type="submit" value="submit_wawTutorial2" name="submit_wawTutorial2" class="btn btn-default">Add New</button>
                     </div>
                </div>
              <?php else:?>
              <div class="form-group">
                     <div class="col-sm-offset-11 ">
                           <button type="submit" value="submit_wawTutorial2" name="submit_wawTutorial2" class="btn btn-default">Update</button>
                     </div>
                </div>
              <?php endif;?>
               <div class="form-group image_preview">
                  <label for="wawTutorial" class="">Current Video Updated</label> 
                  <br style="clear:both;"/>
                  <?php foreach($Video_db as $vdb):?>
                   <?php if($vdb['videos']['video_count'] == 2):?>
                  <div style="float:left; margin-right:20px; ">
                  <p><iframe src="<?php echo $vdb['videos']['youtube_link'];?>" width="500" height="281" frameborder="0" webkitAllowFullScreen mozallowfullscreen allowFullScreen></iframe>
                  </p><p><?php echo $vdb['videos']['youtube_link'];?></p>
                </div>
              <?php endif;?>
                 <?php endforeach;?>
                </div>
                <!-- -->
             <?php echo $this->Form->end();?>
            
            <hr style="clear:both;"/>
              <p class="con_sub_header2">Major Images</p>
            <?php echo $this->Form->create('Mainsites',array('controller' => 'mainsites','action'=>$currentSegment,'class' =>'form-horizontal'));?>
                <input type="hidden" name="path_to_upload" value="../js/ckeditor/plugins/fileman/Uploads/majorevents/"/>
                <div class="form-group">
                     
                     <div class="col-sm-12">
                     
                      <br style="clear:both;"/>
                          <input type="text" name="majorevents_pics" class="form-control" id="majorevents_pics" placeholder="Put your image filename here.">
                          <br style="clear:both;"/>
                          <input type="text" name="majorevents_pics_name" class="form-control" id="majorevents_pics_name" placeholder="Image Name">
                         
                     </div>
                     
                </div>
                
                <div class="form-group">
                     <div class="col-sm-offset-11 ">
                           <button type="submit" value="submit_majorevents_pics" name="submit_majorevents_pics" class="btn btn-default"><span class="glyphicon glyphicon-plus"></span> Upload</button>
                     </div>
                </div>
                <div class="form-group img_preview_con">
                  <label for="majorevents_pics" class="">Current Image Uploaded</label> 
                  <div>
                  <?php foreach($Majorevent_db as $pmdb):?>
                  
                  <div class="col-sm-2 img_preview">
                   <?php echo $this->Html->image($pmdb['majorevents_pics']['image_path'], ['alt' => $pmdb['majorevents_pics']['image_name'],'class' => 'form-control']);?>
                   <a class="remove_btn" href="<?php echo $this->Html->url(array('controller' => 'mainsites','action' => 'majorevents_pics_delete',$pmdb['majorevents_pics']['id']));?>"><span class="glyphicon glyphicon-remove"></span></a>
                   <p style="text-align:center;"><?php echo $pmdb['majorevents_pics']['image_name'];?></p>  
                  </div>
                 
                  <?php endforeach;?>
                 </div>              
                </div>
             <?php echo $this->Form->end();?>   
    </div>
   
  </div>
</div>
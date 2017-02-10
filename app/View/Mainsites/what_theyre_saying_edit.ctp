<?php $user_ses = $this->Session->read('User');
$username_ses = $this->Session->read('User.username');
$usergroup_ses = $this->Session->read('User.group');
?>
<div class="bodyContent">
  
  <p class="con_header">What they're saying? page</p>
              <p class="con_sub_header">Editing the What they're saying? Page's Content</p>
             <br style="clear:both;"/>
           
<br style="clear:both;"/>
<div class="row home_edit_con">
    <div class="col-md-12 ">
            <p class="con_header">WAW Team Testimonials' Section</p>
              <p class="con_sub_header">Total pictures uploaded: <?php echo count($Testimonial_db);?></p>
              <p class="con_sub_header2">Images for the presentation</p>
            <?php echo $this->Form->create('Mainsites',array('controller' => 'mainsites','action'=>$currentSegment,'class' =>'form-horizontal'));?>
                <input type="hidden" name="path_to_upload" value="../js/ckeditor/plugins/fileman/Uploads/testimonials/"/>
                <div class="form-group">
                     
                     <div class="col-sm-12">
                     
                      <br style="clear:both;"/>
                          <input type="text" name="testimonials" class="form-control" id="testimonials" placeholder="Put your image filename here.">
                          <br style="clear:both;"/>
                          <input type="text" name="testimonials_name" class="form-control" id="testimonials_name" placeholder="Image Name">
                          <br style="clear:both;"/>
                          <label for="testimonials_user">Personal Website Link of WAW Team Member:</label>
                         <select  class="form-control" id="testimonials_user" name="testimonials_user">
                         	<?php foreach($User_db as $udb):?>
                              <option value="<?php echo $udb['users']['id'];?>">
                              	
                              	<?php echo $udb['users']['username'];?></option>
                            <?php endforeach;?>
                         </select>
                     </div>
                     
                </div>
                
                <div class="form-group">
                     <div class="col-sm-offset-11 ">
                           <button type="submit" value="submit_testimonials" name="submit_testimonials" class="btn btn-default"><span class="glyphicon glyphicon-plus"></span> Upload</button>
                     </div>
                </div>
                <div class="form-group img_preview_con">
                  <label for="testimonials" class="">Current Image Uploaded</label> 
                  <div>
                  <?php foreach($Testimonial_db as $pmdb):?>
                  
                  <div class="col-sm-2 img_preview">
                   <?php echo $this->Html->image($pmdb['testimonials']['image_path'], ['alt' => $pmdb['testimonials']['image_name'],'class' => 'form-control']);?>
                   <a class="remove_btn" href="<?php echo $this->Html->url(array('controller' => 'mainsites','action' => 'what_theyre_saying_delete_presentations',$pmdb['testimonials']['id']));?>"><span class="glyphicon glyphicon-remove"></span></a>
                   <p style="text-align:center;"><?php echo $pmdb['testimonials']['image_name'];?></p>  
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

            <p class="con_header">WAW Online Marketing Tool Video Tutorials' Section</p>
              <p class="con_sub_header">By: WAW Administrator</p>
              <p class="con_sub_header2">Video for the tutorial</p>
            <?php echo $this->Form->create('Mainsites',array('controller' => 'mainsites','action'=>$currentSegment,'class' =>'form-horizontal'));?>
               <input type="hidden" name="wawTutorial_youtube_pages" value="<?php echo $currentSegment; ?>" />
                <input type="hidden" name="path_to_upload" value="../js/ckeditor/plugins/fileman/Uploads/videos/"/>
                <div class="form-group">
                     
                     <div class="col-sm-12">
                      <?php if(!empty($Video_db)):?>
                      <hr/>
                        Update Video's
                        <hr/>
                      <?php endif;?>
                      <?php $count_video = 0; ?>
                      <?php foreach($Video_db as $vdb):?>
                      <?php $count_video += 1; ?>
                      <br style="clear:both;"/>
                          <input type="hidden" name="video_id<?php echo $count_video;?>" value="<?php echo $vdb['videos']['id'];?>"/>
                          <label>Youtube <?php echo $vdb['videos']['video_count'];?>: <span style="font-size:20px; "class="fa fa-youtube"></span></label>
                          <input type="text" name="wawTutorial_youtube<?php echo $vdb['videos']['video_count'];?>" value="<?php 
                          echo $vdb['videos']['youtube_link'];
                        ?>" class="form-control" id="wawTutorial_youtube<?php echo $vdb['videos']['video_count'];?>" placeholder="Youtube Page EX: https://www.youtube.com/embed/189KuJ5AC70"/>

                    <?php endforeach;?>
                    <hr/>
                       Add new Video
                    <hr/>
                     <br style="clear:both;"/>
                         
                          <label>Youtube: <span style="font-size:20px; "class="fa fa-youtube"></span></label>
                          <input type="hidden" name="total_videos" value="<?php echo (count($Video_db) + 1);?>"/>
                          <input type="text" name="wawTutorial_youtube_add" class="form-control" id="wawTutorial_youtube_add" placeholder="Youtube Page Ex: https://www.youtube.com/embed/189KuJ5AC70"/>
                          <!---->
                     </div>

                     
                </div>
                
                <div class="form-group">
                     <div class="col-sm-offset-10 ">
                           <button type="submit" value="submit_wawTutorial" name="submit_wawTutorial" class="btn btn-default"><?php if(!empty($Video_db)):?>Update /<?php endif;?> Add New</button>
                     </div>
                </div>
               <div class="form-group image_preview">
                  <label for="wawTutorial" class="">Current Video Updated</label> 
                  <br style="clear:both;"/>
                  <?php foreach($Video_db as $vdb):?>
                  <div style="float:left; margin-right:20px; ">
                  <p><iframe src="<?php echo $vdb['videos']['youtube_link'];?>" width="500" height="281" frameborder="0" webkitAllowFullScreen mozallowfullscreen allowFullScreen></iframe>
                  </p><p><?php echo '<span style="font-size:20px; "class="fa fa-youtube"></span> '.$vdb['videos']['video_count'].'. '.$vdb['videos']['youtube_link'];?></p>
                </div>
                 <?php endforeach;?>
                </div>
                <!-- -->
             <?php echo $this->Form->end();?>
    </div>
</div>
</div>
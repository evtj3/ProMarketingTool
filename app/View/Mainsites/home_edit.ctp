<?php $user_ses = $this->Session->read('User');
$username_ses = $this->Session->read('User.username');
$usergroup_ses = $this->Session->read('User.group');

?>
<div class="bodyContent">
  
  <p class="con_header">Home page</p>
              <p class="con_sub_header">Editing the Home Page's Content</p>
             <br style="clear:both;"/>
             
  <br style="clear:both;"/>
  
  <div class="row home_edit_con">
    <div class="col-md-12 ">
            <p class="con_header">Slider for Models' Section</p>
              <p class="con_sub_header">Total pictures uploaded: <?php echo count($ProductModel_db);?></p>
              <p class="con_sub_header2">Image with Models</p>
            <?php echo $this->Form->create('Mainsites',array('controller' => 'mainsites','action'=>$currentSegment,'class' =>'form-horizontal'));?>
                <input type="hidden" name="path_to_upload" value="../js/ckeditor/plugins/fileman/Uploads/productModels/"/>
                <div class="form-group">
                     
                     <div class="col-sm-12">
                     
                      <br style="clear:both;"/>
                          <input type="text" name="productModels" class="form-control" id="productModels" placeholder="Put your image filename here.">
                          <br style="clear:both;"/>
                          <input type="text" name="productModels_name" class="form-control" id="productModels_name" placeholder="Image Name">
                         
                     </div>
                     
                </div>
                
                <div class="form-group">
                     <div class="col-sm-offset-11 ">
                           <button type="submit" value="submit_productModels" name="submit_productModels" class="btn btn-default"><span class="glyphicon glyphicon-plus"></span> Upload</button>
                     </div>
                </div>
                <div class="form-group img_preview_con">
                  <label for="productModels" class="">Current Image Uploaded</label> 
                  <div>
                  <?php foreach($ProductModel_db as $pmdb):?>
                  <div class="col-sm-2 img_preview">
                   <?php echo $this->Html->image($pmdb['models']['image_path'], ['alt' => $pmdb['models']['brand'],'class' => 'form-control']);?>
                   <a class="remove_btn" href="<?php echo $this->Html->url(array('controller' => 'mainsites','action' => 'home_delete_model',$pmdb['models']['id']));?>"><span class="glyphicon glyphicon-remove"></span></a>
                   <p style="text-align:center;"><?php echo $pmdb['models']['brand'];?></p>  
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
            <p class="con_header">Welcome's Section</p>
              <p class="con_sub_header">Total pics uploaded: <?php echo $total_userPpUploaded;?></p>
              <p class="con_sub_header2">Profile Picture</p>
            <?php echo $this->Form->create('Mainsites',array('controller' => 'mainsites','action'=>$currentSegment,'class' =>'form-horizontal'));?>
                <input type="hidden" name="path_to_upload" value="../js/ckeditor/plugins/fileman/Uploads/profilePics/"/>
                <input type="hidden" name="user_id" value="<?php echo $this->Session->read('User.id');?>"/>
                <div class="form-group">
                     
                     <div class="col-sm-12">
                     
                      <br style="clear:both;"/>
                          <input type="text" name="welcome" class="form-control" id="welcome" placeholder="Put your image filename here.">
                          <br style="clear:both;"/>
                          <input type="text" name="welcome_name" class="form-control" id="welcome_name" placeholder="Image Name">
                     </div>
                     
                </div>
                
                <div class="form-group">
                     <div class="col-sm-offset-11 ">
                           <button type="submit" name="submit_welcome" value="submit_welcome" class="btn btn-default"><span class="glyphicon glyphicon-plus"></span> Upload</button>
                     </div>
                </div>
                <div class="form-group img_preview_con">
                  <label for="welcome" class="">Current Image Uploaded</label> 
                  <div>
                  <?php foreach($User_db as $udb):?>
                     <?php foreach($udb['ProfilePic'] as $pp):?>
                     
                         <div class="col-sm-2 img_preview">
                          <?php echo $this->Html->image($pp['image_path'], ['alt' => $pp['image_name'],'class' => 'form-control']);?>
                          <a class="remove_btn" href="<?php echo $this->Html->url(array('controller' => 'mainsites','action' => 'home_delete_profilepic',$pp['id']));?>"><span class="glyphicon glyphicon-remove"></span></a>
                          <p style="text-align:center;"><?php echo $pp['image_name'];?></p>  
                         </div>
                     <?php endforeach;?>
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
            <p class="con_header">Brands' Section</p>
              <p class="con_sub_header">Total pictures uploaded: <?php echo count($Brand_db);?></p>
              <p class="con_sub_header2">Image for Specific Brand</p>
            <?php echo $this->Form->create('Mainsites',array('controller' => 'mainsites','action'=>$currentSegment,'class' =>'form-horizontal'));?>
                <input type="hidden" name="path_to_upload" value="../js/ckeditor/plugins/fileman/Uploads/brands/"/>
                <div class="form-group">
                     
                     <div class="col-sm-12">
                     
                      <br style="clear:both;"/>
                          <input type="text" name="brand" class="form-control" id="brand" placeholder="Put your image filename here.">
                          <br style="clear:both;"/>
                          <input type="text" name="brand_name" class="form-control" id="brand_name" placeholder="Image Name">
                     </div>
                     
                </div>
                
                <div class="form-group">
                     <div class="col-sm-offset-11 ">
                           <button type="submit" value="submit_brand" name="submit_brand" class="btn btn-default"><span class="glyphicon glyphicon-plus"></span> Upload</button>
                     </div>
                </div>
                <div class="form-group img_preview">
                  <label for="brand" class="">Current Image Uploaded</label> 
                   <div>
                  <?php foreach($Brand_db as $pmdb):?>
                  <div class="col-sm-2 img_preview">
                   <img src="<?php echo $pmdb['brands']['image_path'];?>" alt="<?php echo $pmdb['brands']['brand'];?>" class="form-control"/>
                   <a class="remove_btn" href="<?php echo $this->Html->url(array('controller' => 'mainsites','action' => 'home_delete_brand',$pmdb['brands']['id']));?>"><span class="glyphicon glyphicon-remove"></span></a>
                   <p style="text-align:center;"><?php echo $pmdb['brands']['brand'];?></p>  
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
            <p class="con_header">Quote's Section</p>
              
              <p class="con_sub_header2">Quote for the day</p>
            <?php echo $this->Form->create('Mainsites',array('controller' => 'mainsites','action'=>$currentSegment,'class' =>'form-horizontal'));?>
                <div class="form-group">
                     
                     <div class="col-sm-12">
                     
                      <br style="clear:both;"/>
                          <textarea name="quote" class="form-control" rows="3" id="quote" placeholder="Put your qoute here"></textarea>
                          
                          <br style="clear:both;"/>
                          <input type="text" value="" name="quote_name" class="form-control " id="quote_name" placeholder="Author's name">
                          
                     </div>
                     
                </div>
                
                <div class="form-group">
                     <div class="col-sm-offset-11 ">
                           <button type="submit" value="submit_quote" name="submit_quote" class="btn btn-default"> Update</button>
                     </div>
                </div>
                <div class="form-group">
                  <label for="brand" class="">Current Qoute Used</label> 
                   <?php foreach($Qoute_db as $q):?>
                   <p>"<?php echo $q['qoutes']['qoute'];?>"</p>
                   <p>by: <?php echo $q['qoutes']['author'];?></p>
                   <?php endforeach;?>
                </div>
             <?php echo $this->Form->end();?>
    </div>
   
  </div>
  <br style="clear:both;"/>
  <br style="clear:both;"/>
  <div class="row home_edit_con">
    <div class="col-md-12 ">
            <p class="con_header">Products' Section</p>
              <p class="con_sub_header">Total pics uploaded: 5</p>
              <p class="con_sub_header2">Image for product</p>
            <?php echo $this->Form->create('Mainsites',array('controller' => 'mainsites','action'=>$currentSegment,'class' =>'form-horizontal'));?>
                <input type="hidden" name="path_to_upload" value="../js/ckeditor/plugins/fileman/Uploads/products/"/>
                <div class="form-group">
                     
                     <div class="col-sm-12">
                     
                      <br style="clear:both;"/>
                          <input type="text" name="Products" class="form-control" id="Products" placeholder="Put your image filename here.">
                          <br style="clear:both;"/>
                          <input type="text" name="Products_name" class="form-control" id="Products_name" placeholder="Image Name">
                          
                          <br style="clear:both;">
                          <label for="Products_color2">Color</label>
                          <input type="hidden" maxlength="6" name="Products_color2" class="form-control" id="Products_color2" placeholder="color hex">
                          <div id="customWidget">

                            <div id="colorSelector2"><div style="background-color: #00ff00"></div></div>

                              <div id="colorpickerHolder2">
                              </div>
                           </div>
                           <!---->
                          <br style="clear:both;"/>
                          <div>
                          <label for="Product_size">Size</label>
                          <label class="checkbox-inline">
                            <input type="checkbox" name="Products_size_s" id="Products_size_s" value="S" aria-label="...">S
                          </label>
                          <label class="checkbox-inline">
                            <input type="checkbox" name="Products_size_m" id="Products_size_m" value="M" aria-label="...">M
                          </label>
                          <label class="checkbox-inline">
                            <input type="checkbox" name="Products_size_l" id="Products_size_l" value="L" aria-label="...">L
                          </label>
                          <label class="checkbox-inline">
                            <input type="checkbox" name="Products_size_xl" id="Products_size_xl" value="XL" aria-label="...">XL
                          </label>
                        </div>
                          <br style="clear:both;"/>
                          <label for="Products_brand">Brand</label>
                          <select class="form-control" name="Products_brand">
                          <?php foreach($Brand_db as $pmdb):?>
                          <option value="<?php echo $pmdb['brands']['id'];?>"><?php echo $pmdb['brands']['brand'];?></option>
                          <?php endforeach;?>
                          </select>
                          <br style="clear:both;"/>
                          <label for="Products_totalitem">Total Item Available</label>
                          <input type="text" name="Products_totalitemavailable" class="form-control" id="Products_totalitemavailable" placeholder="0">
                          <br style="clear:both;"/>
                          <label for="Products_prize">Prize</label>
                          <label class="sr-only" for="Products_prize">Amount (in dollars)</label>
                          <div class="input-group">
                            <div class="input-group-addon">PHP</div>
                            <input type="text" name="Products_prize" class="form-control" id="Products_prize" placeholder="Amount">
                            <div class="input-group-addon">.00</div>
                          </div>
                          <br style="clear:both;"/>
                          <div class="checkbox">
                          <label>
                            Featured
                            <input type="checkbox" name="Products_featured" id="Products_featured" value="1" aria-label="...">
                          </label>
                          </div>
                          <!---->
                     </div>
                     
                </div>
                
                <div class="form-group">
                     <div class="col-sm-offset-11 ">
                           <button type="submit" value="submit_Products" name="submit_Products" class="btn btn-default"><span class="glyphicon glyphicon-plus"></span> Upload</button>
                     </div>
                </div>
                <div class="form-group img_preview">
                  <label for="Products" class="">Current Image Uploaded</label> 
                  <div>
                    
                  <?php foreach($Brand_Product_db as $pmdb):?>
                  
                  <?php if(!empty($pmdb['Product'])):?>
                  <?php foreach($pmdb['Product'] as $pdb):?>
                  <input type="hidden" name="product_id" value="<?php echo $pdb['id'];?>"/>
                  <div class="col-sm-2 img_preview">
                   <img src="<?php echo $pdb['image_path'];?>" alt="<?php echo $pmdb['brands']['brand'];?>" class="form-control"/>
                   <a class="remove_btn" href="<?php echo $this->Html->url(array('controller' => 'mainsites','action' => 'home_delete_product',$pdb['id']));?>"><span class="glyphicon glyphicon-remove"></span></a>
                   <p style="text-align:center;"><?php echo $pmdb['brands']['brand'];?></p>
                   <p style="text-align:left;"><?php echo 'Item name: '.$pdb['item_name'];?></p>
                   <p style="text-align:left;"><?php echo 'Prize: PHP '.$pdb['prize'].'.00';?></p>
                   <p style="text-align:left;"><?php echo 'Total Item: '.$pdb['total'];?></p>
                   <?php if(!empty($pdb['color'])):?>
                   <p style="text-align:left;"><?php echo 'Color: '?><span style="font-size:20px; color:#<?php echo $pdb['color'];?>;" class="glyphicon glyphicon-stop"></span></p>  
                   <?php endif;?>
                   <?php if(!empty($pdb['size'])):?>
                   <p style="text-align:left;"><?php echo 'Size: '.$pdb['size'];?></p>  
                   <?php endif;?>
                   <?php if($pdb['featured'] == 1):?>
                   <p style="text-align:left;">
                    <label class="checkbox-inline"><?php echo 'Featured';?></label>
                   <a style="font-size:24px; padding-left:20px;" href="<?php echo $this->Html->url(array('controller' => 'mainsites','action' => 'home_edit_featured',$pdb['id']));?>" name="submit_Product_featured_update" class=""><span class="glyphicon glyphicon-check"><span></a>
                   </p>  
                   <?php elseif($pdb['featured'] == 0):?>
                  <p style="text-align:left;">
                    <label class="checkbox-inline"><?php echo 'Not Featured';?></label>
                   <a style="font-size:24px; padding-left:20px;" href="<?php echo $this->Html->url(array('controller' => 'mainsites','action' => 'home_edit_featured',$pdb['id']));?>" name="submit_Product_featured_update" class=""><span class="glyphicon glyphicon-unchecked"><span></a>
                   </p> 
                   <?php endif;?>
                   
                  </div>
                  <?php endforeach;?> 
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
            <p class="con_header">Subscription's Section</p>
              
              <p class="con_sub_header2">Social Medias</p>
            <?php echo $this->Form->create('Mainsites',array('controller' => 'mainsites','action'=>$currentSegment,'class' =>'form-horizontal'));?>
                <div class="form-group">
                     
                     <div class="col-sm-12">
                     
                      <br style="clear:both;"/>
                          Facebook: <span class="fa fa-facebook"></span>
                          <input type="text" name="social_media_fb" value="<?php echo $User_sm_db['users']['facebook'];?>"class="form-control" id="social_media_fb" placeholder="Facebook Page">
                          <br style="clear:both;"/>
                          Twitter: <span class="fa fa-twitter"></span>
                          <input type="text" name="social_media_twitter" value="<?php echo $User_sm_db['users']['twitter'];?>" class="form-control" id="social_media_twitter" placeholder="Twitter Page">
                          <!---->
                     </div>
                     
                </div>
                
                <div class="form-group">
                     <div class="col-sm-offset-11 ">
                           <button type="submit" value="submit_social_media" name="submit_social_media" class="btn btn-default">Update</button>
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
              <p class="con_sub_header">by: WAW Administrator</p>
              <p class="con_sub_header2">Video for the tutorial</p>
            <?php echo $this->Form->create('Mainsites',array('controller' => 'mainsites','action'=>$currentSegment,'class' =>'form-horizontal'));?>
                <input type="hidden" name="wawTutorial_youtube_pages" value="<?php echo $currentSegment; ?>" />
                <input type="hidden" name="path_to_upload" value="../js/ckeditor/plugins/fileman/Uploads/videos/"/>
                <div class="form-group">
                     
                     <div class="col-sm-12">
                     
                      <br style="clear:both;"/>
                          <!--<input type="text" name="wawTutorial" class="form-control" id="wawTutorial" placeholder="Put your Video filename here.">
                          <br style="clear:both;"/>
                          <input type="text" name="wawTutorial_name" class="form-control" id="wawTutorial_name" placeholder="Video Title">
                          <br style="clear:both;"/>
                          -->
                          <label>Youtube: <span style="font-size:20px; "class="fa fa-youtube"></span></label>
                          <input type="text" name="wawTutorial_youtube" value="<?php 
                          if(!empty($Video_db))
                          echo $Video_db['videos']['youtube_link'];
                        ?>" class="form-control" id="wawTutorial_youtube" placeholder="Youtube Page Ex: https://www.youtube.com/embed/189KuJ5AC70"/>
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
  </div>
</div>
<script type="text/javascript">

$('#Products_color2').ColorPicker({
  onSubmit: function(hsb, hex, rgb, el) {
    $(el).val(hex);
    $(el).ColorPickerHide();
  },
  onBeforeShow: function () {
    $(this).ColorPickerSetColor(this.value);
  }
})
.bind('keyup', function(){
  $(this).ColorPickerSetColor(this.value);
});

$('#colorSelector2').ColorPicker({
  color: '#0000ff',
  onShow: function (colpkr) {
    $(colpkr).fadeIn(500);
    return false;
  },
  onHide: function (colpkr) {
    $(colpkr).fadeOut(500);
    return false;
  },
  onChange: function (hsb, hex, rgb) {
    $('#colorSelector2 div').css('backgroundColor', '#' + hex);
    $('#Products_color2').val(hex); 
  }
});
</script>
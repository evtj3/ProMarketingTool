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
                   <a class="remove_btn" href="<?php echo $this->Html->url(array('controller' => 'mainsites','action' => 'products_delete',$pdb['id']));?>"><span class="glyphicon glyphicon-remove"></span></a>
                   <p style="text-align:center;"><?php echo $pmdb['brands']['brand'];?></p>
                   <p style="text-align:left;"><?php echo 'Item name: '.$pdb['item_name'];?></p>
                   <p style="text-align:left;"><?php echo 'Prize: PHP '.$pdb['prize'].'.00';?></p>
                   <p style="text-align:left;"><?php echo 'Total Item: '.$pdb['total'];?></p>
                   <?php if(!empty($pdb['color'])):?>
                   <p style="text-align:left;"><?php echo 'Color: '?><span style="font-size:20px; color:#<?php echo $pdb['color'];?>;" class="glyphicon glyphicon-stop"></span></p>  
                   <?php endif;?>

                   <?php if(!empty($pdb['sizes'])):?>
                   <p style="text-align:left;"><?php 
                   
                   $sizess = str_replace('[', ' ', $pdb['sizes']);
                   $sizess = str_replace(']', ' ', $sizess);
                   
                   //$sizess = explode('delimiter', $sizess);
                   echo 'Size: '.$sizess;
                   ?></p>  
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
  
  
  </div>
</div>
<script type="text/javascript">
//$('#colorpickerHolder2').ColorPicker({flat: true});
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
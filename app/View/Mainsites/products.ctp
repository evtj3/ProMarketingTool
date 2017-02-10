<?php $user_ses = $this->Session->read('User'); ?>
<?php $userid_ses = $this->Session->read('User.id'); ?>
<?php $username_ses = $this->Session->read('User.username');?>
<div class="bodyContent">
  <p class="con_header">Products</p>
  <p class="con_sub_header">By: WAW Administrator</p>
     <div class="row pro_bg">

        <div class="col-md-3 list_of_products" >
          <ul class="list_of_brands">
            
            <?php foreach($Brand_Product_db as $bpdb):?>
               <?php if(!empty($username_ses)):?>
               <a href="<?php echo $this->Html->url(array('controller' => $username_ses,'action' => 'products?bid='.$bpdb['brands']['id']));?>" style=""><li><?php echo $bpdb['brands']['brand'];?></li></a>
             <?php else:?>
               <a href="<?php echo $this->Html->url(array('controller' => $currentSegment2,'action' => 'products?bid='.$bpdb['brands']['id']));?>" style=""><li><?php echo $bpdb['brands']['brand'];?></li></a>
             <?php endif;?>
            <?php endforeach;?>

            <?php if(!empty($display_product_as)):?>
                 <?php if(!empty($username_ses)):?>
                 <a href="<?php echo $this->Html->url(array('controller' => $username_ses,'action' => 'products'));?>" ><li><span class="glyphicon glyphicon-arrow-left"></span> Back to list</li></a>
                 <?php else:?>
                 <a href="<?php echo $this->Html->url(array('controller' => $currentSegment2,'action' => 'products'));?>" ><li><span class="glyphicon glyphicon-arrow-left"></span> Back to list</li></a>
                 <?php endif;?>
          <?php endif;?>
          </ul>
        </div>
        
        <p class="con-header2"><?php echo 'Total Products Shown: '.$Product_db;?></p>
        
        <hr/>
        <div class="col-md-9">

             <?php //pr($Brand_Product_db);?>
            <?php foreach($Brand_Product_db as $bpdb):?>
                 
              
              <div class="list_of_products_by_brands">
                
                <ul class="prods">

                  <?php foreach($bpdb['Product'] as $bpdbs):?>

                  <li>
                      <?php echo $this->Html->image($bpdbs['image_path'], ['alt' => $bpdbs['item_name']]);?>
                      <a class="probra_details" href="#" data-toggle="modal" data-target="#myModalProducts<?php echo $bpdbs['id'];?>">Show Details</a>
                  </li>
                  
                  <?php endforeach;?>
                   <?php if(empty($bpdb['Product']) && !empty($display_product_as)):?>
               
                    <li style="background:none; font-size:20px;">No Products Available</li>

                  <?php endif;?>

                </ul>

              </div>

            <?php endforeach;?>
        </div>
       
     </div>
      
</div>
<?php foreach($Brand_Product_db as $bpdb):?>
<?php foreach($bpdb['Product'] as $bpdbs):?>


<?php echo $this->Form->create('Mainsites',array('action' => 'sold_products'));?>
<div  class="modal fade" id="myModalProducts<?php echo $bpdbs['id']?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <p class="con_sub_header2" style="font-family:sans-serif; font-size:30px;"><?php echo $bpdb['brands']['brand']?> products</p>
      </div>
      <div class="modal-body">
        <div class="preview_products">
          <?php echo $this->Html->image($bpdbs['image_path'], ['alt' => $bpdbs['item_name']]);?>
          
        </div>
        <hr/>
        <div class="row">
            <div class="col-md-6">
            <?php if(!empty($bpdbs['item_name'])):?>
            <p style="margin-left:28px;"><label>Item Name:</label> <?php echo $bpdbs['item_name'];?></p>
            <?php endif;?>
            <hr/>
            <?php if(!empty($bpdbs['prize'])):?>
            <p style="margin-left:28px;"><label>Prize:</label> PHP <?php echo $bpdbs['prize'];?></p>
            <?php endif;?>
            <hr/>
            <?php if(!empty($bpdbs['total'])):?>
            <p style="margin-left:28px;"><label>Total Item:</label> <?php echo $bpdbs['total'];?></p>
            <?php endif;?>
          </div>
          <div class="col-md-6">
            <?php if(!empty($bpdbs['item_name'])):?>
            <p style="margin-left:28px;"><label>Color:</label> <span style="font-size:20px; color:#<?php echo $bpdbs['color'];?>;" class="glyphicon glyphicon-stop"></span></p>
            <?php endif;?>
            <hr/>
            <?php if(!empty($bpdbs['item_name'])):?>
            <p style="margin-left:28px;"><label>Size:</label> <?php 
                $sizess = str_replace('[', ' ', $bpdbs['sizes']);
                   $sizess = str_replace(']', ' ', $sizess);
                   
                   //$sizess = explode('delimiter', $sizess);
                   echo $sizess;
            ?></p><?php endif;?>

            <input type="hidden" name="product_id" value="<?php echo $bpdbs['id'];?>"/>
            <input type="hidden" name="user_id" value="<?php echo $userid_ses;?>"/>
            <input type="hidden" name="sold_price" value="<?php echo $bpdbs['prize'];?>"/>
            <input type="hidden" name="date_sold" value="<?php echo date('Y-m-d H-i-s');?>"/>
          </div>
         </div>
      </div>
      <?php if(!empty($user_ses)):?>
      <div class="modal-footer">
        <div class="form-group" style="float:right;">
    <div class="col-sm-offset-2 col-sm-10">
      <button type="submit" class="btn btn-info"><span class="glyphicon glyphicon-plus"></span> Add to cart</button>
    </div>
  </div>
      </div>
    <?php endif;?>
      <?php echo $this->Form->end();?>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<?php echo $this->Form->end();?>


<?php endforeach;?>
<?php endforeach;?>
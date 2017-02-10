<?php

App::uses('MainsitesController', 'Controller');
App::uses('Mainsites', 'View');
App::import('Utility','Security');
App::import('Model','User');
App::import('Model','ProductModel');
App::import('Model','ProfilePic');
App::import('Model','Brand');
App::import('Model','Qoute');
App::import('Model','Product');
App::import('Model','Video');
App::import('Model','Presentation');
App::import('Model','Package');
App::import('Model','Testimonial');
App::import('Model','Weeklyevent');
App::import('Model','Majorevent');


class JoshuaMorelosController extends MainsitesController {

  public $components = array('Context','Paginator');

  public $uses = array();
 
  public function home(){
    
   $segments = explode('/', trim(parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH), '/'));
                $numSegments = count($segments); 
                $currentSegment = $segments[$numSegments - 1];
                $currentSegment2 = $segments[$numSegments - 2];
   $ProductModel = new ProductModel();
    $ProductModel_db = $ProductModel->find('all',array('fields' =>'id,brand,image_path,modified','recursive' => -1));
    $User = new User();
    $User_count = $User->find('count');
    $User_db = $User->ProfilePic->find('first',array('conditions'=>array(
      'user_id' => $this->Session->read('User.id')
      ),'order' => 'modified DESC','recursive' => 1));
    $User_db2 = $User->find('first',array('conditions' => array(
      'username' => $currentSegment2
      ),'order' => 'modified DESC','recursive' => 1));
    $Brand = new Brand();
    $Brand_db = $Brand->find('all',array('recursive' => -1));
    $Qoute = new Qoute();
    $Qoute_db = $Qoute->find('first',array('conditions' => array(
    'id' => 1
      ),'recursive' => -1));
    $Product = new Product();
    $Product_db = $Product->find('all',array('recursive' => -1));
    $Video = new Video();
    $Video_db = $Video->find('first',array('conditions' => array(
      'pages' => 'home_edit'
      ),'recursive' => -1));
    $this->set(compact('ProductModel_db','User_db','User_db2','Brand_db','Qoute_db','Product_db','User_count','Video_db'));
   /*phpinfo();*/
   $this->render('/Mainsites/'.$currentSegment);
  }
  public function home_edit(){
    $this->Context->checkSession($this);
    $this->Context->doNotPermit($this, '2');
    $segments = explode('/', trim(parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH), '/'));
                $numSegments = count($segments); 
                $currentSegment = $segments[$numSegments - 1];

    $ProductModel = new ProductModel();
    $ProductModel_db = $ProductModel->find('all',array('fields' =>'id,brand,image_path,modified','recursive' => -1));
    $User = new User();

    $User_db = $User->find('all',array('conditions'=>array(
      'id' => $this->Session->read('User.id')
      ),'recursive' => 1));
    $User_sm_db = $User->find('first',array('fields' => 'facebook,twitter','conditions'=>array(
      'id' => $this->Session->read('User.id')
      ),'recursive' => 1));
    $total_userPpUploaded = $User->ProfilePic->find('count',array('conditions' => array(
       'user_id' => $this->Session->read('User.id')
      )));
    $Brand = new Brand();
    $Brand_db = $Brand->find('all',array('recursive' => -1));
    $Qoute = new Qoute();
    $Qoute_db = $Qoute->find('all',array('recursive' => -1));
    $Product = new Product();
    $Product_db = $Product->find('all',array('recursive' => -1));
    $Brand_Product_db = $Brand->find('all',array('recursive' => 1));
    $Video = new Video();
    $Video_db = $Video->find('first',array('conditions' => array(
      'pages' => $currentSegment
      ),'recursive' => -1));
    
    $this->set(compact('currentSegment','ProductModel_db','User_db','total_userPpUploaded','Brand_db','Qoute_db','Product_db','Brand_Product_db','User_sm_db','Video_db'));
    $this->render('/Mainsites/'.$currentSegment);
  }
  
  public function what_we_offer(){
  $segments = explode('/', trim(parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH), '/'));
                $numSegments = count($segments); 
                $currentSegment = $segments[$numSegments - 1];
                $currentSegment2 = $segments[$numSegments - 2];
    $Presentation = new Presentation();
    $Presentation_db = $Presentation->find('all',array('fields' =>'id,presentation1,presentation2,image_name,image_path,modified','recursive' => -1));
    $User = new User();
    $User_db2 = $User->find('first',array('conditions' => array(
      'username' => $currentSegment2
      ),'order' => 'modified DESC','recursive' => 1));
    $Video = new Video();
    $Video_db = $Video->find('first',array('conditions' => array(
      'pages' => 'what_we_offer_edit'
      ),'recursive' => -1));
    $Package = new Package();
    $Package_db = $Package->find('all',array('fields' =>'id,image_name,image_path,modified','recursive' => -1));
    $this->set(compact('Video_db','Presentation_db','Package_db','User_db2','currentSegment2'));
  $this->render('/Mainsites/'.$currentSegment);
  }
  public function what_we_offer_edit(){
      $this->Context->checkSession($this);
    $this->Context->doNotPermit($this, '2');
      $segments = explode('/', trim(parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH), '/'));
                $numSegments = count($segments); 
                $currentSegment = $segments[$numSegments - 1];
    $Presentation = new Presentation();
    $Presentation_db = $Presentation->find('all',array('fields' =>'id,presentation1,presentation2,image_name,image_path,modified','recursive' => -1));
    $Video = new Video();
    $Video_db = $Video->find('first',array('conditions' => array(
      'pages' => $currentSegment
      ),'recursive' => -1));
    $Package = new Package();
    $Package_db = $Package->find('all',array('fields' =>'id,image_name,image_path,modified','recursive' => -1));
    
      $this->set(compact('currentSegment','Video_db','Presentation_db','Package_db'));
      $this->render('/Mainsites/'.$currentSegment);
  }
  
  public function what_theyre_saying(){
     $segments = explode('/', trim(parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH), '/'));
                $numSegments = count($segments); 
                $currentSegment = $segments[$numSegments - 1];
     $Testimonial = new Testimonial();
     $Testimonial_db = $Testimonial->find('all');
     $User = new User();
     $User_db = $User->find('all',array('fields' => 'id,username','recursive' => 1));
     $Video = new Video();
     $Video_db = $Video->find('all',array('conditions' => array(
      'pages' => $currentSegment.'_edit'
      ),'recursive' => -1));
     
     $this->set(compact('currentSegment','Testimonial_db','User_db','Video_db'));
      $this->render('/Mainsites/'.$currentSegment);
   
  }
  public function what_theyre_saying_edit(){
     $this->Context->checkSession($this);
     $this->Context->doNotPermit($this, '2');
     $segments = explode('/', trim(parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH), '/'));
                $numSegments = count($segments); 
                $currentSegment = $segments[$numSegments - 1];
     $Testimonial = new Testimonial();
     $Testimonial_db = $Testimonial->find('all');
     $User = new User();
     $User_db = $User->find('all',array('fields' => 'id,username','recursive' => 1));
     $Video = new Video();
     $Video_db = $Video->find('all',array('conditions' => array(
      'pages' => $currentSegment
      ),'recursive' => -1));
     
     
     $this->set(compact('currentSegment','Testimonial_db','User_db','Video_db'));
      $this->render('/Mainsites/'.$currentSegment);
     
  }
 
  public function gallery(){
     $segments = explode('/', trim(parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH), '/'));
                $numSegments = count($segments); 
                $currentSegment = $segments[$numSegments - 1];
     $Video = new Video();
     $Video_db = $Video->find('all',array('conditions' => array(
      'pages' => $currentSegment.'_edit'
      ),'recursive' => -1));
     $Weeklyevent = new Weeklyevent();
     $Weeklyevent_db = $Weeklyevent->find('all',array('recursive' => -1));
     $Majorevent = new Majorevent();
     $Majorevent_db = $Majorevent->find('all',array('recursive' => -1));

     $this->set(compact('currentSegment','Video_db','Weeklyevent_db','Majorevent_db'));
      $this->render('/Mainsites/'.$currentSegment);
   
  }
  public function gallery_edit(){
    $this->Context->checkSession($this);
     $this->Context->doNotPermit($this, '2');
     $segments = explode('/', trim(parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH), '/'));
                $numSegments = count($segments); 
                $currentSegment = $segments[$numSegments - 1];
     $Video = new Video();
     $Video_db = $Video->find('all',array('conditions' => array(
      'pages' => $currentSegment
      ),'recursive' => -1));
     $Video_db1 = $Video->find('first',array('conditions' => array(
      'pages' => $currentSegment,
      'video_count' => 1
      ),'recursive' => -1));
    
    $Video_db2 = $Video->find('first',array('conditions' => array(
      'pages' => $currentSegment,
      'video_count' => 2
      ),'recursive' => -1));
     $Weeklyevent = new Weeklyevent();
     $Weeklyevent_db = $Weeklyevent->find('all',array('recursive' => -1));
     $Majorevent = new Majorevent();
     $Majorevent_db = $Majorevent->find('all',array('recursive' => -1));
    
     $this->set(compact('currentSegment','Video_db','Video_db1','Video_db2','Weeklyevent_db','Majorevent_db'));
      $this->render('/Mainsites/'.$currentSegment);
    
  }
 
  public function registration(){
    $this->Context->checkSession($this);
    $this->Context->doNotPermit($this, '2');

    $secu = new Security();
    $User  = new User();
    $segments = explode('/', trim(parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH), '/'));
                $numSegments = count($segments); 
                $currentSegment = $segments[$numSegments - 1];
                $currentSegment2 = $segments[$numSegments - 2];
    if($this->request->is('post')){
    
    $fname = $this->request->data['firstname'];
    $mname = $this->request->data['middlename'];
    $lname = $this->request->data['lastname'];
    $ext = $this->request->data['ext'];
    $personal_address = $this->request->data['address'];
    $birthdate = $this->request->data['birthdate'];
    $facebook = $this->request->data['facebook'];
    $twitter = $this->request->data['twitter'];
    $username = $this->request->data['username'];
    $email = $this->request->data['email'];
    $cemail = $this->request->data['cemail'];
    $password = $this->request->data['password'];
    $cpassword = $this->request->data['cpassword'];
    $membership = $this->request->data['membership'];
    $sponsorsname = $this->request->data['sponsorsname'];
    $path_to_upload = $this->request->data['path_to_upload'];
    
    $attachments1 = $this->request->params['form']['attachments1'];
    $attachments2 = $this->request->params['form']['attachments2'];
    $attachments3 = $this->request->params['form']['attachments3'];
    $attachments4 = $this->request->params['form']['attachments4'];
    $attachments5 = $this->request->params['form']['attachments5'];
    $attachments6 = $this->request->params['form']['attachments6'];
    

    $error_msg = 'has-error';
    $warning_msg = 'has-warning';
    $success_msg = 'has-success';
    $error_iconmsg = '<span class="glyphicon glyphicon-remove-sign"></span>';
    $warning_iconmsg = '<span class="glyphicon glyphicon-exclamation-sign"></span>';
    $success_iconmsg = '<span class="glyphicon glyphicon-ok-sign"></span>';
    
    
    
    $fname_c = ctype_alpha($fname);
    $isFnameOk = false;
      if(empty($fname)){
           $fname_msg = $warning_msg;
           $fname_iconmsg = $warning_iconmsg.' - <label style="font-size:12px;" >Please, Fill this up.</label>';

      }elseif(!empty($fname) && $fname_c){
           $fname_msg = $success_msg;
           $fname_iconmsg = $success_iconmsg;
           $isFnameOk = true;
      }elseif(empty($fname_c)){ 
           $fname_msg = $error_msg;
           $fname_iconmsg = $error_iconmsg.' - <label style="font-size:12px;" >Only letters are allowed.</label>';
      }
      $mname_c = ctype_alpha($mname);
      $isMnameOk = false;
      if(empty($mname)){
           $mname_msg = $warning_msg;
           $mname_iconmsg = $warning_iconmsg.' - <label style="font-size:12px;" >Please, Fill this up.</label>';

      }elseif(!empty($mname) && $mname_c){
           $mname_msg = $success_msg;
           $mname_iconmsg = $success_iconmsg;
           $isMnameOk = true;
      }elseif(empty($mname_c)){ 
           $mname_msg = $error_msg;
           $mname_iconmsg = $error_iconmsg.' - <label style="font-size:12px;" >Only letters are allowed.</label>';
      }
      $lname_c = ctype_alpha($lname);
      $isLnameOk = false;
      if(empty($lname)){
           $lname_msg = $warning_msg;
           $lname_iconmsg = $warning_iconmsg.' - <label style="font-size:12px;" >Please, Fill this up.</label>';

      }elseif(!empty($lname) && $lname_c){
           $lname_msg = $success_msg;
           $lname_iconmsg = $success_iconmsg;
           $isLnameOk = true;
      }elseif(empty($lname_c)){ 
           $lname_msg = $error_msg;
           $lname_iconmsg = $error_iconmsg.' - <label style="font-size:12px;" >Only letters are allowed.</label>';
      }
      
      $isExtOk = true;
      $ext_msg = '';
      $ext_iconmsg = '';
      
      $isAddressOk = false;
      if(empty($personal_address)){
           $address_msg = $warning_msg;
           $address_iconmsg = $warning_iconmsg.' - <label style="font-size:12px;" >Please, Fill this up.</label>';

      }elseif(!empty($personal_address)){
           $address_msg = $success_msg;
           $address_iconmsg = $success_iconmsg;
           $isAddressOk = true;
      }
      
      $isBirthdateOk = false;

      if(empty($birthdate)){
           $birthdate_msg = $warning_msg;
           $birthdate_iconmsg = $warning_iconmsg.' - <label style="font-size:12px;" >Please, Fill this up.</label>';

      }elseif(!empty($birthdate)){
           $birthdate_msg = $success_msg;
           $birthdate_iconmsg = $success_iconmsg;
           $isBirthdateOk = true;
      }

      $isFacebookOk = true;
      $facebook_msg = '';
      $facebook_iconmsg = '';
      
      $isTwitterOk = true;
      $twitter_msg = '';
      $twitter_iconmsg = '';
     
   
   $User_db_username = $User->find('first',array('conditions' => array(
     'username' => $username
    ),'recursive' => -1));
    $username_c = ctype_alpha($username);
    $isUsernameOk = false;
      if(empty($username)){
           $username_msg = $warning_msg;
           $username_iconmsg = $warning_iconmsg.' - <label style="font-size:12px;" >Please, Fill this up.</label>';

      }elseif(!empty($username) && $username_c && !empty($User_db_username['users']['username'])){
           $username_msg = $error_msg;
           $username_iconmsg = $error_iconmsg.' - <label style="font-size:12px;" >'.$username.' is already in used. Please try again</label>';
      }elseif(!empty($username) && $username_c){
           $username_msg = $success_msg;
           $username_iconmsg = $success_iconmsg;
           $isUsernameOk = true;
      }elseif(empty($username_c)){ 
           $username_msg = $error_msg;
           $username_iconmsg = $error_iconmsg.' - <label style="font-size:12px;" >Only letters are allowed.</label>';
      }
      $User_db_email = $User->find('first',array('conditions' => array(
     'email' => $email
    ),'recursive' => -1));
      $isEmailOk = false;
      if(empty($email)){
           $email_msg = $warning_msg;
           $email_iconmsg = $warning_iconmsg.' - <label style="font-size:12px;" >Please, Fill this up.</label>';

      }elseif(!empty($email) && !empty($User_db_email['users']['email'])){
           $email_msg = $error_msg;
           $email_iconmsg = $error_iconmsg.' - <label style="font-size:12px;" >'.$email.' is already in used. Please try again.</label>';
      }elseif(!empty($email)){
           $email_msg = $success_msg;
           $email_iconmsg = $success_iconmsg;
           $isEmailOk = true;
      }

      $isCemailOk = false;
      if(empty($cemail)){
           $cemail_msg = $warning_msg;
           $cemail_iconmsg = $warning_iconmsg.' - <label style="font-size:12px;" >Please, Fill this up.</label>';

      }elseif($cemail != $email){ 
           $cemail_msg = $error_msg;
           $cemail_iconmsg = $error_iconmsg.' - <label style="font-size:12px;" >Email does not match!</label>';
      }elseif(!empty($cemail) && !empty($User_db_email['users']['email'])){
           $cemail_msg = $error_msg;
           $cemail_iconmsg = $error_iconmsg.' - <label style="font-size:12px;" >'.$email.' is already in used. Please try again.</label>';
      }elseif(!empty($cemail)){
           $cemail_msg = $success_msg;
           $cemail_iconmsg = $success_iconmsg;
           $isCemailOk = true;
      }
      
      $isPasswordOk = false;
      if(empty($password)){
           $password_msg = $warning_msg;
           $password_iconmsg = $warning_iconmsg.' - <label style="font-size:12px;" >Please, Fill this up.</label>';

      }elseif($password != $cpassword){ 
           $password_msg = $error_msg;
           $password_iconmsg = $error_iconmsg.' - <label style="font-size:12px;" >Password does not match!</label>';
      }elseif(!empty($password)){
           $password_msg = $success_msg;
           $password_iconmsg = $success_iconmsg;
           $isPasswordOk = true;
      }

      $isCpasswordOk = false;
      if(empty($cpassword)){
           $cpassword_msg = $warning_msg;
           $cpassword_iconmsg = $warning_iconmsg.' - <label style="font-size:12px;" >Please, Fill this up.</label>';

      }elseif($cpassword != $password){ 
           $cpassword_msg = $error_msg;
           $cpassword_iconmsg = $error_iconmsg.' - <label style="font-size:12px;" >Password does not match!</label>';

      }elseif(!empty($cpassword)){
           $cpassword_msg = $success_msg;
           $cpassword_iconmsg = $success_iconmsg;
           $isCpasswordOk = true;
      }
      
    $isSponsornameOk = false;
      if(empty($sponsorsname)){
           $sponsorsname_msg = $warning_msg;
           $sponsorsname_iconmsg = $warning_iconmsg.' - <label style="font-size:12px;" >Please, Fill this up.</label>';

      }elseif(!empty($sponsorsname)){
           $sponsorsname_msg = $success_msg;
           $sponsorsname_iconmsg = $success_iconmsg;
           $isSponsornameOk = true;
      }elseif(empty($sponsorsname)){ 
           $sponsorsname_msg = $error_msg;
           $sponsorsname_iconmsg = $error_iconmsg.' - <label style="font-size:12px;" >Only letters are allowed.</label>';
      }


          
$root_folder = 'wawpromarketingtool/';
$target_dir = '.././webroot/js/ckeditor/plugins/fileman/Uploads/attachments/';
$uploadOk = 1;
$Complete_upload = false;
#-------------------------------------------------------

if(!empty($attachments1) || !empty($attachments2) || !empty($attachments3) || !empty($attachments4) || !empty($attachments5) || !empty($attachments6)){
          $data_attach = array(
            'a1' => $attachments1,
            'a2' => $attachments2,
            'a3' => $attachments3,
            'a4' => $attachments4,
            'a5' => $attachments5,
            'a6' => $attachments6
            );
          //--------------------------------------------------------



          //--------------------------------------------------------
          $x_add = '';
          for($x=1;$x<=count($data_attach);$x++){
            
            if(!empty($data_attach['a'.$x]) && !empty($data_attach['a'.$x]['tmp_name'])){

$target_file = $target_dir . $data_attach['a'.$x]["name"];

$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);

      // Check if image file is a actual image or fake image

    $check = getimagesize($data_attach['a'.$x]["tmp_name"]);
    if($check !== false) {
        echo "File is an image - " . $check["mime"] . ".";
        $uploadOk = 1;
    } else {
        echo "File is not an image.";
        $uploadOk = 0;
        return $this->redirect(array('controller' => $this->Session->read('User.username'),'action' => $currentSegment.'?msg=fail&err=1'));
       
        //pr("File is not an image.");
    }
// Check if file already exists
if (file_exists($target_file)) {
    //echo "Sorry, file already exists.";
    $uploadOk = 0;
    if($x == 6)
    $x_add .= $x;
    else
    $x_add .= $x.', ';
    //return http_redirect($root_folder.'mainsites/registration?msg=0&err=2');
    return $this->redirect(array('controller' => $this->Session->read('User.username'),'action' => $currentSegment.'?msg=fail&err=2&attno='.$x_add));
    //pr("Sorry, file already exists.");
}

// Check file size 500 kb , 40mb , 10mb
if ($data_attach['a'.$x]["size"] > 10000000) {
    //echo "Sorry, your file is too large.";
    $uploadOk = 0;
    if($x == 6)
    $x_add .= $x;
    else
    $x_add .= $x.', ';
    //return http_redirect($root_folder.'mainsites/registration?msg=0&err=3');
    return $this->redirect(array('controller' => $this->Session->read('User.username'),'action' => $currentSegment.'?msg=fail&err=3&attno='.$x_add));
    //pr("Sorry, your file is too large.");
}

// Allow certain file formats
if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif" ) {
    //echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
    //return http_redirect($root_folder.'mainsites/registration?msg=0&err=4');
  return $this->redirect(array('controller' => $this->Session->read('User.username'),'action' => $currentSegment.'?msg=fail&err=4'));
    $uploadOk = 0;
  //pr("Sorry, only JPG, JPEG, PNG & GIF files are allowed.");
}
if($uploadOk && $isSponsornameOk && $isCpasswordOk && $isPasswordOk && $isCemailOk && $isEmailOk && $isUsernameOk && $isTwitterOk && $isFacebookOk && $isBirthdateOk && $isAddressOk && $isExtOk && $isLnameOk && $isMnameOk && $isFnameOk){
move_uploaded_file($data_attach['a'.$x]["tmp_name"], $target_file);
}
  }
 }
}
#-------------------------------------------------------
    
       // exit();
      
      if($isSponsornameOk && $isCpasswordOk && $isPasswordOk && $isCemailOk && $isEmailOk && $isUsernameOk && $isTwitterOk && $isFacebookOk && $isBirthdateOk && $isAddressOk && $isExtOk && $isLnameOk && $isMnameOk && $isFnameOk)
      {
       
        $Attachment = new Attachment();
        if(!empty($attachments1) || !empty($attachments2) || !empty($attachments3) || !empty($attachments4) || !empty($attachments5) || !empty($attachments6)){
          $data_attach = array(
            'a1' => $attachments1,
            'a2' => $attachments2,
            'a3' => $attachments3,
            'a4' => $attachments4,
            'a5' => $attachments5,
            'a6' => $attachments6
            );
          //--------------------------------------------------------



          //--------------------------------------------------------
          for($x=1;$x<=count($data_attach);$x++){
            
            if(!empty($data_attach['a'.$x]) && !empty($data_attach['a'.$x]['tmp_name']) && $data_attach['a'.$x]['tmp_name'] != ''){
              $datas = array(
                'username' => $username,
                'email' => $email,
                   'image_path' => $path_to_upload.''.$data_attach['a'.$x]['name'],
                   'name' => $data_attach['a'.$x]['name'],
                   'type' => $data_attach['a'.$x]['type'],
                   'tmp_name' => $data_attach['a'.$x]['tmp_name'],
                   'error' => $data_attach['a'.$x]['error'],
                   'size' => $data_attach['a'.$x]['size']
                );
               
               $Attachment->create();
              
              if($Attachment->save($datas)){
                 // Check if $uploadOk is set to 0 by an error
                 
              }else{
                //$Complete_upload = false;
              }
             
            }
           
            
          }
          //$Complete_upload = true;
          //--------------------------------------------------------------
        }
        $Attachment_db = $Attachment->find('all',array('conditions' => array(
           'username' => $username,
           'email' => $email
          ),'recursive' => -1));
      
        $attach_arr = array();
        foreach($Attachment_db as $adb_data){
        
         array_push($attach_arr, '['.$adb_data['attachments']['id'].']');
        
        }
        $ats = '';
        for($x=0;$x<count($attach_arr);$x++){
           $ats .= $attach_arr[$x];
        }
        /**/
       
        if(empty($ats))
          $ats = '';
        
        $hashpassword = $secu::hash($password,'md5');
        $doubleCheckPwd = $secu::hash($cpassword,'md5');
        $data = array(
          'email' => $email,
          'firstname' => $fname,
          'middlename' => $mname,
          'lastname' => $lname,
          'ext' => $ext,
          'facebook' => $facebook,
          'twitter' => $twitter,
          'address' => $personal_address,
          'birthdate' => $birthdate,
          'confirm_email' => $cemail,
          'sponsorsname' => $sponsorsname,
          'attachments_id' => $ats,
          'username' => $username,
          'password' => $hashpassword,
          'confirm_password' => $doubleCheckPwd,
          'group' => 2,
          'membership' => $membership,
          'terms_and_conditions' => 1,
          'referer_id' => $this->Session->read('User.id'),
          'verified_account' => 0
          );
        
        
        
        //$User = new User();
        $User->create();

        if($User->save($data)){
          //if no attachments
          //return $this->redirect(array('controller' => $this->Session->read('User.username'),'action' => $currentSegment.'?msg=success&newuid='.$username));
        }
        
        
        $User_db2 = $User->find('first',array('conditions' => array(
          'username' => $username,
           'email' => $email
          ),'recursive' => -1));
        $attachment_arr = '';
          
            
            if(count($Attachment_db) > 1){
              
            $attachment_arr = str_replace('][', '-', $User_db2['users']['attachments_id']);
            $attachment_arr = str_replace('[', '', $attachment_arr);
            $attachment_arr = str_replace(']', '', $attachment_arr);
            $attachment_arr = explode('-', $attachment_arr);
            for($x=0;$x<count($attachment_arr);$x++){
              $Attachment->id = $attachment_arr[$x];
              $data = array(
                 'user_id' => $User_db2['users']['id']
                );
              if($Attachment->save($data)){
                
              }
             }
             
             
             return $this->redirect(array('controller' => $this->Session->read('User.username'),'action' => $currentSegment.'?msg=success&newuid='.$username));
             
            }elseif(count($Attachment_db) == 1){
             $attachment_arr = str_replace('[', '', $User_db2['users']['attachments_id']);
             $attachment_arr = str_replace(']', '', $attachment_arr);
             $Attachment->id = $attachment_arr;
             

             $data = array(
                 'user_id' => $User_db2['users']['id']
                );
              if($Attachment->save($data)){
                return $this->redirect(array('controller' => $this->Session->read('User.username'),'action' => $currentSegment.'?msg=success&newuid='.$username));
              }

              
            }else{
              return $this->redirect(array('controller' => $this->Session->read('User.username'),'action' => $currentSegment.'?msg=success&newuid='.$username));
            }/**/
         
      }else{
        
        //none
        if($isPasswordOk && $isCpasswordOk){
         if(!$isSponsornameOk || !$isCemailOk || !$isEmailOk || !$isUsernameOk || !$isTwitterOk || !$isFacebookOk || !$isBirthdateOk || !$isAddressOk || !$isExtOk || !$isLnameOk || !$isMnameOk || !$isFnameOk){
             $password_msg = $warning_msg;
             $password_iconmsg = $warning_iconmsg.' - <label style="font-size:12px;" >Write your password again.</label>';
             $password = null;
             $isPasswordOk = false;
             $cpassword_msg = $warning_msg;
             $cpassword_iconmsg = $warning_iconmsg.' - <label style="font-size:12px;" >Write your password again.</label>';
             $cpassword = null;
             $isCpasswordOk = false;
         }
        }
      }

    }
    
    $this->set(compact('cpassword_iconmsg','cpassword_msg','password_iconmsg','password_msg','sponsorsname_iconmsg','sponsorsname_msg','cemail_iconmsg','cemail_msg','email_iconmsg','email_msg','username_iconmsg','username_msg','twitter_iconmsg','twitter_msg','facebook_iconmsg','facebook_msg','birthdate_iconmsg','birthdate_msg','fname_msg','fname_iconmsg','mname_msg','mname_iconmsg','lname_msg','lname_iconmsg','ext_msg','ext_iconmsg','address_msg','address_iconmsg'));
    $this->set(compact('fname','mname','lname','ext','personal_address','birthdate','facebook','twitter','username','email','cemail','sponsorsname'));
    $this->set(compact('currentSegment','currentSegment2'));
    
    $this->render('/Mainsites/'.$currentSegment);
  }
   public function confirmation(){
    return $this->redirect(array('controller' => 'mainsites', 'action' => 'confirmation'));
   }
  public function products(){
        $segments = explode('/', trim(parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH), '/'));
                $numSegments = count($segments); 
                $currentSegment = $segments[$numSegments - 1];
                $currentSegment2 = $segments[$numSegments - 2];
        $Brand = new Brand();
        if(!empty($this->params['url']['bid']))
        $display_product_as = $this->params['url']['bid'];
        
        if(!empty($display_product_as)){
        $Brand_Product_db = $Brand->find('all',array('conditions' => array(
            'brands.id' => $display_product_as
          ),'recursive' => 1));
        }else{
        $Brand_Product_db = $Brand->find('all',array('conditions' => array(
            
          ),'recursive' => 1));
        }
        $Product = new Product();
        if(!empty($display_product_as)){
          $Product_db = $Product->find('count',array('conditions' => array(
           'brand_id' => $display_product_as
            ),'recursive' => -1));
        }else{
        $Product_db = $Product->find('count',array('recursive' => -1));
        }
        $this->set(compact('Product_db','Brand_Product_db','display_product_as','currentSegment2'));
     $this->render('/Mainsites/'.$currentSegment);
     
  }
  public function products_edit(){
      $this->Context->checkSession($this);
    $this->Context->doNotPermit($this, '2');
    $segments = explode('/', trim(parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH), '/'));
                $numSegments = count($segments); 
                $currentSegment = $segments[$numSegments - 1];
    
    $Brand = new Brand();
    $Brand_db = $Brand->find('all',array('recursive' => -1));
    $Product = new Product();
    $Product_db = $Product->find('all',array('recursive' => -1));
    
    $Brand_Product_db = $Brand->find('all',array('recursive' => 1));
    
    
    $this->set(compact('currentSegment','Brand_db','Product_db','Brand_Product_db'));
     $this->render('/Mainsites/'.$currentSegment);
    
  }
  
  public function select_view(){
    $this->Context->checkSession($this);
        
        

    if ($this->Session->read('User.group')==0) $this->redirect(array('controller' => 'admin', 'action' => '/'));
    if ($this->Session->read('User.group')==1) $this->redirect(array('controller' => $this->Session->read('User.username'), 'action' => '/'));
    if ($this->Session->read('User.group')==2) $this->redirect(array('controller' => $this->Session->read('User.username'), 'action' => '/'));

    exit();
  }
  
  public function logout(){
      $this->Context->destroy($this);
      
      $this->redirect(array('controller' => 'mainsites', 'action' => 'home'));
      
    
  }
}
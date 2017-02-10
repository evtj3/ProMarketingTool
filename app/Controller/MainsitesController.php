<?php

App::uses('AppController', 'Controller');
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
App::import('Model','SoldProduct');
App::import('Model','Attachment');
App::uses('Folder', 'Utility');
App::uses('File', 'Utility');

class MainsitesController extends AppController {

	
	public $components = array('Context','Paginator');
  
	public $uses = array();
  
	public function beforeFilter() {
       parent::beforeFilter();
		 
       $this->layout = 'bootstrap';
    }

    public function afterFilter() {
      
       
       $this->layout = 'empty';
    }

	public function index(){
	  $user_ses = $this->Session->read('User.username');
    if(!empty($user_ses))
    $this->redirect(array('controller' => $user_ses,'action' => 'home'));
    else{
        $this->redirect(array('controller' => 'mainsites','action' => 'home'));
    } 
    
	}
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
    if($this->request->is('post')){
      
      if(!empty($this->request->data['submit_productModels'])){
        if(!empty($this->request->data['productModels']) && !empty($this->request->data['productModels_name'])){
           $data = array(
          'brand' => $this->request->data['productModels_name'],
          'image_path' => $this->request->data['path_to_upload'].''.$this->request->data['productModels']
          );

            $ProductModel->create();
           if($ProductModel->save($data)){
            
            return $this->redirect(array('controller' => $this->Session->read('User.username'),'action' => $currentSegment));
           }else{
            
           }
        }else{
          
        }
      }
      
      if(!empty($this->request->data['submit_welcome'])){
        if(!empty($this->request->data['welcome']) && !empty($this->request->data['welcome_name'])){
           $data = array(
          'user_id' => $this->request->data['user_id'],
          'image_name' => $this->request->data['welcome_name'],
          'image_path' => $this->request->data['path_to_upload'].''.$this->request->data['welcome']
          );

            $User->ProfilePic->create();
           if($User->ProfilePic->save($data)){
            
            return $this->redirect(array('controller' => $this->Session->read('User.username'),'action' => $currentSegment));
           }else{
            
           }
        }else{
          
        }/**/
      }
      
      if(!empty($this->request->data['submit_brand'])){
        if(!empty($this->request->data['brand']) && !empty($this->request->data['brand_name'])){
           $data = array(
          'brand' => $this->request->data['brand_name'],
          'image_path' => $this->request->data['path_to_upload'].''.$this->request->data['brand']
          );

            $Brand->create();
           if($Brand->save($data)){
            
            return $this->redirect(array('controller' => $this->Session->read('User.username'),'action' => $currentSegment));
           }else{
            
           }
        }else{
          
        }/**/
      }
      
      if(!empty($this->request->data['submit_quote'])){
        if(!empty($this->request->data['quote']) && !empty($this->request->data['quote_name'])){
           $data = array(
          'qoute' => $this->request->data['quote'],
          'author' => $this->request->data['quote_name']
          );
           
           
             
           
            $Qoute->id = 1;
           if($Qoute->save($data)){
            
            return $this->redirect(array('controller' => $this->Session->read('User.username'),'action' => $currentSegment));
           }else{
            
           }
        }else{
          
        }/**/
      }
      
      if(!empty($this->request->data['submit_Products'])){
        if(!empty($this->request->data['Products']) && !empty($this->request->data['Products_name']) && !empty($this->request->data['Products_brand']) && !empty($this->request->data['Products_prize']) && !empty($this->request->data['Products_totalitemavailable'])){
           $fproduct = 0;
           $sizes = null;
           if(!empty($this->request->data['Products_size_s']) && !empty($this->request->data['Products_size_m']) && !empty($this->request->data['Products_size_l']) && !empty($this->request->data['Products_size_xl']))
           $sizes = '['.$this->request->data['Products_size_s'].']'.'['.$this->request->data['Products_size_m'].']'.'['.$this->request->data['Products_size_l'].']'.'['.$this->request->data['Products_size_xl'].']';
           if(!empty($this->request->data['Products_featured']))
           $fproduct = $this->request->data['Products_featured'];
          

           $data = array(
          'item_name' => $this->request->data['Products_name'],
          'image_path' => $this->request->data['path_to_upload'].''.$this->request->data['Products'],
          'color' => $this->request->data['Products_color2'],
          'sizes' => $sizes,
          'brand_id' => $this->request->data['Products_brand'],
          'total' => $this->request->data['Products_totalitemavailable'],
          'prize' => $this->request->data['Products_prize'],
          'featured' => $fproduct
          );
          
            $Product->create();
           if($Product->save($data)){
            
            return $this->redirect(array('controller' => $this->Session->read('User.username'),'action' => $currentSegment));
           }else{
            
           }
        }else{
          
        }/**/
      }
      
      if(!empty($this->request->data['submit_social_media'])){
         if(!empty($this->request->data['social_media_fb']) || !empty($this->request->data['social_media_twitter'])){
          $data = array(
             'id' => $this->Session->read('User.id'),
             'facebook' => $this->request->data['social_media_fb'],
             'twitter' => $this->request->data['social_media_twitter']
            );

          if($User->save($data)){
            
            return $this->redirect(array('controller' => $this->Session->read('User.username'),'action' => $currentSegment));
          }else{
            
          }
         }else{
          
         }
      }
      
      if(!empty($this->request->data['submit_wawTutorial'])){
         if(!empty($this->request->data['wawTutorial_youtube'])){
        
          if(!empty($Video) && !empty($Video_db)){
           $data = array(
            'id' => $Video_db['videos']['id'],
            'video_count' => 1,
             'pages' => $this->request->data['wawTutorial_youtube_pages'],
             'youtube_link' => $this->request->data['wawTutorial_youtube']
            );
          }else{
            $data = array(
             'pages' => $this->request->data['wawTutorial_youtube_pages'],
             'youtube_link' => $this->request->data['wawTutorial_youtube']
            );
         
           $Video->create();
          }

          if($Video->save($data)){
            
            return $this->redirect(array('controller' => $this->Session->read('User.username'),'action' => $currentSegment));
          }else{
            
          }
         }else{
          
         }
      }
    }
    $this->set(compact('currentSegment','ProductModel_db','User_db','total_userPpUploaded','Brand_db','Qoute_db','Product_db','Brand_Product_db','User_sm_db','Video_db'));
  }
  public function home_edit_featured($id = null){
    $this->Context->checkSession($this);
    $this->Context->doNotPermit($this, '2');
    
    $Product = new Product();
    $Product->id = $id;
    if (!$Product->exists()) {
      throw new NotFoundException(__('Invalid image'));
    }
    $Product_db = $Product->find('first',array('conditions' => array(
    'id' => $id
      ),'recursive' => -1));
    if(!empty($id)){
       
       $product_featured_update = $Product_db['products']['featured'];
      if($product_featured_update == 1)
        $product_featured_update = 0;
      elseif($product_featured_update == 0)
        $product_featured_update = 1;

       $data = array(
        'id' => $id,
        'featured' => $product_featured_update);
       
       if($Product->save($data)){
         return $this->redirect(array('controller' => $this->Session->read('User.username'),'action' => 'home_edit'));
       }else{

       }
    }

     
  }
  public function home_delete_model($id = null){
    $this->Context->checkSession($this);
    $this->Context->doNotPermit($this, '2');

    $ProductModel = new ProductModel();
    $ProductModel->id = $id;
    if (!$ProductModel->exists()) {
      throw new NotFoundException(__('Invalid image'));
    }

    
    if ($ProductModel->delete()) {
      
    } else {
      
    }
    return $this->redirect(array('controller' => $this->Session->read('User.username'),'action' => 'home_edit'));
  }
  public function home_delete_profilepic($id = null){
    $this->Context->checkSession($this);
    $this->Context->doNotPermit($this, '2');

    $User = new User();
    $User->ProfilePic->id = $id;
    if (!$User->ProfilePic->exists()) {
      throw new NotFoundException(__('Invalid image'));
    }

    
    if ($User->ProfilePic->delete()) {
      
    } else {
      
    }
    return $this->redirect(array('controller' => $this->Session->read('User.username'),'action' => 'home_edit'));
  }
  public function home_delete_brand($id = null){
    $this->Context->checkSession($this);
    $this->Context->doNotPermit($this, '2');
    
    $Brand = new Brand();
    $Brand->id = $id;
    if (!$Brand->exists()) {
      throw new NotFoundException(__('Invalid image'));
    }

    
    if ($Brand->delete()) {
      
    } else {
      
    }
    return $this->redirect(array('controller' => $this->Session->read('User.username'),'action' => 'home_edit'));
  }
  public function home_delete_product($id = null){
    $this->Context->checkSession($this);
    $this->Context->doNotPermit($this, '2');
    
    $Product = new Product();
    $Product->id = $id;
    if (!$Product->exists()) {
      throw new NotFoundException(__('Invalid image'));
    }

    
    if ($Product->delete()) {
      
    } else {
      
    }
    return $this->redirect(array('controller' => $this->Session->read('User.username'),'action' => 'home_edit'));
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
    
      if(!empty($this->request->data['submit_wawTutorial'])){
         if(!empty($this->request->data['wawTutorial_youtube'])){
          
           if(!empty($Video) && !empty($Video_db)){
           $data = array(
            'id' => $Video_db['videos']['id'],
            'video_count' => 1,
             'pages' => $this->request->data['wawTutorial_youtube_pages'],
             'youtube_link' => $this->request->data['wawTutorial_youtube']
            );
          }else{
            $data = array(
             'pages' => $this->request->data['wawTutorial_youtube_pages'],
             'youtube_link' => $this->request->data['wawTutorial_youtube']
            );
         
           $Video->create();
          }

          if($Video->save($data)){
            
            return $this->redirect(array('controller' => $this->Session->read('User.username'),'action' => $currentSegment));
          }else{
            
          }
         }else{
          
         }
      }
      
      if(!empty($this->request->data['submit_presentations'])){
         if(!empty($this->request->data['presentations']) && !empty($this->request->data['presentations_name'])){
          $data = array(
             'presentation1' => 1,
             'image_name' => $this->request->data['presentations_name'],
             'image_path' => $this->request->data['path_to_upload'].''.$this->request->data['presentations']
            );
          
            $Presentation->create();
         
          
          if($Presentation->save($data)){
            
            return $this->redirect(array('controller' => $this->Session->read('User.username'),'action' => $currentSegment));
          }else{
            
          }
         }else{
          
         }
      }
      if(!empty($this->request->data['submit_presentations2'])){
         if(!empty($this->request->data['presentations2']) && !empty($this->request->data['presentations2_name'])){
          $data = array(
             'presentation2' => 1,
             'image_name' => $this->request->data['presentations2_name'],
             'image_path' => $this->request->data['path_to_upload'].''.$this->request->data['presentations2']
            );
          
            $Presentation->create();
         
          
          if($Presentation->save($data)){
            
            return $this->redirect(array('controller' => $this->Session->read('User.username'),'action' => $currentSegment));
          }else{
            
          }
         }else{
          
         }
      }
      
      if(!empty($this->request->data['submit_packages'])){
         if(!empty($this->request->data['packages']) && !empty($this->request->data['packages_name'])){
          $data = array(
             'image_name' => $this->request->data['packages_name'],
             'image_path' => $this->request->data['path_to_upload'].''.$this->request->data['packages']
            );
          
            $Package->create();
         
          
          if($Package->save($data)){
            
            return $this->redirect(array('controller' => $this->Session->read('User.username'),'action' => $currentSegment));
          }else{
            
          }
         }else{
          
         }
      }
      $this->set(compact('currentSegment','Video_db','Presentation_db','Package_db'));
  }
  public function what_we_offer_delete_presentations($id = null){
    $this->Context->checkSession($this);
    $this->Context->doNotPermit($this, '2');
    
    $Presentation = new Presentation();
    $Presentation->id = $id;
    if (!$Presentation->exists()) {
      throw new NotFoundException(__('Invalid image'));
    }

    
    if ($Presentation->delete()) {
      
    } else {
      
    }
    return $this->redirect(array('controller' => $this->Session->read('User.username'),'action' => 'what_we_offer_edit'));
  }
  public function what_we_offer_delete_packages($id = null){
    $this->Context->checkSession($this);
    $this->Context->doNotPermit($this, '2');
    
    $Package = new Package();
    $Package->id = $id;
    if (!$Package->exists()) {
      throw new NotFoundException(__('Invalid image'));
    }

    
    if ($Package->delete()) {
      
    } else {
      
    }
    return $this->redirect(array('controller' => $this->Session->read('User.username'),'action' => 'what_we_offer_edit'));
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
     
    if($this->request->is('post')) {

      if(!empty($this->request->data['submit_testimonials'])){
        if(!empty($this->request->data['testimonials']) && !empty($this->request->data['testimonials_name'])){
           $data = array(
          'user_id' => $this->request->data['testimonials_user'],
          'image_name' => $this->request->data['testimonials_name'],
          'image_path' => $this->request->data['path_to_upload'].''.$this->request->data['testimonials']
          );

            $Testimonial->create();
           if($Testimonial->save($data)){
            
            return $this->redirect(array('controller' => $this->Session->read('User.username'),'action' => $currentSegment));
           }else{
            
           }
        }else{
          
        }/**/
      }
      
      if(!empty($this->request->data['submit_wawTutorial'])){
         if(!empty($this->request->data['wawTutorial_youtube_pages'])){
          
            if(!empty($this->request->data['wawTutorial_youtube_add'])){
               $data = array(
             'video_count' => $this->request->data['total_videos'],
             'pages' => $this->request->data['wawTutorial_youtube_pages'],
             'youtube_link' => $this->request->data['wawTutorial_youtube_add']
              );
              $Video->create();
              if($Video->save($data)){
              
                 return $this->redirect(array('controller' => $this->Session->read('User.username'),'action' => $currentSegment));
              }else{
              
              }
            }else{
             // pr(count($Video_db));
              //    pr($this->request->data); exit();

              for($x=1;$x<=count($Video_db);$x++){
                $data = array(
                'id' => $this->request->data['video_id'.$x],
                'youtube_link' => $this->request->data['wawTutorial_youtube'.$x]
                );
              
                if($Video->save($data)){
              
                  
                }else{
              
                }

              }
              return $this->redirect(array('controller' => $this->Session->read('User.username'),'action' => $currentSegment));
            }
         }
       }

      }
     $this->set(compact('currentSegment','Testimonial_db','User_db','Video_db'));
  }
  public function what_theyre_saying_delete_presentations($id = null){
    $this->Context->checkSession($this);
    $this->Context->doNotPermit($this, '2');
    
    $Testimonial = new Testimonial();
    $Testimonial->id = $id;
    if (!$Testimonial->exists()) {
      throw new NotFoundException(__('Invalid image'));
    }

    
    if ($Testimonial->delete()) {
      
    } else {
      
    }
    return $this->redirect(array('controller' => $this->Session->read('User.username'),'action' => 'what_theyre_saying_edit'));
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

     $Weeklyevent = new Weeklyevent();
     $Weeklyevent_db = $Weeklyevent->find('all',array('recursive' => -1));
     $Majorevent = new Majorevent();
     $Majorevent_db = $Majorevent->find('all',array('recursive' => -1));
    $Video_db1 = $Video->find('first',array('conditions' => array(
      'pages' => $currentSegment,
      'video_count' => 1
      ),'recursive' => -1));
    
    $Video_db2 = $Video->find('first',array('conditions' => array(
      'pages' => $currentSegment,
      'video_count' => 2
      ),'recursive' => -1));
     // pr($this->request->data); exit();
      if(!empty($this->request->data['wawTutorial_youtube_add']) && $this->request->data['total_videos'] < 3){
               $data = array(
             'video_count' => $this->request->data['total_videos'],
             'pages' => $this->request->data['wawTutorial_youtube_pages'],
             'youtube_link' => $this->request->data['wawTutorial_youtube_add']
              );
              $Video->create();
              if($Video->save($data)){
              
                 return $this->redirect(array('controller' => $this->Session->read('User.username'),'action' => $currentSegment));
              }else{
              
              }
            }else{
                //restrict to add new Video
            }

      if(!empty($this->request->data['submit_wawTutorial'])){
         if(!empty($this->request->data['wawTutorial_youtube1'])){
         
          $data = array(
             'id' => $this->request->data['wawTutorial_youtube_id1'],
             'pages' => $this->request->data['wawTutorial_youtube_pages'],
             'youtube_link' => $this->request->data['wawTutorial_youtube1']
            );
           
            if($Video->save($data)){
              
            
            }else{
              
            }
 
          return $this->redirect(array('controller' => $this->Session->read('User.username'),'action' => $currentSegment));
         }else{
          
         }
      }


      
      if(!empty($this->request->data['submit_weeklyevents_pics'])){
        if(!empty($this->request->data['weeklyevents_pics']) && !empty($this->request->data['weeklyevents_pics_name'])){
           $data = array(
          
          'image_name' => $this->request->data['weeklyevents_pics_name'],
          'image_path' => $this->request->data['path_to_upload'].''.$this->request->data['weeklyevents_pics']
          );

            $Weeklyevent->create();
           if($Weeklyevent->save($data)){
            
            return $this->redirect(array('controller' => $this->Session->read('User.username'),'action' => $currentSegment));
           }else{
            
           }
        }else{
          
        }/**/
      }
      
      
      
      if(!empty($this->request->data['submit_wawTutorial2'])){
         if(!empty($this->request->data['wawTutorial_youtube2'])){
         
          $data = array(
             'id' => $this->request->data['wawTutorial_youtube_id2'],
             'pages' => $this->request->data['wawTutorial_youtube_pages'],
             'youtube_link' => $this->request->data['wawTutorial_youtube2']
            );
           
            if($Video->save($data)){
              
            
            }else{
              
            }
 
          return $this->redirect(array('controller' => $this->Session->read('User.username'),'action' => $currentSegment));
         }else{
          
         }
      }
      
      if(!empty($this->request->data['submit_majorevents_pics'])){
        if(!empty($this->request->data['majorevents_pics']) && !empty($this->request->data['majorevents_pics_name'])){
           $data = array(
          
          'image_name' => $this->request->data['majorevents_pics_name'],
          'image_path' => $this->request->data['path_to_upload'].''.$this->request->data['majorevents_pics']
          );

            $Majorevent->create();
           if($Majorevent->save($data)){
            
            return $this->redirect(array('controller' => $this->Session->read('User.username'),'action' => $currentSegment));
           }else{
            
           }
        }else{
          
        }
      }
      
     $this->set(compact('currentSegment','Video_db','Video_db1','Video_db2','Weeklyevent_db','Majorevent_db'));

  }
  public function weeklyevents_pics_delete($id = null){
      $this->Context->checkSession($this);
    $this->Context->doNotPermit($this, '2');
    
    $Weeklyevent = new Weeklyevent();
    $Weeklyevent->id = $id;
    if (!$Weeklyevent->exists()) {
      throw new NotFoundException(__('Invalid image'));
    }

    
    if ($Weeklyevent->delete()) {
      
    } else {
      
    }
    return $this->redirect(array('controller' => $this->Session->read('User.username'),'action' => 'gallery_edit'));
  }
  public function majorevents_pics_delete($id = null){
      $this->Context->checkSession($this);
    $this->Context->doNotPermit($this, '2');
    
    $Majorevent = new Majorevent();
    $Majorevent->id = $id;
    if (!$Weeklyevent->exists()) {
      throw new NotFoundException(__('Invalid image'));
    }

    
    if ($Majorevent->delete()) {
      
    } else {
      
    }
    return $this->redirect(array('controller' => $this->Session->read('User.username'),'action' => 'gallery_edit'));
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
	}
  public function confirmation(){
    $this->Context->checkSession($this);
    $this->Context->doNotPermit($this, '2');
    $this->Context->doNotPermit($this, '1');

    $segments = explode('/', trim(parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH), '/'));
                $numSegments = count($segments); 
                $currentSegment = $segments[$numSegments - 1];
                $currentSegment2 = $segments[$numSegments - 2];

    $User = new User();
    $User_db = $User->find('all',array('conditions' => array(
     'verified_account' => 0
      ),'recursive' => 1));
    $User_db2 = $User->find('all',array('conditions' => array(
     'verified_account' => 0
      ),'recursive' => -1));


    $referer_db = $User->find('all',array('fields' => 'id,username,firstname,middlename,lastname,ext,referer_id','recursive' => -1));
    
    if($this->request->is('post')){
     
      
      $dir = new Folder('.././Controller');
               $files = $dir->find('.*\.php', true);
                        
      for($x=0;$x < count($this->request->data);$x++){
          $User->id = $this->request->data[$x];
          $data = array(
           'verified_account' => 1
            );
       foreach($User_db2 as $udb2){
         if($udb2['users']['id'] == $this->request->data[$x]){
             $controller_content = "<?php

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


class ".$udb2['users']['username']."Controller extends MainsitesController {

  public \$components = array('Context','Paginator');

  public \$uses = array();
 
  public function home(){
    
   \$segments = explode('/', trim(parse_url(\$_SERVER['REQUEST_URI'], PHP_URL_PATH), '/'));
                \$numSegments = count(\$segments); 
                \$currentSegment = \$segments[\$numSegments - 1];
                \$currentSegment2 = \$segments[\$numSegments - 2];
   \$ProductModel = new ProductModel();
    \$ProductModel_db = \$ProductModel->find('all',array('fields' =>'id,brand,image_path,modified','recursive' => -1));
    \$User = new User();
    \$User_count = \$User->find('count');
    \$User_db = \$User->ProfilePic->find('first',array('conditions'=>array(
      'user_id' => \$this->Session->read('User.id')
      ),'order' => 'modified DESC','recursive' => 1));
    \$User_db2 = \$User->find('first',array('conditions' => array(
      'username' => \$currentSegment2
      ),'order' => 'modified DESC','recursive' => 1));
    \$Brand = new Brand();
    \$Brand_db = \$Brand->find('all',array('recursive' => -1));
    \$Qoute = new Qoute();
    \$Qoute_db = \$Qoute->find('first',array('conditions' => array(
    'id' => 1
      ),'recursive' => -1));
    \$Product = new Product();
    \$Product_db = \$Product->find('all',array('recursive' => -1));
    \$Video = new Video();
    \$Video_db = \$Video->find('first',array('conditions' => array(
      'pages' => 'home_edit'
      ),'recursive' => -1));
    \$this->set(compact('ProductModel_db','User_db','User_db2','Brand_db','Qoute_db','Product_db','User_count','Video_db'));
   /*phpinfo();*/
   \$this->render('/Mainsites/'.\$currentSegment);
  }
  public function home_edit(){
    \$this->Context->checkSession(\$this);
    \$this->Context->doNotPermit(\$this, '2');
    \$segments = explode('/', trim(parse_url(\$_SERVER['REQUEST_URI'], PHP_URL_PATH), '/'));
                \$numSegments = count(\$segments); 
                \$currentSegment = \$segments[\$numSegments - 1];

    \$ProductModel = new ProductModel();
    \$ProductModel_db = \$ProductModel->find('all',array('fields' =>'id,brand,image_path,modified','recursive' => -1));
    \$User = new User();

    \$User_db = \$User->find('all',array('conditions'=>array(
      'id' => \$this->Session->read('User.id')
      ),'recursive' => 1));
    \$User_sm_db = \$User->find('first',array('fields' => 'facebook,twitter','conditions'=>array(
      'id' => \$this->Session->read('User.id')
      ),'recursive' => 1));
    \$total_userPpUploaded = \$User->ProfilePic->find('count',array('conditions' => array(
       'user_id' => \$this->Session->read('User.id')
      )));
    \$Brand = new Brand();
    \$Brand_db = \$Brand->find('all',array('recursive' => -1));
    \$Qoute = new Qoute();
    \$Qoute_db = \$Qoute->find('all',array('recursive' => -1));
    \$Product = new Product();
    \$Product_db = \$Product->find('all',array('recursive' => -1));
    \$Brand_Product_db = \$Brand->find('all',array('recursive' => 1));
    \$Video = new Video();
    \$Video_db = \$Video->find('first',array('conditions' => array(
      'pages' => \$currentSegment
      ),'recursive' => -1));
    
    \$this->set(compact('currentSegment','ProductModel_db','User_db','total_userPpUploaded','Brand_db','Qoute_db','Product_db','Brand_Product_db','User_sm_db','Video_db'));
    \$this->render('/Mainsites/'.\$currentSegment);
  }
  
  public function what_we_offer(){
  \$segments = explode('/', trim(parse_url(\$_SERVER['REQUEST_URI'], PHP_URL_PATH), '/'));
                \$numSegments = count(\$segments); 
                \$currentSegment = \$segments[\$numSegments - 1];
                \$currentSegment2 = \$segments[\$numSegments - 2];
    \$Presentation = new Presentation();
    \$Presentation_db = \$Presentation->find('all',array('fields' =>'id,presentation1,presentation2,image_name,image_path,modified','recursive' => -1));
    \$User = new User();
    \$User_db2 = \$User->find('first',array('conditions' => array(
      'username' => \$currentSegment2
      ),'order' => 'modified DESC','recursive' => 1));
    \$Video = new Video();
    \$Video_db = \$Video->find('first',array('conditions' => array(
      'pages' => 'what_we_offer_edit'
      ),'recursive' => -1));
    \$Package = new Package();
    \$Package_db = \$Package->find('all',array('fields' =>'id,image_name,image_path,modified','recursive' => -1));
    \$this->set(compact('Video_db','Presentation_db','Package_db','User_db2','currentSegment2'));
  \$this->render('/Mainsites/'.\$currentSegment);
  }
  public function what_we_offer_edit(){
      \$this->Context->checkSession(\$this);
    \$this->Context->doNotPermit(\$this, '2');
      \$segments = explode('/', trim(parse_url(\$_SERVER['REQUEST_URI'], PHP_URL_PATH), '/'));
                \$numSegments = count(\$segments); 
                \$currentSegment = \$segments[\$numSegments - 1];
    \$Presentation = new Presentation();
    \$Presentation_db = \$Presentation->find('all',array('fields' =>'id,presentation1,presentation2,image_name,image_path,modified','recursive' => -1));
    \$Video = new Video();
    \$Video_db = \$Video->find('first',array('conditions' => array(
      'pages' => \$currentSegment
      ),'recursive' => -1));
    \$Package = new Package();
    \$Package_db = \$Package->find('all',array('fields' =>'id,image_name,image_path,modified','recursive' => -1));
    
      \$this->set(compact('currentSegment','Video_db','Presentation_db','Package_db'));
      \$this->render('/Mainsites/'.\$currentSegment);
  }
  
  public function what_theyre_saying(){
     \$segments = explode('/', trim(parse_url(\$_SERVER['REQUEST_URI'], PHP_URL_PATH), '/'));
                \$numSegments = count(\$segments); 
                \$currentSegment = \$segments[\$numSegments - 1];
     \$Testimonial = new Testimonial();
     \$Testimonial_db = \$Testimonial->find('all');
     \$User = new User();
     \$User_db = \$User->find('all',array('fields' => 'id,username','recursive' => 1));
     \$Video = new Video();
     \$Video_db = \$Video->find('all',array('conditions' => array(
      'pages' => \$currentSegment.'_edit'
      ),'recursive' => -1));
     
     \$this->set(compact('currentSegment','Testimonial_db','User_db','Video_db'));
      \$this->render('/Mainsites/'.\$currentSegment);
   
  }
  public function what_theyre_saying_edit(){
     \$this->Context->checkSession(\$this);
     \$this->Context->doNotPermit(\$this, '2');
     \$segments = explode('/', trim(parse_url(\$_SERVER['REQUEST_URI'], PHP_URL_PATH), '/'));
                \$numSegments = count(\$segments); 
                \$currentSegment = \$segments[\$numSegments - 1];
     \$Testimonial = new Testimonial();
     \$Testimonial_db = \$Testimonial->find('all');
     \$User = new User();
     \$User_db = \$User->find('all',array('fields' => 'id,username','recursive' => 1));
     \$Video = new Video();
     \$Video_db = \$Video->find('all',array('conditions' => array(
      'pages' => \$currentSegment
      ),'recursive' => -1));
     
     
     \$this->set(compact('currentSegment','Testimonial_db','User_db','Video_db'));
      \$this->render('/Mainsites/'.\$currentSegment);
     
  }
 
  public function gallery(){
     \$segments = explode('/', trim(parse_url(\$_SERVER['REQUEST_URI'], PHP_URL_PATH), '/'));
                \$numSegments = count(\$segments); 
                \$currentSegment = \$segments[\$numSegments - 1];
     \$Video = new Video();
     \$Video_db = \$Video->find('all',array('conditions' => array(
      'pages' => \$currentSegment.'_edit'
      ),'recursive' => -1));
     \$Weeklyevent = new Weeklyevent();
     \$Weeklyevent_db = \$Weeklyevent->find('all',array('recursive' => -1));
     \$Majorevent = new Majorevent();
     \$Majorevent_db = \$Majorevent->find('all',array('recursive' => -1));

     \$this->set(compact('currentSegment','Video_db','Weeklyevent_db','Majorevent_db'));
      \$this->render('/Mainsites/'.\$currentSegment);
   
  }
  public function gallery_edit(){
    \$this->Context->checkSession(\$this);
     \$this->Context->doNotPermit(\$this, '2');
     \$segments = explode('/', trim(parse_url(\$_SERVER['REQUEST_URI'], PHP_URL_PATH), '/'));
                \$numSegments = count(\$segments); 
                \$currentSegment = \$segments[\$numSegments - 1];
     \$Video = new Video();
     \$Video_db = \$Video->find('all',array('conditions' => array(
      'pages' => \$currentSegment
      ),'recursive' => -1));
     \$Video_db1 = \$Video->find('first',array('conditions' => array(
      'pages' => \$currentSegment,
      'video_count' => 1
      ),'recursive' => -1));
    
    \$Video_db2 = \$Video->find('first',array('conditions' => array(
      'pages' => \$currentSegment,
      'video_count' => 2
      ),'recursive' => -1));
     \$Weeklyevent = new Weeklyevent();
     \$Weeklyevent_db = \$Weeklyevent->find('all',array('recursive' => -1));
     \$Majorevent = new Majorevent();
     \$Majorevent_db = \$Majorevent->find('all',array('recursive' => -1));
    
     \$this->set(compact('currentSegment','Video_db','Video_db1','Video_db2','Weeklyevent_db','Majorevent_db'));
      \$this->render('/Mainsites/'.\$currentSegment);
    
  }
 
  public function registration(){
    \$this->Context->checkSession(\$this);
    \$this->Context->doNotPermit(\$this, '2');

    \$secu = new Security();
    \$User  = new User();
    \$segments = explode('/', trim(parse_url(\$_SERVER['REQUEST_URI'], PHP_URL_PATH), '/'));
                \$numSegments = count(\$segments); 
                \$currentSegment = \$segments[\$numSegments - 1];
                \$currentSegment2 = \$segments[\$numSegments - 2];
    if(\$this->request->is('post')){
    
    \$fname = \$this->request->data['firstname'];
    \$mname = \$this->request->data['middlename'];
    \$lname = \$this->request->data['lastname'];
    \$ext = \$this->request->data['ext'];
    \$personal_address = \$this->request->data['address'];
    \$birthdate = \$this->request->data['birthdate'];
    \$facebook = \$this->request->data['facebook'];
    \$twitter = \$this->request->data['twitter'];
    \$username = \$this->request->data['username'];
    \$email = \$this->request->data['email'];
    \$cemail = \$this->request->data['cemail'];
    \$password = \$this->request->data['password'];
    \$cpassword = \$this->request->data['cpassword'];
    \$membership = \$this->request->data['membership'];
    \$sponsorsname = \$this->request->data['sponsorsname'];
    \$path_to_upload = \$this->request->data['path_to_upload'];
    
    \$attachments1 = \$this->request->params['form']['attachments1'];
    \$attachments2 = \$this->request->params['form']['attachments2'];
    \$attachments3 = \$this->request->params['form']['attachments3'];
    \$attachments4 = \$this->request->params['form']['attachments4'];
    \$attachments5 = \$this->request->params['form']['attachments5'];
    \$attachments6 = \$this->request->params['form']['attachments6'];
    

    \$error_msg = 'has-error';
    \$warning_msg = 'has-warning';
    \$success_msg = 'has-success';
    \$error_iconmsg = '<span class=\"glyphicon glyphicon-remove-sign\"></span>';
    \$warning_iconmsg = '<span class=\"glyphicon glyphicon-exclamation-sign\"></span>';
    \$success_iconmsg = '<span class=\"glyphicon glyphicon-ok-sign\"></span>';
    
    
    
    \$fname_c = ctype_alpha(\$fname);
    \$isFnameOk = false;
      if(empty(\$fname)){
           \$fname_msg = \$warning_msg;
           \$fname_iconmsg = \$warning_iconmsg.' - <label style=\"font-size:12px;\" >Please, Fill this up.</label>';

      }elseif(!empty(\$fname) && \$fname_c){
           \$fname_msg = \$success_msg;
           \$fname_iconmsg = \$success_iconmsg;
           \$isFnameOk = true;
      }elseif(empty(\$fname_c)){ 
           \$fname_msg = \$error_msg;
           \$fname_iconmsg = \$error_iconmsg.' - <label style=\"font-size:12px;\" >Only letters are allowed.</label>';
      }
      \$mname_c = ctype_alpha(\$mname);
      \$isMnameOk = false;
      if(empty(\$mname)){
           \$mname_msg = \$warning_msg;
           \$mname_iconmsg = \$warning_iconmsg.' - <label style=\"font-size:12px;\" >Please, Fill this up.</label>';

      }elseif(!empty(\$mname) && \$mname_c){
           \$mname_msg = \$success_msg;
           \$mname_iconmsg = \$success_iconmsg;
           \$isMnameOk = true;
      }elseif(empty(\$mname_c)){ 
           \$mname_msg = \$error_msg;
           \$mname_iconmsg = \$error_iconmsg.' - <label style=\"font-size:12px;\" >Only letters are allowed.</label>';
      }
      \$lname_c = ctype_alpha(\$lname);
      \$isLnameOk = false;
      if(empty(\$lname)){
           \$lname_msg = \$warning_msg;
           \$lname_iconmsg = \$warning_iconmsg.' - <label style=\"font-size:12px;\" >Please, Fill this up.</label>';

      }elseif(!empty(\$lname) && \$lname_c){
           \$lname_msg = \$success_msg;
           \$lname_iconmsg = \$success_iconmsg;
           \$isLnameOk = true;
      }elseif(empty(\$lname_c)){ 
           \$lname_msg = \$error_msg;
           \$lname_iconmsg = \$error_iconmsg.' - <label style=\"font-size:12px;\" >Only letters are allowed.</label>';
      }
      
      \$isExtOk = true;
      \$ext_msg = '';
      \$ext_iconmsg = '';
      
      \$isAddressOk = false;
      if(empty(\$personal_address)){
           \$address_msg = \$warning_msg;
           \$address_iconmsg = \$warning_iconmsg.' - <label style=\"font-size:12px;\" >Please, Fill this up.</label>';

      }elseif(!empty(\$personal_address)){
           \$address_msg = \$success_msg;
           \$address_iconmsg = \$success_iconmsg;
           \$isAddressOk = true;
      }
      
      \$isBirthdateOk = false;

      if(empty(\$birthdate)){
           \$birthdate_msg = \$warning_msg;
           \$birthdate_iconmsg = \$warning_iconmsg.' - <label style=\"font-size:12px;\" >Please, Fill this up.</label>';

      }elseif(!empty(\$birthdate)){
           \$birthdate_msg = \$success_msg;
           \$birthdate_iconmsg = \$success_iconmsg;
           \$isBirthdateOk = true;
      }

      \$isFacebookOk = true;
      \$facebook_msg = '';
      \$facebook_iconmsg = '';
      
      \$isTwitterOk = true;
      \$twitter_msg = '';
      \$twitter_iconmsg = '';
     
   
   \$User_db_username = \$User->find('first',array('conditions' => array(
     'username' => \$username
    ),'recursive' => -1));
    \$username_c = ctype_alpha(\$username);
    \$isUsernameOk = false;
      if(empty(\$username)){
           \$username_msg = \$warning_msg;
           \$username_iconmsg = \$warning_iconmsg.' - <label style=\"font-size:12px;\" >Please, Fill this up.</label>';

      }elseif(!empty(\$username) && \$username_c && !empty(\$User_db_username['users']['username'])){
           \$username_msg = \$error_msg;
           \$username_iconmsg = \$error_iconmsg.' - <label style=\"font-size:12px;\" >'.\$username.' is already in used. Please try again</label>';
      }elseif(!empty(\$username) && \$username_c){
           \$username_msg = \$success_msg;
           \$username_iconmsg = \$success_iconmsg;
           \$isUsernameOk = true;
      }elseif(empty(\$username_c)){ 
           \$username_msg = \$error_msg;
           \$username_iconmsg = \$error_iconmsg.' - <label style=\"font-size:12px;\" >Only letters are allowed.</label>';
      }
      \$User_db_email = \$User->find('first',array('conditions' => array(
     'email' => \$email
    ),'recursive' => -1));
      \$isEmailOk = false;
      if(empty(\$email)){
           \$email_msg = \$warning_msg;
           \$email_iconmsg = \$warning_iconmsg.' - <label style=\"font-size:12px;\" >Please, Fill this up.</label>';

      }elseif(!empty(\$email) && !empty(\$User_db_email['users']['email'])){
           \$email_msg = \$error_msg;
           \$email_iconmsg = \$error_iconmsg.' - <label style=\"font-size:12px;\" >'.\$email.' is already in used. Please try again.</label>';
      }elseif(!empty(\$email)){
           \$email_msg = \$success_msg;
           \$email_iconmsg = \$success_iconmsg;
           \$isEmailOk = true;
      }

      \$isCemailOk = false;
      if(empty(\$cemail)){
           \$cemail_msg = \$warning_msg;
           \$cemail_iconmsg = \$warning_iconmsg.' - <label style=\"font-size:12px;\" >Please, Fill this up.</label>';

      }elseif(\$cemail != \$email){ 
           \$cemail_msg = \$error_msg;
           \$cemail_iconmsg = \$error_iconmsg.' - <label style=\"font-size:12px;\" >Email does not match!</label>';
      }elseif(!empty(\$cemail) && !empty(\$User_db_email['users']['email'])){
           \$cemail_msg = \$error_msg;
           \$cemail_iconmsg = \$error_iconmsg.' - <label style=\"font-size:12px;\" >'.\$email.' is already in used. Please try again.</label>';
      }elseif(!empty(\$cemail)){
           \$cemail_msg = \$success_msg;
           \$cemail_iconmsg = \$success_iconmsg;
           \$isCemailOk = true;
      }
      
      \$isPasswordOk = false;
      if(empty(\$password)){
           \$password_msg = \$warning_msg;
           \$password_iconmsg = \$warning_iconmsg.' - <label style=\"font-size:12px;\" >Please, Fill this up.</label>';

      }elseif(\$password != \$cpassword){ 
           \$password_msg = \$error_msg;
           \$password_iconmsg = \$error_iconmsg.' - <label style=\"font-size:12px;\" >Password does not match!</label>';
      }elseif(!empty(\$password)){
           \$password_msg = \$success_msg;
           \$password_iconmsg = \$success_iconmsg;
           \$isPasswordOk = true;
      }

      \$isCpasswordOk = false;
      if(empty(\$cpassword)){
           \$cpassword_msg = \$warning_msg;
           \$cpassword_iconmsg = \$warning_iconmsg.' - <label style=\"font-size:12px;\" >Please, Fill this up.</label>';

      }elseif(\$cpassword != \$password){ 
           \$cpassword_msg = \$error_msg;
           \$cpassword_iconmsg = \$error_iconmsg.' - <label style=\"font-size:12px;\" >Password does not match!</label>';

      }elseif(!empty(\$cpassword)){
           \$cpassword_msg = \$success_msg;
           \$cpassword_iconmsg = \$success_iconmsg;
           \$isCpasswordOk = true;
      }
      
    \$isSponsornameOk = false;
      if(empty(\$sponsorsname)){
           \$sponsorsname_msg = \$warning_msg;
           \$sponsorsname_iconmsg = \$warning_iconmsg.' - <label style=\"font-size:12px;\" >Please, Fill this up.</label>';

      }elseif(!empty(\$sponsorsname)){
           \$sponsorsname_msg = \$success_msg;
           \$sponsorsname_iconmsg = \$success_iconmsg;
           \$isSponsornameOk = true;
      }elseif(empty(\$sponsorsname)){ 
           \$sponsorsname_msg = \$error_msg;
           \$sponsorsname_iconmsg = \$error_iconmsg.' - <label style=\"font-size:12px;\" >Only letters are allowed.</label>';
      }


          
\$root_folder = 'wawpromarketingtool/';
\$target_dir = '.././webroot/js/ckeditor/plugins/fileman/Uploads/attachments/';
\$uploadOk = 1;
\$Complete_upload = false;
#-------------------------------------------------------

if(!empty(\$attachments1) || !empty(\$attachments2) || !empty(\$attachments3) || !empty(\$attachments4) || !empty(\$attachments5) || !empty(\$attachments6)){
          \$data_attach = array(
            'a1' => \$attachments1,
            'a2' => \$attachments2,
            'a3' => \$attachments3,
            'a4' => \$attachments4,
            'a5' => \$attachments5,
            'a6' => \$attachments6
            );
          //--------------------------------------------------------



          //--------------------------------------------------------
          \$x_add = '';
          for(\$x=1;\$x<=count(\$data_attach);\$x++){
            
            if(!empty(\$data_attach['a'.\$x]) && !empty(\$data_attach['a'.\$x]['tmp_name'])){

\$target_file = \$target_dir . \$data_attach['a'.\$x][\"name\"];

\$imageFileType = pathinfo(\$target_file,PATHINFO_EXTENSION);

      // Check if image file is a actual image or fake image

    \$check = getimagesize(\$data_attach['a'.\$x][\"tmp_name\"]);
    if(\$check !== false) {
        echo \"File is an image - \" . \$check[\"mime\"] . \".\";
        \$uploadOk = 1;
    } else {
        echo \"File is not an image.\";
        \$uploadOk = 0;
        return \$this->redirect(array('controller' => \$this->Session->read('User.username'),'action' => \$currentSegment.'?msg=fail&err=1'));
       
        //pr(\"File is not an image.\");
    }
// Check if file already exists
if (file_exists(\$target_file)) {
    //echo \"Sorry, file already exists.\";
    \$uploadOk = 0;
    if(\$x == 6)
    \$x_add .= \$x;
    else
    \$x_add .= \$x.', ';
    //return http_redirect(\$root_folder.'mainsites/registration?msg=0&err=2');
    return \$this->redirect(array('controller' => \$this->Session->read('User.username'),'action' => \$currentSegment.'?msg=fail&err=2&attno='.\$x_add));
    //pr(\"Sorry, file already exists.\");
}

// Check file size 500 kb , 40mb , 10mb
if (\$data_attach['a'.\$x][\"size\"] > 10000000) {
    //echo \"Sorry, your file is too large.\";
    \$uploadOk = 0;
    if(\$x == 6)
    \$x_add .= \$x;
    else
    \$x_add .= \$x.', ';
    //return http_redirect(\$root_folder.'mainsites/registration?msg=0&err=3');
    return \$this->redirect(array('controller' => \$this->Session->read('User.username'),'action' => \$currentSegment.'?msg=fail&err=3&attno='.\$x_add));
    //pr(\"Sorry, your file is too large.\");
}

// Allow certain file formats
if(\$imageFileType != \"jpg\" && \$imageFileType != \"png\" && \$imageFileType != \"jpeg\" && \$imageFileType != \"gif\" ) {
    //echo \"Sorry, only JPG, JPEG, PNG & GIF files are allowed.\";
    //return http_redirect(\$root_folder.'mainsites/registration?msg=0&err=4');
  return \$this->redirect(array('controller' => \$this->Session->read('User.username'),'action' => \$currentSegment.'?msg=fail&err=4'));
    \$uploadOk = 0;
  //pr(\"Sorry, only JPG, JPEG, PNG & GIF files are allowed.\");
}
if(\$uploadOk && \$isSponsornameOk && \$isCpasswordOk && \$isPasswordOk && \$isCemailOk && \$isEmailOk && \$isUsernameOk && \$isTwitterOk && \$isFacebookOk && \$isBirthdateOk && \$isAddressOk && \$isExtOk && \$isLnameOk && \$isMnameOk && \$isFnameOk){
move_uploaded_file(\$data_attach['a'.\$x][\"tmp_name\"], \$target_file);
}
  }
 }
}
#-------------------------------------------------------
    
       // exit();
      
      if(\$isSponsornameOk && \$isCpasswordOk && \$isPasswordOk && \$isCemailOk && \$isEmailOk && \$isUsernameOk && \$isTwitterOk && \$isFacebookOk && \$isBirthdateOk && \$isAddressOk && \$isExtOk && \$isLnameOk && \$isMnameOk && \$isFnameOk)
      {
       
        \$Attachment = new Attachment();
        if(!empty(\$attachments1) || !empty(\$attachments2) || !empty(\$attachments3) || !empty(\$attachments4) || !empty(\$attachments5) || !empty(\$attachments6)){
          \$data_attach = array(
            'a1' => \$attachments1,
            'a2' => \$attachments2,
            'a3' => \$attachments3,
            'a4' => \$attachments4,
            'a5' => \$attachments5,
            'a6' => \$attachments6
            );
          //--------------------------------------------------------



          //--------------------------------------------------------
          for(\$x=1;\$x<=count(\$data_attach);\$x++){
            
            if(!empty(\$data_attach['a'.\$x]) && !empty(\$data_attach['a'.\$x]['tmp_name']) && \$data_attach['a'.\$x]['tmp_name'] != ''){
              \$datas = array(
                'username' => \$username,
                'email' => \$email,
                   'image_path' => \$path_to_upload.''.\$data_attach['a'.\$x]['name'],
                   'name' => \$data_attach['a'.\$x]['name'],
                   'type' => \$data_attach['a'.\$x]['type'],
                   'tmp_name' => \$data_attach['a'.\$x]['tmp_name'],
                   'error' => \$data_attach['a'.\$x]['error'],
                   'size' => \$data_attach['a'.\$x]['size']
                );
               
               \$Attachment->create();
              
              if(\$Attachment->save(\$datas)){
                 // Check if \$uploadOk is set to 0 by an error
                 
              }else{
                //\$Complete_upload = false;
              }
             
            }
           
            
          }
          //\$Complete_upload = true;
          //--------------------------------------------------------------
        }
        \$Attachment_db = \$Attachment->find('all',array('conditions' => array(
           'username' => \$username,
           'email' => \$email
          ),'recursive' => -1));
      
        \$attach_arr = array();
        foreach(\$Attachment_db as \$adb_data){
        
         array_push(\$attach_arr, '['.\$adb_data['attachments']['id'].']');
        
        }
        \$ats = '';
        for(\$x=0;\$x<count(\$attach_arr);\$x++){
           \$ats .= \$attach_arr[\$x];
        }
        /**/
       
        if(empty(\$ats))
          \$ats = '';
        
        \$hashpassword = \$secu::hash(\$password,'md5');
        \$doubleCheckPwd = \$secu::hash(\$cpassword,'md5');
        \$data = array(
          'email' => \$email,
          'firstname' => \$fname,
          'middlename' => \$mname,
          'lastname' => \$lname,
          'ext' => \$ext,
          'facebook' => \$facebook,
          'twitter' => \$twitter,
          'address' => \$personal_address,
          'birthdate' => \$birthdate,
          'confirm_email' => \$cemail,
          'sponsorsname' => \$sponsorsname,
          'attachments_id' => \$ats,
          'username' => \$username,
          'password' => \$hashpassword,
          'confirm_password' => \$doubleCheckPwd,
          'group' => 2,
          'membership' => \$membership,
          'terms_and_conditions' => 1,
          'referer_id' => \$this->Session->read('User.id'),
          'verified_account' => 0
          );
        
        
        
        //\$User = new User();
        \$User->create();

        if(\$User->save(\$data)){
          //if no attachments
          //return \$this->redirect(array('controller' => \$this->Session->read('User.username'),'action' => \$currentSegment.'?msg=success&newuid='.\$username));
        }
        
        
        \$User_db2 = \$User->find('first',array('conditions' => array(
          'username' => \$username,
           'email' => \$email
          ),'recursive' => -1));
        \$attachment_arr = '';
          
            
            if(count(\$Attachment_db) > 1){
              
            \$attachment_arr = str_replace('][', '-', \$User_db2['users']['attachments_id']);
            \$attachment_arr = str_replace('[', '', \$attachment_arr);
            \$attachment_arr = str_replace(']', '', \$attachment_arr);
            \$attachment_arr = explode('-', \$attachment_arr);
            for(\$x=0;\$x<count(\$attachment_arr);\$x++){
              \$Attachment->id = \$attachment_arr[\$x];
              \$data = array(
                 'user_id' => \$User_db2['users']['id']
                );
              if(\$Attachment->save(\$data)){
                
              }
             }
             
             
             return \$this->redirect(array('controller' => \$this->Session->read('User.username'),'action' => \$currentSegment.'?msg=success&newuid='.\$username));
             
            }elseif(count(\$Attachment_db) == 1){
             \$attachment_arr = str_replace('[', '', \$User_db2['users']['attachments_id']);
             \$attachment_arr = str_replace(']', '', \$attachment_arr);
             \$Attachment->id = \$attachment_arr;
             

             \$data = array(
                 'user_id' => \$User_db2['users']['id']
                );
              if(\$Attachment->save(\$data)){
                return \$this->redirect(array('controller' => \$this->Session->read('User.username'),'action' => \$currentSegment.'?msg=success&newuid='.\$username));
              }

              
            }else{
              return \$this->redirect(array('controller' => \$this->Session->read('User.username'),'action' => \$currentSegment.'?msg=success&newuid='.\$username));
            }/**/
         
      }else{
        
        //none
        if(\$isPasswordOk && \$isCpasswordOk){
         if(!\$isSponsornameOk || !\$isCemailOk || !\$isEmailOk || !\$isUsernameOk || !\$isTwitterOk || !\$isFacebookOk || !\$isBirthdateOk || !\$isAddressOk || !\$isExtOk || !\$isLnameOk || !\$isMnameOk || !\$isFnameOk){
             \$password_msg = \$warning_msg;
             \$password_iconmsg = \$warning_iconmsg.' - <label style=\"font-size:12px;\" >Write your password again.</label>';
             \$password = null;
             \$isPasswordOk = false;
             \$cpassword_msg = \$warning_msg;
             \$cpassword_iconmsg = \$warning_iconmsg.' - <label style=\"font-size:12px;\" >Write your password again.</label>';
             \$cpassword = null;
             \$isCpasswordOk = false;
         }
        }
      }

    }
    
    \$this->set(compact('cpassword_iconmsg','cpassword_msg','password_iconmsg','password_msg','sponsorsname_iconmsg','sponsorsname_msg','cemail_iconmsg','cemail_msg','email_iconmsg','email_msg','username_iconmsg','username_msg','twitter_iconmsg','twitter_msg','facebook_iconmsg','facebook_msg','birthdate_iconmsg','birthdate_msg','fname_msg','fname_iconmsg','mname_msg','mname_iconmsg','lname_msg','lname_iconmsg','ext_msg','ext_iconmsg','address_msg','address_iconmsg'));
    \$this->set(compact('fname','mname','lname','ext','personal_address','birthdate','facebook','twitter','username','email','cemail','sponsorsname'));
    \$this->set(compact('currentSegment','currentSegment2'));
    
    \$this->render('/Mainsites/'.\$currentSegment);
  }
   public function confirmation(){
    return \$this->redirect(array('controller' => 'mainsites', 'action' => 'confirmation'));
   }
  public function products(){
        \$segments = explode('/', trim(parse_url(\$_SERVER['REQUEST_URI'], PHP_URL_PATH), '/'));
                \$numSegments = count(\$segments); 
                \$currentSegment = \$segments[\$numSegments - 1];
                \$currentSegment2 = \$segments[\$numSegments - 2];
        \$Brand = new Brand();
        if(!empty(\$this->params['url']['bid']))
        \$display_product_as = \$this->params['url']['bid'];
        
        if(!empty(\$display_product_as)){
        \$Brand_Product_db = \$Brand->find('all',array('conditions' => array(
            'brands.id' => \$display_product_as
          ),'recursive' => 1));
        }else{
        \$Brand_Product_db = \$Brand->find('all',array('conditions' => array(
            
          ),'recursive' => 1));
        }
        \$Product = new Product();
        if(!empty(\$display_product_as)){
          \$Product_db = \$Product->find('count',array('conditions' => array(
           'brand_id' => \$display_product_as
            ),'recursive' => -1));
        }else{
        \$Product_db = \$Product->find('count',array('recursive' => -1));
        }
        \$this->set(compact('Product_db','Brand_Product_db','display_product_as','currentSegment2'));
     \$this->render('/Mainsites/'.\$currentSegment);
     
  }
  public function products_edit(){
      \$this->Context->checkSession(\$this);
    \$this->Context->doNotPermit(\$this, '2');
    \$segments = explode('/', trim(parse_url(\$_SERVER['REQUEST_URI'], PHP_URL_PATH), '/'));
                \$numSegments = count(\$segments); 
                \$currentSegment = \$segments[\$numSegments - 1];
    
    \$Brand = new Brand();
    \$Brand_db = \$Brand->find('all',array('recursive' => -1));
    \$Product = new Product();
    \$Product_db = \$Product->find('all',array('recursive' => -1));
    
    \$Brand_Product_db = \$Brand->find('all',array('recursive' => 1));
    
    
    \$this->set(compact('currentSegment','Brand_db','Product_db','Brand_Product_db'));
     \$this->render('/Mainsites/'.\$currentSegment);
    
  }
  
  public function select_view(){
    \$this->Context->checkSession(\$this);
        
        

    if (\$this->Session->read('User.group')==0) \$this->redirect(array('controller' => 'admin', 'action' => '/'));
    if (\$this->Session->read('User.group')==1) \$this->redirect(array('controller' => \$this->Session->read('User.username'), 'action' => '/'));
    if (\$this->Session->read('User.group')==2) \$this->redirect(array('controller' => \$this->Session->read('User.username'), 'action' => '/'));

    exit();
  }
  
  public function logout(){
      \$this->Context->destroy(\$this);
      
      \$this->redirect(array('controller' => 'mainsites', 'action' => 'home'));
      
    
  }
}";
            
            $file = new File('.././Controller/'.$udb2['users']['username'].'Controller.php', true, 0644);
            $file->write($controller_content);
            
            
         }
          
       }
       
        if($User->save($data)){
             if($x == (count($this->request->data) - 1) )
             return $this->redirect(array('controller' => 'mainsites','action' => 'confirmation?msg=success'));  
        
        }

        
      }
      
    }
    
    $this->set(compact('User_db','referer_db','currentSegment'));

  }
	public function products(){
        $segments = explode('/', trim(parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH), '/'));
                $numSegments = count($segments); 
                $currentSegment = $segments[$numSegments - 1];
                $currentSegment2 = $segments[$numSegments - 2];
        $Brand = new Brand();
        if(!empty($this->params['url']['bid']))
        $display_product_as = $this->params['url']['bid'];
        else
        $display_product_as = null;
        if(!empty($display_product_as)){
        $Brand_Product_db = $Brand->find('all',array('conditions' => array(
            'brands.id' => $display_product_as
          ),'recursive' => 1));
        }else{
        $Brand_Product_db = $Brand->find('all',array('conditions' => array(
            
          ),'recursive' => 1));
        }

      
        $Product = new Product();
        $Product_db = $Product->find('count',array('conditions' => array('id' => $display_product_as),'recursive' => -1));
        if($display_product_as == null)
          $Product_db = $Product->find('count',array('recursive' => -1));
        $this->set(compact('Product_db','Brand_Product_db','display_product_as','currentSegment2'));
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
   
    if($this->request->is('post')){
    
    }
    
    
      if(!empty($this->request->data['submit_Products'])){
        if(!empty($this->request->data['Products']) && !empty($this->request->data['Products_name']) && !empty($this->request->data['Products_brand']) && !empty($this->request->data['Products_prize']) && !empty($this->request->data['Products_totalitemavailable'])){
           $fproduct = 0;
           $sizes = null;
           if(!empty($this->request->data['Products_size_s']) || !empty($this->request->data['Products_size_m']) || !empty($this->request->data['Products_size_l']) || !empty($this->request->data['Products_size_xl']))
           $sizes = '['.$this->request->data['Products_size_s'].']'.'['.$this->request->data['Products_size_m'].']'.'['.$this->request->data['Products_size_l'].']'.'['.$this->request->data['Products_size_xl'].']';
           if(!empty($this->request->data['Products_featured']))
           $fproduct = $this->request->data['Products_featured'];
          

           $data = array(
          'item_name' => $this->request->data['Products_name'],
          'image_path' => $this->request->data['path_to_upload'].''.$this->request->data['Products'],
          'color' => $this->request->data['Products_color2'],
          'sizes' => $sizes,
          'brand_id' => $this->request->data['Products_brand'],
          'total' => $this->request->data['Products_totalitemavailable'],
          'prize' => $this->request->data['Products_prize'],
          'featured' => $fproduct
          );
          
            $Product->create();
           if($Product->save($data)){
            
            return $this->redirect(array('controller' => $this->Session->read('User.username'),'action' => $currentSegment));
           }else{
            
           }
        }else{
          
        }/**/
      }
    $this->set(compact('currentSegment','Brand_db','Product_db','Brand_Product_db'));
  }
  public function products_delete($id = null){
    $this->Context->checkSession($this);
    $this->Context->doNotPermit($this, '2');
    
    $Product = new Product();
    $Product->id = $id;
    if (!$Product->exists()) {
      throw new NotFoundException(__('Invalid image'));
    }

    
    if ($Product->delete()) {
      
    } else {
      
    }
    return $this->redirect(array('controller' => $this->Session->read('User.username'),'action' => 'products'));
  }
  public function sold_products(){
      $this->Context->checkSession($this);
      $this->Context->doNotPermit($this, '2');

     
      $SoldProduct = new SoldProduct();
      $SoldProduct_db = $SoldProduct->find('all',array('recursive' => -1));
      $Product = new Product();
      $Product_db = $Product->find('first',array('conditions' => array(
        'id' => $this->request->data['product_id']
        ),'recursive' => -1));
      //pr($this->request->data); exit();

      if($this->request->is('post')){
        
        $data = array(
         'user_id' => $this->request->data['user_id'],
         'product_id' => $this->request->data['product_id'],
         'prize' => $this->request->data['sold_price'],
         'date_sold' => $this->request->data['date_sold']
          );
        $soldOneProduct = ($Product_db['products']['total']) - 1;
        $SoldProduct->create();
        
        if($SoldProduct->save($data)){
               $updateData = array(
                'id' => $this->request->data['product_id'],
                'total' => $soldOneProduct
                );

               if($Product->save($updateData)){
                   return $this->redirect(array('controller' => $this->Session->read('User.username'),'action' => 'products'));
               }else{

               }
        }else{

        }

      }
exit();
  }
	
	public function register(){

	}
	public function forgot_password(){

	}
	public function select_view(){
		$this->Context->checkSession($this);
        
        

		if ($this->Session->read('User.group')==0) $this->redirect(array('controller' => 'mainsites', 'action' => '/'));
		if ($this->Session->read('User.group')==1) $this->redirect(array('controller' => $this->Session->read('User.username'), 'action' => '/'));
		if ($this->Session->read('User.group')==2) $this->redirect(array('controller' => $this->Session->read('User.username'), 'action' => '/'));

		exit();
	}
	public function login(){
       
        $this->layout = 'loginlayout';
       

       $error = 0;
         $usersdb = new User();
         $secu = new Security();
        $error_message = '';
      	$error_input = '';
      	$isEmailValid = '';
      	$isPasswordValid = '';
        $error_feedback = '';
      //pr($secu::hash('2012141018Me','md5')); exit();
     if($this->request->is('post')){
        
        $email_add = $this->request->data['email'];
        $password = $this->request->data['password'];
        $hashpassword = $secu::hash($password,'md5');
        $doubleCheckPwd = $secu::hash($password,'md5');
       
        $users = $usersdb->find('first',array('fields' =>'id,firstname,middlename,lastname,ext,facebook,email,username,password,group' ,'conditions' => array(
        	'email' => $email_add,'verified_account' => 1),'recursive' => -1));

        
        

        if(empty($email_add) || empty($password)) $error = 1;
        if(!empty($users)){
        if(!empty($email_add) && $users['users']['email'] == $email_add && empty($password)) $error = 2;
        if(!empty($email_add) && $users['users']['email'] == $email_add && !empty($password) && $users['users']['password'] != $hashpassword) $error = 2;
        
           
          
          if(!empty($email_add) && !empty($hashpassword)) {
            
            if(!empty($email_add) && $users['users']['email'] == $email_add) $error = 2;
            if(!empty($hashpassword) && $users['users']['password'] == $hashpassword) $error = 2;

               if($users['users']['email'] == $email_add && $users['users']['password'] == $hashpassword){
                    
                    
              
                    
                    $data['User']['id'] = $users['users']['id'];
                    $data['User']['email'] = $users['users']['email'];
                    $data['User']['username'] = $users['users']['username'];
					$data['User']['fname'] = $users['users']['firstname'];
					$data['User']['mname'] = substr($users['users']['middlename'],0,strlen($users['users']['middlename']*(-1)));
					$data['User']['lname'] = $users['users']['lastname'];
					$data['User']['ext'] = $users['users']['ext'];
					$data['User']['group'] = $users['users']['group'];
          $data['User']['facebook'] = $users['users']['facebook'];
                    
                    $this->Context->createUserSession($this, $data);
                    $this->redirect(array('controller' => 'mainsites', 'action' => 'select_view'));

               }else{
               	   
               	
               }
                 
          }else{
          	
          }

        }else{
        	
        	$error = 1;
        }

      }else{
      	
        
      }
        
        switch($error){
          case 1:
            $isEmailValid = 'no';
            $isPasswordValid = 'no';
            $error_message .= '<font style="color:red;">Your WAW account is invalid. <span class="glyphicon glyphicon-remove"></span></font>';
            $error_input = 'has-error has-feedback';
            $error_feedback = '<span class="glyphicon glyphicon-remove form-control-feedback" aria-hidden="true"></span>

      <span id="inputError2Status" class="sr-only">(error)</span>';
          break;
          case 2:
            $isEmailValid = 'yes';
            $isPasswordValid = 'no';
            $error_message .= '<font style="color:red;">Your password is incorrect. Please try again.</font>';
            $error_input = 'has-error has-feedback';
            $success_input = '';
            $error_feedback = '<span class="glyphicon glyphicon-remove form-control-feedback" aria-hidden="true"></span>
      <span id="inputError2Status" class="sr-only">(error)</span>';
          break;
          default:
            $error_message .= '<font>Please enter your WAW account to sign in.</font>';
            $error_input = '';
          break;
        }

        $this->set(compact('isEmailValid','isPasswordValid','error_message','error_input','error_feedback'));
       
	}
	public function logout(){
      $this->Context->destroy($this);
      
      $this->redirect(array('controller' => 'mainsites', 'action' => 'home'));
	}

}
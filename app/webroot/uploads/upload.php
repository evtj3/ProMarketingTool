
<?php 
print_r($_FILES);
print_r($_POST);
/*
$root_folder = 'wawpromarketingtool/';
$target_dir = ".././js/ckeditor/plugins/fileman/Uploads/attachments/";
$target_file = $target_dir . $_FILES["attachment1"]["name"];
$uploadOk = 1;
$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);

// Check if image file is a actual image or fake image
if(isset($_POST["submit"])) {
    $check = getimagesize($_FILES["attachment1"]["tmp_name"]);
    if($check !== false) {
        echo "File is an image - " . $check["mime"] . ".";
        $uploadOk = 1;
    } else {
        echo "File is not an image.";
        $uploadOk = 0;
    }
}
// Check if file already exists
if (file_exists($target_file)) {
    echo "Sorry, file already exists.";
    $uploadOk = 0;
    //return http_redirect($root_folder.'mainsites/registration?msg=0&err=2');
}
// Check file size 500 kb , 40mb
if ($_FILES["attachment1"]["size"] > 40000000) {
    echo "Sorry, your file is too large.";
    $uploadOk = 0;
    //return http_redirect($root_folder.'mainsites/registration?msg=0&err=3');
}
// Allow certain file formats
if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
&& $imageFileType != "gif" ) {
    echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
    //return http_redirect($root_folder.'mainsites/registration?msg=0&err=4');
    $uploadOk = 0;
}
// Check if $uploadOk is set to 0 by an error
if ($uploadOk == 0) {
    echo "Sorry, your file was not uploaded.";
    //return http_redirect($root_folder.'mainsites/registration?msg=0&err=5');
// if everything is ok, try to upload file
} else {
    if (move_uploaded_file($_FILES["attachment1"]["tmp_name"], $target_file)) {
        echo "The file ". basename( $_FILES["attachment1"]["name"]). " has been uploaded.";
        //return http_redirect($root_folder.'mainsites/registration?msg=1');
    } else {
        echo "Sorry, there was an error uploading your file.";
    }
}
/**/
/*
    //database configuration
    $dbHost = 'localhost';
    $dbUsername = 'root';
    $dbPassword = '';
    $dbName = 'wawteamdb';
    //connect with the database
    //$conn = new mysqli($dbHost, $dbUsername, $dbPassword, $dbName);
    //if($mysqli->connect_errno){
    //    echo "Failed to connect to MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
    //}
    
    $targetDir = '/wawpromarketingtool/app/webroot/js/ckeditor/plugins/fileman/Uploads/attachments';
    $fileName = $_FILES['file']['name'];
    $targetFile = $targetDir.$fileName;
    
    if(move_uploaded_file($_FILES['file']['tmp_name'],$targetFile)){
        //insert file information into db table
       // $conn->query("INSERT INTO homeuploads (item_name,item_path) VALUES('".$fileName."','".$targetFile."')");
    }else{
      //pr('ooppss something wrong...');
    }
    

*/
?>
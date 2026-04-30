<?php
session_start();
require_once('../database.php');\
$actionupload=$_POST['actionupload'] ?? '';	
if ($actionupload=='uploadprofilpict') {	
	$target_dir="../../aset/profilpict/";
} else {
	$target_dir="../../aset/images";
}

$tokenform=$_POST['tokenform'] ?? '';



if (isset($_SESSION['user']['id'])){
	if($tokenform===$_SESSION['tokenform']){
		
if(!is_dir($target_dir)){
    mkdir($target_dir,0777,true);
}

if(isset($_FILES['file'])){

    $tmp  = $_FILES['file']['tmp_name'];
    $name = $_FILES['file']['name'];

    // ambil extension file
    $ext = strtolower(pathinfo($name, PATHINFO_EXTENSION));

    // hanya boleh png dan jpg
    $allowed = ['png','jpg','jpeg'];

    if(!in_array($ext,$allowed)){
        http_response_code(400);
        echo "Format file tidak diizinkan";
        exit;
    }

    // buat nama random
    $random_name = 'header-'.bin2hex(random_bytes(16)) . "." . $ext;

    $target = $target_dir.$random_name;

    if(move_uploaded_file($tmp,$target)){
		
        echo "success";
		
    }else{

        http_response_code(500);
        echo "Upload gagal";

    }

}
		
	} else {
		header('location:../logout.php');	
	}
}
else { 
header('location:../logout.php');
}


?>
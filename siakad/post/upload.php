<?php
session_start();
$tokenid=$_POST['tokenid'] ?? '';

if (
	($tokenid==$_SESSION['token']) && (isset($_SESSION['user']['role'])) && ($_SESSION['user']['role']=='admin')
   )
{
require_once('../database.php');
$target_dir="../../aset/images/";

$sql="SELECT * FROM `schoolname` WHERE `id` = ?";
$namasekolah=fetchOne($sql,[2]);
if(file_exists("../../aset/images/".$namasekolah['name'])){
unlink("../../aset/images/".$namasekolah['name']);	
}

function imageToIco($source, $output) {

    $info = getimagesize($source);

    if ($info['mime'] == 'image/png') {
        $img = imagecreatefrompng($source);
    } elseif ($info['mime'] == 'image/jpeg') {
        $img = imagecreatefromjpeg($source);
    } else {
        die("Format harus JPG atau PNG");
    }

    $width = imagesx($img);
    $height = imagesy($img);

    // resize favicon standar
    $icon = imagecreatetruecolor(32, 32);

    imagecopyresampled($icon, $img, 0, 0, 0, 0, 32, 32, $width, $height);

    // simpan sebagai PNG sementara
    $temp = "temp.png";
    imagepng($icon, $temp);

    // convert PNG ke ICO
    $png = file_get_contents($temp);

    $ico = pack('vvv', 0, 1, 1); // header
    $ico .= pack('CCCCvvVV', 32, 32, 0, 0, 1, 32, strlen($png), 22);
    $ico .= $png;

    file_put_contents($output, $ico);

    unlink($temp);

    echo "Favicon berhasil dibuat!";
}



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
    $random_name = bin2hex(random_bytes(16)) . "." . $ext;

    $target = $target_dir.$random_name;

    if(move_uploaded_file($tmp,$target)){
		$sql="UPDATE `schoolname` SET `name` = ? WHERE `schoolname`.`id` = ?";
		query($sql,[$random_name,2]);
        echo "success";
		imageToIco($target, "../../favicon.ico");
    }else{

        http_response_code(500);
        echo "Upload gagal";

    }

}
}
else
{
	 echo "Upload gagal";
}
?>
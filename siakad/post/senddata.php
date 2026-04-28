<?php
session_start();
require_once('../database.php');
$tokenpost=$_POST['tokenform'] ?? '';
$tokensession=$_SESSION['tokenform'] ?? '';
if ($tokenpost===$tokensession){
	if ($_SESSION['user']['role']=='admin') {
		$actionform=$_POST['actionform'] ?? '';
		if ($actionform=='simpan_alamat_sekolah'){
			$alamat=trim($_POST['quillcontent'] ?? '');
			$sqlpost="UPDATE `schoolname` SET `name` = ? WHERE `schoolname`.`id` = ?";
			query($sqlpost,[$alamat,5]);
			echo '<div class="ok-message" style="color:green;">Alamat Sekolah Berhasil di Update</div>';
		} else if ($actionform=='save_submenu') {
			$idmenu=$_POST['idmenu'] ?? '';
			$judulsubmenu=$_POST['judulsubmenu'] ?? '';
			$konten=$_POST['quillcontent'] ?? '';
			$tipe='text';
			$sql="INSERT INTO `submenu` (`id`, `id_menu`, `submenu_item`, `submenu_content`, `type`) VALUES (NULL, ?, ?, ?, ?)";
			query($sql,[$idmenu,$judulsubmenu,$konten,'text']);
			echo '<div class="ok-message" style="color:green;">Sub Menu Berhasil di simpan</div>';
		} else if ($actionform=='update_submenu') {
			$id=$_POST['idmenu'] ?? '';
			$judulmenu=$_POST['judulsubmenu'] ?? '';
			$konten=$_POST['quillcontent'] ?? '';
			$sql="UPDATE `submenu` SET `submenu_item` = ?, `submenu_content` = ? WHERE `submenu`.`id` = ?";
			query($sql,[$judulmenu,$konten,$id]);
			echo '<div class="ok-message" style="color:green;">Data berhasil di update</div>';
		} else if ($actionform=='updateprofil'){
			$id=$_POST['idprofil'];
			$nama=$_POST['nama'];
			$role=$_POST['role'];
			$status=$_POST['status'];
			$gender=$_POST['gender'];
			$tgllhr=$_POST['tgllhr'];
			$nip=$_POST['nip'];
			$email=$_POST['email'];
			$phone=$_POST['phone'];
			$address=$_POST['address'];
			$sql1="UPDATE `users` SET `email` = ?, `role` = ?, `status` = ? WHERE `users`.`id` = ?";
			$sql2="UPDATE `user_profiles` SET `full_name` = ?, `nip` = ?, `phone` = ?, `address` = ?, `gender` = ?, `birth_date` = ? WHERE `user_profiles`.`user_id` = ?;";
			query($sql1,[$email,$role,$status,$id]);
			query($sql2,[$nama,$nip,$phone,$address,$gender,$tgllhr,$id]);
			echo '<div class="ok-message" style="color:green;">Data berhasil di update</div>';
		} else if ($actionform=='tambahuser'){
			echo 'tambah user';
		}
	} else { echo 'Login Terlebih dahulu'; }
} else { echo 'Token Tidak Valid'; }
?>
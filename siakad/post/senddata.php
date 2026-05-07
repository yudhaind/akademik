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
				// 1. Pastikan request datang dari metode POST
				if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    				// 2. Ambil data dan bersihkan dari spasi/karakter berbahaya (Sanitasi)
    				$full_name = trim($_POST['full_name'] ?? '');
    				$username  = trim($_POST['username'] ?? '');
    				$password  = trim($_POST['password'] ?? '');
    				$gender    = trim($_POST['gender'] ?? '');
    				$birthdate = trim($_POST['birthdate'] ?? '');
    				$role      = trim($_POST['role'] ?? '');
    				$nip       = trim($_POST['nip'] ?? '');
    				$email     = trim($_POST['email'] ?? '');
    				$phone     = trim($_POST['phone'] ?? '');
    				$status    = trim($_POST['status'] ?? '');
    				$alamat    = trim($_POST['alamat'] ?? '');

    				// 3. Array untuk menampung pesan error
    				$errors = [];

    				// 4. Validasi: Tidak boleh kosong
    				if (empty($full_name)) $errors[] = "Nama Lengkap wajib diisi.";
    				if (empty($username))  $errors[] = "Username wajib diisi.";
    				if (empty($password))  $errors[] = "Password wajib diisi.";
    				if (empty($email))     $errors[] = "Email wajib diisi.";

    				// 5. Validasi: Format Email
    				if (!empty($email) && !filter_var($email, FILTER_VALIDATE_EMAIL)) {
        				$errors[] = "Format email tidak valid.";
    					}

    				// 6. Cek jika ada error
    				if (!empty($errors)) {
        				// Kirim status error ke AJAX
        				http_response_code(400); // Kode 400 = Bad Request
        				echo implode("<br>", $errors);
        				exit;
    					}

    // --- PROSES SIMPAN KE DATABASE (Contoh menggunakan PDO/MySQLi) ---
    /*
    include "../config/koneksi.php";
    $query = $db->prepare("INSERT INTO users (...) VALUES (...)");
    $query->execute([...]);
    */

    // Jika berhasil
    				echo "Sukses: User baru berhasil ditambahkan.";

				} else {
    			// Jika diakses langsung tanpa POST
    				http_response_code(403);
    				echo "Akses ditolak.";
					}
					//echo 'tambah user';
		} else if ($actionform=='changepassword') {
			echo 'change pwd';
		}
	} else { echo 'Login Terlebih dahulu'; }
} else { echo 'Token Tidak Valid'; }
?>
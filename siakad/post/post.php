<?php
session_start();
require_once('../database.php');

// Cek dulu apakah request POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $action = $_POST['action'] ?? '';

    if ($action === 'login') {

        $username = $_POST['username'] ?? '';
        $password = $_POST['password'] ?? '';

        // Validasi input kosong
        if (empty($username) || empty($password)) {
            $_SESSION['error']="Username dan password wajib diisi";
            exit;
			header('location:../');
        }

        $sql = "SELECT 
                    users.id,
                    users.username,
                    users.password,
                    user_profiles.full_name,
                    users.role,
                    user_profiles.nik,
                    user_profiles.nisn,
                    user_profiles.nip
                FROM users
                INNER JOIN user_profiles 
                    ON users.id = user_profiles.user_id
                WHERE users.username = ?
                LIMIT 1";

        $user = fetchOne($sql, [$username]);

        // Cek user ditemukan dan password tidak null
        if ($user && !empty($password) && password_verify($password, $user['password'])) {

            $_SESSION['user'] = [
                'id'       => $user['id'],
                'username' => $user['username'],
                'nama'     => $user['full_name'], // tadi kamu salah isi
                'role'     => $user['role']
            ];
echo $_SESSION['user']['id'];
         header('location:../');

        } else {
            $_SESSION['error']="Username atau password salah";
			header('location:../');
        }
    }
}
?>
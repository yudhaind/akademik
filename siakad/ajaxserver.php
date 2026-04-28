<?php
session_start();
require_once('database.php');

// ambil semua file php di folder modul
$files = glob(__DIR__ . '/modul/*.php');

// ambil nama file tanpa .php
$allowed_pages = array_map(function($file){
    return basename($file, '.php');
}, $files);

// ambil input
$page = $_GET['page'] ?? '';
$pagetoken = $_POST['pagetoken'] ?? '';

if (isset($_POST['ajax'])) {

    if (isset($_SESSION['user']['id'])) {

        if ($pagetoken === $_SESSION['token']) {

            // cek apakah page valid
            if (in_array($page, $allowed_pages)) {
                include(__DIR__ . '/modul/' . $page . '.php');
            } else {
                echo 'PAGE_NOT_FOUND';
            }

        } else {
            echo 'SESSION_EXPIRED';
        }

    } else {
        echo 'SESSION_EXPIRED';
    }

} else {
    echo 'SESSION_EXPIRED';
}
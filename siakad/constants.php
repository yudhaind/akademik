<?php
/**
 * Konstanta Aplikasi Academic System
 */

// Konfigurasi aplikasi
define('APP_NAME', 'Sistem Akademik');
define('APP_VERSION', '1.0.0');
define('APP_URL', 'http://localhost/academic-system');

// Konfigurasi session
define('SESSION_LIFETIME', 3600); // 1 jam dalam detik
define('SESSION_NAME', 'academic_session');

// Role definitions
define('ROLES', [
    'admin' => [
        'name' => 'Administrator',
        'level' => 1
    ],
    'teacher' => [
        'name' => 'Guru',
        'level' => 2
    ],
    'student' => [
        'name' => 'Siswa',
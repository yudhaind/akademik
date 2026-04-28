<div class="lightbox" id="lightbox">
    <div class="lightbox-content">
        <span class="close-btn" onclick="closeLightbox()">&times;</span>
		<div id="popupcontent"> </div>
      

    </div>
</div>

<!-- DESKTOP SIDEBAR -->
<div class="sidebar">
    <div class="logo">Sekolah Nusantara</div>
    <div class="menu">
        <a href="./">Dashboard</a>
        <a href="?page=user">User</a>
        <a href="#">Akademik</a>
        <a href="#">Absensi</a>
        <a href="#">Tugas</a>
        <a href="#">Rapor</a>
        <a href="#">Laporan</a>
        <a href="?page=pengaturan">Pengaturan</a>
		<a href="?page=profil">Profil</a>
		<a href="logout.php">Logout</a>
    </div>
</div>

<div class="main">
<div id="maincontainer">
    <div class="topbar">
        <h3></h3>
        <div>Hallo : Admin<img src="../aset/icon/profil.png" width="15" height="15" alt=""/></div>
    </div>

    <!-- DESKTOP CONTENT -->
<div id="kontenutama">	
	<?php
	if (isset($_GET['page']))
	{
		$allowed_pages = [
    	'dashboard',
		'pengaturan',
		'user',
		'profil'
		];

$page = $_GET['page'] ?? 'dashboard';

if (in_array($page, $allowed_pages)) {
    echo '<div id="kontenutama">';
	include __DIR__ . '/' . $page . '.php';
	echo '</div>';
} else {
    http_response_code(404);
    echo "404 - Halaman tidak ditemukan";
}
		
	}
	else
	{
	?>
    <div class="cards">
        <div class="card">
            <h3>Total Siswa</h3>
            <h1>520</h1>
        </div>
        <div class="card">
            <h3>Total Guru</h3>
            <h1>32</h1>
        </div>
        <div class="card">
            <h3>Total Kelas</h3>
            <h1>18</h1>
        </div>
        <div class="card">
            <h3>Absensi Hari Ini</h3>
            <h1>487</h1>
        </div>
    </div>

    <div class="activity">
        <h3>Aktivitas Terbaru</h3>
        <ul>
            <li>Guru menambahkan tugas</li>
            <li>Siswa mengumpulkan tugas</li>
            <li>Admin update data kelas</li>
        </ul>
    </div>
	</div>
	<?php 
	}
		?>
	
    <!-- MOBILE LAUNCHER MODE -->

    <div class="mobile-launcher">
		<?php
		if (!isset($_GET['page']))
	{
	?>
		
        <div class="app-icon">
            <span>📊</span>
            <p>Dashboard</p>
        </div>
        <div class="app-icon" onClick="window.location=('?page=user');">
            <span><img src="../aset/icon/usermgt.png" width="30" height="30" alt=""/></span>
            <p>User</p>
        </div>
        <div class="app-icon">
            <span>🏫</span>
            <p>Akademik</p>
        </div>
        <div class="app-icon">
            <span>📷</span>
            <p>Absensi</p>
        </div>
        <div class="app-icon">
            <span>📝</span>
            <p>Tugas</p>
        </div>
        <div class="app-icon">
            <span>📑</span>
            <p>Rapor</p>
        </div>
        <div class="app-icon">
            <span>📈</span>
            <p>Laporan</p>
        </div>
        <div class="app-icon" onClick="window.location=('?page=pengaturan');">
            <span>⚙</span>
            <p>Pengaturan</p>
        </div>
		
		<?php } ?>
    </div>

</div>
</div>
<div class="bottom-nav">

    <a href="./" class="nav-item">
        <div class="nav-icon"><img src="../aset/icon/home.png" width="30" height="30" alt=""/></div>
        <span>Home</span>
    </a>

    <a href="?page=profil" class="nav-item">
        <div class="nav-icon"><img src="../aset/icon/profil.png" width="30" height="30" alt=""/></div>
        <span>Profil</span>
    </a>

    <a href="logout.php" class="nav-item">
        <div class="nav-icon"><img src="../aset/icon/logout.png" width="30" height="30" alt=""/></div>
        <span>Logout</span>
    </a>

</div>
<script type="text/javascript" src="../aset/js/script.js"></script>


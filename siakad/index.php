<?php
session_start();
require_once('database.php');
?>
<!DOCTYPE html>
<html lang="id"><head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover">
<title>System Akademik Online</title>

<link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;600;700&display=swap" rel="stylesheet">
<script type="text/javascript" src="../aset/js/jquery-4.0.0.min.js"></script>
<script type="text/javascript" src="../aset/js/main.js"></script>
<link href="../aset/css/quill.snow.css" rel="stylesheet">
<link href="../aset/css/users.css" rel="stylesheet">
<script type="text/javascript" src="../aset/js/quill.min.js"></script>


<style>
	<?php 
	if (!isset($_SESSION['user']['id']))
	{
	?>
*{
margin:0;
padding:0;
box-sizing:border-box;
font-family:'Montserrat',sans-serif;
}

html,body{
height:100%;
overflow: hidden;

}

body{
min-height:100dvh;
display:flex;
justify-content:center;
align-items:center;
padding:24px 16px; position:relative;	
background:linear-gradient(135deg,#0f172a,#1e293b,#1e3a8a);

}

/* Decorative Blur */
body::before,
body::after{
content:"";
position:absolute;
width:300px;
height:300px;
border-radius:50%;
filter:blur(120px);
opacity:0.25;
z-index:0;
}

body::before{
background:#38bdf8;
top:-120px;
left:-120px;
}

body::after{
background:#9333ea;
bottom:-120px;
right:-120px;
}

/* Card */
.login-card{
position:relative;
width:100%;
max-width:420px;
padding:40px 30px;
border-radius:20px;
background:rgba(255,255,255,0.08);
backdrop-filter:blur(20px);
-webkit-backdrop-filter:blur(20px);
box-shadow:0 20px 40px rgba(0,0,0,0.4);
color:white;
text-align:center;
z-index:1;
animation:fadeIn 0.6s ease;
}

@keyframes fadeIn{
from{opacity:0; transform:translateY(15px);}
to{opacity:1; transform:translateY(0);}
}

.login-card img{
width:70px;
margin-bottom:15px;
}

.login-card h2{
font-size:20px;
font-weight:600;
margin-bottom:25px;
}

/* Input */
.input-group{
text-align:left;
margin-bottom:18px;
}

.input-group label{
font-size:12px;
margin-bottom:6px;
display:block;
opacity:0.8;
}

.input-group input{
width:100%;
padding:12px;
border-radius:10px;
border:1px solid rgba(255,255,255,0.2);
background:rgba(255,255,255,0.15);
color:white;
font-size:14px;
transition:0.3s;
}

.input-group input::placeholder{
color:rgba(255,255,255,0.6);
}

.input-group input:focus{
outline:none;
border-color:#38bdf8;
box-shadow:0 0 0 3px rgba(56,189,248,0.3);
}



/* Button */
.login-btn{
width:100%;
padding:13px;
border:none;
border-radius:10px;
background:linear-gradient(135deg,#38bdf8,#6366f1);
color:white;
font-weight:600;
cursor:pointer;
transition:0.3s;
}

.login-btn:hover{
transform:translateY(-2px);
box-shadow:0 10px 20px rgba(0,0,0,0.3);
}

/* Extra */
.extra{
margin-top:18px;
font-size:12px;
opacity:0.8;
}

.extra a{
color:#38bdf8;
text-decoration:none;
}

.extra a:hover{
text-decoration:underline;
}

/* MOBILE FIX */
@media (max-width:600px){

html,body{
height:100%;
}

body{
display:flex;
justify-content:center;
align-items:center;
padding:20px;
min-height:100svh;
}

/* Hilangkan blur berlebihan */
body::before,
body::after{
width:180px;
height:180px;
filter:blur(90px);
opacity:0.2;
}

/* Card */
.login-card{
width:100%;
max-width:100%;
padding:25px 18px;
border-radius:16px;
margin:0;
}

/* Logo */
.login-card img{
width:60px;
margin-bottom:10px;
}

/* Title */
.login-card h2{
font-size:17px;
margin-bottom:20px;
}

/* Input */
.input-group input{
padding:11px;
font-size:14px;
}

/* Button */
.login-btn{
padding:12px;
font-size:14px;
}

/* Extra text */
.extra{
font-size:11px;
}
}
	<?php
	}
	else
	{
		?>
	*{
    margin:0;
    padding:0;
    box-sizing:border-box;
    font-family:'Inter',sans-serif;
}

body{
    background:linear-gradient(135deg,#4f46e5,#9333ea);
    min-height:100vh;
    display:flex;
}

/* ===== SIDEBAR DESKTOP ===== */
.sidebar{
    width:260px;
    background:rgba(255,255,255,0.1);
    backdrop-filter:blur(20px);
    color:white;
    padding:25px;
    height:100vh;
}

.logo{
    font-size:20px;
    font-weight:700;
    margin-bottom:40px;
}

.menu a{
    display:block;
    text-decoration:none;
    color:white;
    padding:12px;
    border-radius:12px;
    margin-bottom:5px;
    transition:0.3s;
}

.menu a:hover{
    background:rgba(255,255,255,0.2);
}

/* ===== MAIN ===== */
.main{
    flex:1;
    padding:10px;
}

.topbar{
    display:flex;
    justify-content:space-between;
    align-items:center;
    background:rgba(255,255,255,0.2);
    backdrop-filter:blur(15px);
    padding:15px 25px;
    border-radius:20px;
    color:white;
    margin-bottom:30px;
}

/* ===== CARDS ===== */
.cards{
    display:grid;
    grid-template-columns:repeat(auto-fit,minmax(220px,1fr));
    gap:20px;
}

.card{
    background:white;
    padding:25px;
    border-radius:20px;
    box-shadow:0 10px 25px rgba(0,0,0,0.1);
    transition:0.3s;
}

.card:hover{
    transform:translateY(-5px);
}

.card h3{
    color:#64748b;
    font-size:14px;
    margin-bottom:10px;
}

.card h1{
    font-size:28px;
    color:#1e293b;
}

/* ===== ACTIVITY ===== */
.activity{
    margin-top:30px;
    background:white;
    padding:25px;
    border-radius:20px;
    box-shadow:0 10px 25px rgba(0,0,0,0.1);
}

.activity ul{
    list-style:none;
}

.activity li{
    padding:10px 0;
    border-bottom:1px solid #e2e8f0;
}

/* ===== MOBILE LAUNCHER ===== */
.mobile-launcher{
    display:none;
}

	.bottom-nav{
		display: none;
	}

/* ================================
   UNIVERSAL MODERN FORM - YUDHA
================================ */

/* Container */
.form-modern {
    background: #ffffff;
    padding: 10px;
    border-radius: 18px;
    box-shadow: 0 8px 20px rgba(0,0,0,0.05);
   
    margin: auto;
}

/* Group */
.form-group {
    margin-bottom: 2px;
    display: flex;
    flex-direction: column;
	padding-bottom: 5px;
}

/* Label */
.form-group label {
    font-size: 13px;
    font-weight: 600;
    margin-bottom: 6px;
    color: #334155;
}

/* All text-like inputs */
.form-modern input[type="text"],
.form-modern input[type="password"],
.form-modern input[type="email"],
.form-modern input[type="number"],
.form-modern input[type="date"],
.form-modern input[type="datetime-local"],
.form-modern input[type="time"],
.form-modern input[type="search"],
.form-modern input[type="tel"],
.form-modern input[type="url"],
.form-modern select,
.form-modern textarea {
    padding: 10px 12px;
    font-size: 14px;
    border: 1px solid #e2e8f0;
    border-radius: 12px;
    background: #f8fafc;
    outline: none;
    transition: 0.2s;
	margin-bottom: 10px;
}

/* Textarea */
.form-modern textarea {
    min-height: 80px;
    resize: vertical;
	margin-bottom: 10px;
}

/* Focus effect */
.form-modern input:focus,
.form-modern select:focus,
.form-modern textarea:focus {
    border-color: #4f46e5;
    background:#D3D3D3;
    box-shadow: 0 0 0 3px rgba(79,70,229,0.15);
}

/* File Input */
.form-modern input[type="file"] {
    font-size: 13px;
    background: #f8fafc;
    padding: 8px;
    border-radius: 12px;
    border: 1px solid #e2e8f0;
	margin-bottom: 10px;
}

/* Checkbox & Radio Container */
.check-group {
    display: flex;
    align-items: center;
    gap: 8px;
    margin-bottom: 10px;
    font-size: 14px;
	margin-bottom: 10px;
}

/* Custom Checkbox */
.check-group input[type="checkbox"],
.check-group input[type="radio"] {
    width: 16px;
    height: 16px;
    accent-color: #4f46e5;
    cursor: pointer;
}

/* Range */
.form-modern input[type="range"] {
    width: 100%;
    accent-color: #4f46e5;
    cursor: pointer;
	margin-bottom: 10px;
}

/* Color */
.form-modern input[type="color"] {
    height: 40px;
    padding: 3px;
    border-radius: 10px;
    border: 1px solid #e2e8f0;
    cursor: pointer;
	margin-bottom: 10px;
}

/* Button */
.btn-modern {
   
    padding: 12px;
    border: none;
    border-radius: 14px;
    background: #4f46e5;
    color: white;
    font-weight: 600;
    font-size: 14px;
    cursor: pointer;
    transition: 0.3s;
	margin-bottom: 10px;
}

.btn-modern:hover {
    background: #4338ca;
}

.btn-modern:active {
    background: white !important;
    color: #d3d3d3 !important;
    transform: scale(0.97);
}

/* Fokus (balikin lagi) */
.btn-modern:focus {
    background: #4f46e5 !important;
    color: white !important;
    outline: none;
}



.gallery {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(120px, 1fr));
    gap: 10px;
    padding: 10px;
}

/* item gambar */
.item {
    position: relative;
    overflow: hidden;
    border-radius: 10px;
}

/* gambar */
.item img {
    width: 100%;
    height: 120px;
    object-fit: cover;
    display: block;
}

/* tombol hapus */
.btn-hapus {
    position: absolute;
    top: 5px;
    right: 5px;
    background: rgba(255, 0, 0, 0.8);
    color: #fff;
    border: none;
    border-radius: 50%;
    width: 25px;
    height: 25px;
    cursor: pointer;
    font-size: 16px;
    line-height: 25px;
    text-align: center;
}

/* efek hover (desktop) */
.item:hover .btn-hapus {
    background: red;
}
	
/* ===== RESPONSIVE ===== */
@media(max-width:768px){

    body{
        flex-direction:column;
        background:#f1f5f9;
    }

    .sidebar{
        display:none;
    }

    .topbar{
        background:#4f46e5;
        border-radius:0 0 25px 25px;
    }

    .cards,.activity{
        display:none;
    }

    .mobile-launcher{
        display:grid;
        grid-template-columns:repeat(3,1fr);
        gap:10px;
        padding:10px 10px;
    }

    .app-icon{
        background:white;
        border-radius:30px;
        padding:18px;
        text-align:center;
        box-shadow:0 8px 20px rgba(0,0,0,0.1);
        transition:0.3s;
		cursor: pointer;
    }

    .app-icon:hover{
        transform:scale(1.05);
    }

    .app-icon span{
        font-size:28px;
        display:block;
        margin-bottom:10px;
    }

    .app-icon p{
        font-size:13px;
        color:#334155;
    }
	.form-row {
        display: flex;
        gap: 12px;
    }

    .form-row .form-group {
        flex: 1;
    }
	.bottom-nav{
    position:fixed;
    bottom:0;
    left:0;
    width:100%;
    background:#ffffff;
    display:flex;
    justify-content:space-around;
    align-items:center;
    padding:10px 0;
    box-shadow:0 -5px 20px rgba(0,0,0,0.08);
    z-index:999;
}

/* Menu Item */
	.nav-item{
    text-align:center;
    text-decoration:none;
    color:#64748b;
    font-size:12px;
    display:flex;
    flex-direction:column;
    align-items:center;
    gap:6px;
    transition:0.3s;
	
	}

/* Icon Lingkaran */
	.nav-icon{
    width:50px;
    height:50px;
    background:#e2e8f0;
    border-radius:50%;
    display:flex;
    align-items:center;
    justify-content:center;
    font-size:20px;
    transition:0.3s;
	cursor: pointer;
	}

/* Active / Hover */
.nav-item:hover .nav-icon,
.nav-item.active .nav-icon{
    background:#4f46e5;
    color:white;
    transform:translateY(-5px);
	}

	.nav-item:hover,
	.nav-item.active{
    color:#4f46e5;
	}
}
	/* Error */
.error-message{
background:rgba(255,0,0,0.2);
color:black;
padding:8px;
border-radius:8px;
font-size:12px;
margin-bottom:15px;
}

.ok-message{
background:rgba(255,0,0,0.2);
color:black;
padding:8px;
border-radius:8px;
font-size:12px;
margin-bottom:15px;		
}
	
	<?php
	}
		?>

</style>
<link rel="stylesheet" href="../aset/css/lightbox.css">
<link rel="stylesheet" href="../aset/css/uploadstyle.css">
</head>

<body>
	
	<input name="tokenid" type="hidden" id="tokenid" value="<?php 
			$tokenid=bin2hex(random_bytes(32));
			$_SESSION['token']=$tokenid;
			echo $_SESSION['token']; ?>">
	<?php

 

	if (!isset($_SESSION['user']['id']))
	{
	?>
<div class="login-card">
<?php 
	$sql="SELECT * FROM `schoolname` WHERE `id` = ?";
	$logo=fetchOne($sql,[2]);
	?>
<img src="../aset/images/<?php echo $logo['name']; ?>" alt="Logo Sekolah">


<h2>Login Portal Sekolah</h2>

<form action="post/post.php" method="post">

<div class="input-group">
<label>Email / Username</label>
<input name="username" type="text" required placeholder="Masukkan email atau username">
</div>

<div class="input-group">
<label>Password</label>
<input name="password" type="password" required placeholder="Masukkan password">
</div>

<input name="action" type="hidden" value="login">

<?php 
$error = $_SESSION['error'] ?? '';
if(!empty($error)){
echo '<div class="error-message">'.$error.'</div>';
}
unset($_SESSION['error']);
?>

<button type="submit" class="login-btn">Masuk</button>

</form>

<div class="extra">
<p>Lupa password? <a href="#">Reset disini</a></p>
</div>
	<div class="extra">
<p>Kembali ke Halaman Utama? <a href="../">klick disini</a></p>
</div>

</div>
<?php
	}
	else{
		include('modul/dashboard.php');
	}
		?>

</body>
</html>
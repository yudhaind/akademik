<?php require_once('siakad/database.php'); ?>
<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title><?php 
	$sql="SELECT * FROM `schoolname` WHERE `id` = ?";
	$namasekolah=fetchOne($sql,[1]);
	echo $namasekolah['name'];
	?></title>

<link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;600;700&display=swap" rel="stylesheet">

<style>
html{
scroll-behavior:smooth;
}

*{
margin:0;
padding:0;
box-sizing:border-box;
}

body{
font-family:'Montserrat',sans-serif;
background:#f4f6f9;
color:#222;
overflow-x:hidden;
}

.container{
width:90%;
max-width:1200px;
margin:auto;
}

/* ================= HEADER ================= */

header{
position:fixed;
top:0;
left:0;
right:0;
width:100%;
padding:18px 0;
z-index:1000;
transition:0.3s ease;
background:rgba(0,0,0,0.35);
backdrop-filter:blur(8px);
-webkit-backdrop-filter:blur(8px);
}

header.scrolled{
background:#0f172a;
box-shadow:0 5px 20px rgba(0,0,0,0.2);
}

nav{
display:flex;
justify-content:space-between;
align-items:center;
}

.logo{
display:flex;
align-items:center;
gap:10px;
color:white;
font-weight:700;
font-size:16px;
text-shadow:0 2px 6px rgba(0,0,0,0.6);
}

.logo img{
height:40px;
}

nav ul{
list-style:none;
display:flex;
gap:22px;
}

nav ul li a{
color:white;
text-decoration:none;
font-size:14px;
position:relative;
text-shadow:0 2px 6px rgba(0,0,0,0.6);
}

nav ul li a::after{
content:"";
position:absolute;
left:0;
bottom:-5px;
width:0%;
height:2px;
background:#38bdf8;
transition:0.3s;
}

nav ul li a:hover::after{
width:100%;
}

.menu-toggle{
display:none;
color:white;
font-size:26px;
cursor:pointer;
}

/* ================= HERO ================= */

.hero{
position:relative;
height:100dvh;
min-height:100vh;
width:100%;
overflow:hidden;
}

.slide{
position:absolute;
top:0;
left:0;
width:100%;
height:100%;
background-size:cover;
background-position:center;
opacity:0;
transition:opacity 1.5s ease-in-out;
}

.slide.active{
opacity:1;
}

.hero-overlay{
position:absolute;
top:0;
left:0;
width:100%;
height:100%;
background:rgba(0,0,0,0.6);
}

.hero-content{
position:absolute;
top:50%;
left:50%;
transform:translate(-50%,-50%);
text-align:center;
color:white;
max-width:700px;
padding:20px;
}

.hero-content h1{
font-size:38px;
margin-bottom:15px;
}

.hero-content p{
margin-bottom:20px;
}

.btn{
display:inline-block;
background:#38bdf8;
padding:12px 28px;
color:#0f172a;
text-decoration:none;
font-weight:600;
border-radius:5px;
transition:0.3s;
}

.btn:hover{
background:white;
}

/* ================= SECTION ================= */

section{
padding:90px 0;
}

.section-title{
text-align:center;
margin-bottom:45px;
}

.section-title h2{
font-size:28px;
color:#0f172a;
}

.card-grid{
display:grid;
grid-template-columns:repeat(auto-fit,minmax(250px,1fr));
gap:25px;
}

.card{
background:white;
padding:25px;
border-radius:8px;
box-shadow:0 8px 20px rgba(0,0,0,0.05);
transition: 0.3s;
border: 1px solid #eee;
}
	
.card:hover {
  transform: translateY(-5px);
  box-shadow: 0 12px 25px rgba(0,0,0,0.1);
}

/* ================= FOOTER ================= */

footer{
background:#0f172a;
color:white;
text-align:center;
padding:20px 0;
}

/* ================= MOBILE ================= */

@media(max-width:768px){

nav ul{
position:absolute;
top:70px;
left:0;
width:100%;
background:#0f172a;
flex-direction:column;
display:none;
padding:20px 0;
text-align:center;
}

nav ul.active{
display:flex;
}

.menu-toggle{
display:block;
}

.hero-content h1{
font-size:26px;
}

}
</style>
</head>

<body>

<header>
<div class="container">
<nav>
<?php
	$sql="SELECT * FROM `schoolname` WHERE `id` = ?";
	$logosekolah=fetchOne($sql,[2]);
	$logo=$logosekolah['name'];

	?>
<div class="logo">
<img src="aset/images/<?php echo $logo; ?>" alt="Logo Sekolah">
<span><?php 
	
	$namasekolah=fetchOne($sql,[1]);
	echo sc($namasekolah['name']);
	?></span>
</div>

<div class="menu-toggle" onclick="toggleMenu()">☰</div>

<ul id="menu">
<?php
	$sql="SELECT * FROM `menu`";
	$menu=fetchAll($sql);
	foreach($menu as $n){
		$menu=$n['menu'];
		$menu_filter=str_replace(' ','_',$menu);
		?>
	<li><a href="#<?php echo sc($menu_filter); ?>" onclick="closeMenu()"><?php echo sc($menu); ?></a></li>
	<?php
	}
	?>
<li><a href="#kontak" onclick="closeMenu()">Kontak</a></li>
<li><a href="siakad/" onclick="closeMenu()">System Akademik Online</a></li>
</ul>

</nav>
</div>
</header>

<!-- HERO -->
<section class="hero">
<?php
	$sql="SELECT * FROM `header_pict`";
	$countpict=numRows($sql);
	if ($countpict<=0)
	{
	
	?>
<div class="slide active" style="background-image:url('aset/images/header-default-1.jpg');"></div>
<div class="slide" style="background-image:url('aset/images/header-default-2.jpg');"></div>
<div class="slide" style="background-image:url('aset/images/header-default-3.jpg');"></div>
<?php
	}
	else 
	{
		$no=1;
		$pict=fetchAll($sql);
		foreach ($pict as $p){
		$namepict=sc($p['pict_name']);	
		
		?>
	<div class="slide <?php if ($no++==1) { echo 'active';} ?>" style="background-image:url('aset/images/<?php echo $namepict; ?>');"></div>
	<?php
		}
	}
		?>
	
<div class="hero-overlay"></div>

<div class="hero-content">
<h1><?php
	$sql="SELECT * FROM `schoolname` WHERE `id` = ?";
	$logosekolah=fetchOne($sql,[3]);
	$logo=$logosekolah['name'];
	echo sc($logo);
	?></h1>
<p><?php $logosekolah=fetchOne($sql,[4]);
	$logo=$logosekolah['name'];
	echo sc($logo);
	?></p>

</div>

</section>

	<?php 
	$sql="SELECT * FROM `menu`";
	$menu=fetchAll($sql);
	foreach($menu as $n) {
		$idmenu=$n['id'];
		$menu_ori=$n['menu'];
		$menu_filter=str_replace(' ','_',$menu_ori);
?>
<!-- PROFIL -->
<section id="<?php echo sc($menu_filter); ?>">
<div class="container">
<div class="section-title"><h2><?php echo $n['menu']; ?></h2></div>
<div class="card-grid">
	<?php
	$sql="SELECT * FROM `submenu` WHERE `id_menu` = ?";
	$submenu=fetchAll($sql,[$idmenu]);
	foreach ($submenu as $s){
	?>
<div class="card" style="cursor: pointer;" onClick="alert('OK');"><b><?php echo sc($s['submenu_item']); ?></b></div>
<?php
	}
		?>
	</div>
</div>
</section>
<?php 
	}
		?>
<!-- KONTAK -->
<section id="kontak">
<div class="container" style="align-items: center;">
<div class="section-title"><h2>Kontak</h2></div>
<?php 
	$sql="SELECT * FROM `schoolname` WHERE `id` = ?";
	$alamat=fetchOne($sql,[5]);
	$alamatfl=sc($alamat['name']);
	echo nl2br($alamatfl);
	?>
</div>
</section>

<footer>
<p>© <?php echo date('Y').' '.$namasekolah['name'];?></p>
</footer>

<script>
function toggleMenu(){
document.getElementById("menu").classList.toggle("active");
}

function closeMenu(){
document.getElementById("menu").classList.remove("active");
}

window.addEventListener("scroll", function(){
const header = document.querySelector("header");
if(window.scrollY > 50){
header.classList.add("scrolled");
}else{
header.classList.remove("scrolled");
}
});

let slides=document.querySelectorAll(".slide");
let index=0;

setInterval(()=>{
slides[index].classList.remove("active");
index=(index+1)%slides.length;
slides[index].classList.add("active");
},4000);
</script>

</body>
</html>
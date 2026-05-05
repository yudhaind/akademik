 <?php
if (isset($_GET['action'])){
	$idprofil=$_GET['id'];
	$sql="SELECT photo FROM `user_profiles` WHERE `user_id` = ?;";
	$result=fetchOne($sql,[$idprofil]);
	$pictname=$result['photo'];
}
?>
<img src="../aset/profilpict/<?= $pictname; ?>" alt="Foto User">
<?php
	$sql="SELECT * FROM `schoolname` WHERE `id` = ?";
	$namasekolah=fetchOne($sql,[2]);
?>
 
<img src="../aset/images/<?php echo $namasekolah['name']; ?>" width="150" height="150" alt=""/>

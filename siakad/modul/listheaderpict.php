<?php
if (($_POST['act'] ?? '')==='hapus'){
	$idhapus=$_GET['id'];
	$picthapus=$_GET['pictname'];
	if (file_exists('../aset/images/'.$picthapus)) {
		unlink('../aset/images/'.$picthapus);
	} 
	$sqlhapus="DELETE FROM header_pict WHERE `header_pict`.`id` = ?";
	query($sqlhapus,[$idhapus]);
}



$sql="SELECT * FROM `header_pict`";
$pict=fetchAll($sql);
foreach($pict as $p) {
$nama_pict=$p['pict_name'];
$iddata=$p['id'];
	?>
	<div class="item">
      <img src="../aset/images/<?php echo $nama_pict; ?>" alt="">
        <button class="btn-hapus" onClick="hapusdata('listheaderpict','<?php echo $iddata; ?>&pictname=<?php echo $nama_pict; ?>','<?php echo $nama_pict; ?>','galery-container')">×</button>
    </div>
	<?php
	}
?>
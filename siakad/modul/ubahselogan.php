<?php 
if ((($_POST['act'] ?? '')==='updateslogan') && ($_SESSION['user']['role']=='admin'))
{
	$header=$_POST['header'];
	$subheader=$_POST['subheader'];
	
	$sql="UPDATE `schoolname` SET `name` = ? WHERE `schoolname`.`id` = ?;";
	$data=[
		[$header,3],
		[$subheader,4]
	];
	try {
		beginTransaction();
		
		foreach($data as $d){
			query($sql,$d);
			}
		commit();
		echo "<script>alert('Update Data Berhasil');</script>";
		} catch (Exception $e) {
		rollback();
		
		error_log*($e->getMessage());
		echo 'Update Gagal';
	}
	
}

$sql="SELECT * FROM `schoolname` WHERE `id` = ?"
?>
<h2>UBAH SLOGAN SEKOLAH</h2>
<hr>
<form class="form-modern">
	<div class="form-group">
		<label>Header :</label>
		<textarea name="header" id="header"><?php $header=fetchOne($sql,[3]); echo $header['name']; ?></textarea>
		<label>Sub Header :</label>
		<textarea name="subheader" id="subheader"><?php $subheader=fetchOne($sql,[4]); echo $subheader['name']; ?></textarea>
<input type="button" class="btn-modern" value="Simpan" style="background-color: green;" onClick="route('ubahselogan','popupcontent','updateslogan');">
	</div>
	</form>

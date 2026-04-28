<?php
$act=$_POST['act'] ?? '';
$namasekolah=$_POST['namasekolah'] ?? '';
if (($act=='savenamasekolah') && ($_SESSION['user']['role']=='admin')){
	$sql="UPDATE `schoolname` SET `name` = ? WHERE `schoolname`.`id` = ?";
	query($sql,[$namasekolah,1]);
}

$sql="SELECT * FROM `schoolname` WHERE `id` = ?";
$namasekolah=fetchOne($sql,[1]);
?>
<h2>UBAH NAMA SEKOLAH</h2>
 <form class="form-modern">
   <div class="form-group">
     <label>Nama Sekolah</label>
	   <input name="namasekolah" type="text" id="namasekolah" value="<?php echo sc($namasekolah['name']); ?>">
	 </div>
</form>
<?php if ($act=='savenamasekolah') { ?><div class="ok-message">Nama Sekolah Berhasil di Ubah</div> <?php } ?>
<input type="button" class="btn-modern" value="Simpan" onClick="route('ubahnamasekolah','popupcontent','savenamasekolah');">

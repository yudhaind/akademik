<?php
$act=$_POST['act'] ?? '';
if (($act=='tambahmenu') && $_SESSION['user']['role']=='admin' ){
	$sql="INSERT INTO `menu` (`id`, `menu`) VALUES (NULL, ?)";
	$menubaru=$_POST['itemmenu'];
	query($sql,[$menubaru]);
} else if (($act=='hapus') &&($_SESSION['user']['role']=='admin')) {
	$id=$_GET['id'];
	$sql="DELETE FROM menu WHERE `menu`.`id` = ?";
	if (isset($_POST['ajax'])=='ajax'){
		query($sql,[$id]);
	}
	
}
?>
<div>Navigasi : <a href="#" onClick="route('menumanagement','popupcontent','1');">Menu</a> &gt; Tambah Menu </div><br>
<div><input type="button" class="btn-modern" value="< kembali" style=" width: 150px;" onClick="route('menumanagement','popupcontent','1');">
	<div class="form-modern">
		
		<div ><table width="100%" border="0">
  <tbody>
	  <?php
		$sql="SELECT * FROM `menu`";
		$menu=fetchAll($sql);
		$no=1;
		foreach ($menu as $n){
			$idmenu=$n['id'];
			$menu=$n['menu'];
		?>
    <tr>
      <td width="95%" valign="middle"><?php echo $no++.'. '.$n['menu']; ?></td>
      <td width="5%" align="right"><input type="button" value="X" class="btn-modern" style="background-color: red;" onClick="hapusdata('partmenu_tambahmenu','<?php echo $idmenu ?>','<?php echo $menu; ?>','contentmenu')"></td>
    </tr>
	  <?php
		}
		?>
  </tbody>
</table>

		
	</div>
	<form class="form-modern">
	<div class="form-group">
	<label>Menu Baru : </label>
		<input name="menubaru" type="text" id="menubaru">
	</div>
	
	
	</form>
<div><input type="button" class="btn-modern" title="Simpan" value="Tambah" style="background-color: green;" onClick="route('partmenu_tambahmenu','contentmenu','tambahmenu');"></div>
</div>
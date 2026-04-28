<?php
$act=$_POST['act'] ?? '';
if ($act=='hapus'){
	$idhapus=$_GET['id'];
	$sql="DELETE FROM submenu WHERE `submenu`.`id` = ?";
	query($sql,[$idhapus]);
}

?>
<h2>Menu Management</h2>
<hr>
<br>

<div id="contentmenu">
Navigasi:  Menu <br>
	<table width="100%" border="0" cellpadding="0">
    <tbody>
      <tr>
        <td>&nbsp;</td>
      </tr>
      <tr>
	    <td><div><input name="button" type="button" class="btn-modern" id="button" title="Tambah Menu" value="Tambah Menu" onClick="route('partmenu_tambahmenu&id=<?php ?>','contentmenu','1');"></div></td>
      </tr>
      <tr>
        <td>
			
			<table width="100%" border="0">
            <tbody>
				<?php
				$sql="SELECT * FROM `menu`";
				$count=numRows($sql);
				if ($count<=0)
				{
					echo '<tr><td>Data Belum ada</td></tr>';
				} else {
				$menu=fetchAll($sql);
				foreach($menu as $m)
				{
					$idmenu=$m['id'];
					$menu=$m['menu'];
				?>
              <tr>
                <td width="85%"><strong><?php echo $m['menu']; ?></strong></td>
                <td width="12%" align="right"><input type="button" name="button3" id="button3" value="Tambah Sub Menu" class="btn-modern" onClick="route('partmenu_tambahsubmenu&part=add&id=<?php echo $idmenu; ?>','contentmenu','0');"></td>
                <td width="3%" align="right"><input type="button" name="button4" id="button4" value="X" class="btn-modern" style="background-color: red;" onClick="hapusdata('menumanagement','<?php echo $idmenu ?>','<?php echo $menu; ?>','popupcontent')"></td>
              </tr>
              <tr>
                <td colspan="3" align="right">
					<table width="90%" border="0" align="right">
                  <tbody>
					  <?php
					
					$sql="SELECT * FROM `submenu` WHERE `id_menu` = ?";
					$submenu=fetchAll($sql,[$idmenu]);
					$countsm=numRows($sql,[$idmenu]);
					
					if ($countsm<=0){
							echo '<tr><td><em>Sub Menu Belum di buat</em></td></tr>';
						}
						else {
					foreach ($submenu as $sm){
						$iddatasub=$sm['id'];
						$itemsub=$sm['submenu_item'];
					  ?>
                    <tr>
                      <td width="91%"><b><em><?php echo $sm['submenu_item']; ?></em></b></td>
                      <td width="5%"><input type="button" name="button5" id="button5" value="Edit Submenu" class="btn-modern" onClick="route('editsubmenu&id=<?php echo $idmenu; ?>&idsub=<?php echo $iddatasub; ?>','contentmenu','1');"></td>
                      <td width="4%" align="right"><input type="button" name="button2" id="button2" value="X" class="btn-modern" style="background-color: red;" onClick="hapusdata('menumanagement','<?php echo $iddatasub; ?>','<?php echo $itemsub ?>','popupcontent');"></td>
                    </tr>
                    <tr>
                      <td colspan="3"><?php echo $sm['submenu_content']; ?><hr></td>
                      </tr>
					  <?php
					}
						}
					  ?>
                  </tbody>
                </table></td>
              </tr>
            <?php 
				}
				}
				?>
					
            </tbody>
        </table>
		  
		  
		  </td>
      </tr>
      <tr>
        </td>
      </tr>
    </tbody>
  </table>
    
</div>
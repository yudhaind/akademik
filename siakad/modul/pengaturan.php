<div style="background-color: white; border-radius: 25px; padding: 5px;">
<strong><h2>Setting Halaman Landing Page </h2></strong>
<hr>
  <form class="form-modern">
	  <div class="form-group">
	    <table width="100%" border="0">
		      <tbody>
		        <tr>
		          <td width="17%" align="left" valign="top" nowrap="nowrap">Nama Sekolah  </td>
		          <td width="4%" align="left" valign="top">:</td>
		          <td align="left" valign="top"><?php 
					  if (isset($_POST['namasekolah'])){
						  echo $_POST['namasekolah'] ?? '';
					  }
					  else {
						  
					  
					 $sql="SELECT * FROM `schoolname` WHERE `id` = ?";
					  $namasekolah=fetchOne($sql,[1]);
					  echo $namasekolah['name'];
					  }
					  ?></td>
	            </tr>
		        <tr>
		          <td align="left" valign="top" nowrap="nowrap">&nbsp;</td>
		          <td align="left" valign="top">&nbsp;</td>
		          <td align="left" valign="top"><input type="button" class="btn-modern" value="Edit Nama Sekolah" onClick="route('ubahnamasekolah','popupcontent','1');" style="width: 100%;"></td>
	            </tr>
		        <tr>
		          <td align="left" valign="top" nowrap="nowrap">Logo Sekolah</td>
		          <td align="left" valign="top">:</td>
		          <td align="center" valign="middle"><?php 
					  $sql="SELECT * FROM `schoolname` WHERE `id` = ?";
					  $namasekolah=fetchOne($sql,[2]);
					  ?><img src="../aset/images/<?php echo $namasekolah['name']; ?>" width="60" height="60" alt=""/></td>
	            </tr>
		        <tr>
		          <td align="left" valign="top" nowrap="nowrap">&nbsp;</td>
		          <td align="left" valign="top">&nbsp;</td>
		          <td align="left" valign="top"><input type="button" class="btn-modern" value="Ubah Logo Sekolah" onClick="route('ubahlogosekolah','popupcontent','1');" style="width: 100%;"></td>
	            </tr>
		        <tr>
		          <td align="left" valign="top" nowrap="nowrap">Slide Gambar Header</td>
		          <td align="left" valign="top">:</td>
		          <td align="left" valign="top">Tambah / Hapus Gambar Slide Header </td>
	            </tr>
		        <tr>
		          <td align="left" valign="top" nowrap="nowrap">&nbsp;</td>
		          <td align="left" valign="top">&nbsp;</td>
		          <td align="left" valign="top"><input type="button" name="button2" id="button2" value="Edit Gambar Header" class="btn-modern" onClick="route('manage_headerpict','popupcontent','1');" style="width: 100%;"></td>
	            </tr>
		        <tr>
		          <td align="left" valign="top" nowrap="nowrap">Selogan Header</td>
		          <td align="left" valign="top">:</td>
		          <td align="left" valign="top">Edit Header / Selogan Sekolah</td>
	            </tr>
		        <tr>
		          <td align="left" valign="top" nowrap="nowrap">&nbsp;</td>
		          <td align="left" valign="top">&nbsp;</td>
		          <td align="left" valign="top"><input type="button" name="button" id="button" value="Edit Selogan Header" onClick="route('ubahselogan','popupcontent','1');" class="btn-modern" style="width: 100%;"></td>
	            </tr>
		        <tr>
		          <td align="left" valign="top" nowrap="nowrap">Menu Utama</td>
		          <td align="left" valign="top">:</td>
		          <td align="left" valign="top">Edit menu utama pada website sekolah</td>
	            </tr>
		        <tr>
		          <td align="left" valign="top" nowrap="nowrap">&nbsp;</td>
		          <td align="left" valign="top">&nbsp;</td>
		          <td align="left" valign="top"><input type="button" class="btn-modern" value="Manage Menu" onClick="route('menumanagement','popupcontent','1');" style="width: 100%;"></td>
	            </tr>
		        <tr>
		          <td align="left" valign="top" nowrap="nowrap">Alamat Sekolah</td>
		          <td align="left" valign="top">:</td>
		          <td align="left" valign="top">Edit lamat Sekolah</tr>
		        <tr>
		          <td align="left" valign="top" nowrap="nowrap">&nbsp;</td>
		          <td align="left" valign="top">&nbsp;</td>
		          <td align="left" valign="top"><input type="button" name="button3" id="button3" value="Ubah Alamat Sekolah" class="btn-modern" onClick="route('alamatsekolah','popupcontent','1');" style="width: 100%;">		          </tr>
          </tbody>
        </table>
	</div>
	</form>
</div>
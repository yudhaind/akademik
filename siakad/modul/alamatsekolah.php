<?php
$sql='SELECT * FROM `schoolname` WHERE `id` = ?';
$alamat=fetchOne($sql,[5]);
?>
<h1>Alamat Sekolah</h1>
<hr>
<p>
<form action="post/senddata.php" method="post" class="form-modern" id="alamatsekolah">
	<div class="form-group">
		<input name="actionform" type="hidden" id="actionform" value="simpan_alamat_sekolah"><input name="tokenform" type="hidden" id="tokenform" value="<?php 
			$tokenform=bin2hex(random_bytes(32));
			$_SESSION['tokenform']=$tokenform;
			echo $_SESSION['tokenform']; ?>">
	  
		<input type="hidden" name="quillcontent" id="quillcontent">  
      <div id="editor" style="height: 150px;"><?php echo $alamat['name']; ?></div>
		<input name="submit" type="submit" class="btn-modern" id="submit" value="Simpan">
	</div>
	</form>
<div id="hasil"></div>
		<script>
			var quill = new Quill('#editor',{
        theme:'snow',
        modules:{
            toolbar:[
                ['bold','italic','underline'],
                [{'list':'ordered'},{'list':'bullet'}],
                ['link','image'],
                ['clean']
            ]
        }
    });
	//initEditor();
	submitForm('#alamatsekolah','senddata','#hasil','n', quill);
	</script>


<div>Navigasi : <a href="#" onClick="route('menumanagement','popupcontent','1');">Menu</a> &gt; Tambah SubMenu   &gt; </div><br>
<div><input type="button" class="btn-modern" value="< kembali" style=" width: 150px;" onClick="route('menumanagement','popupcontent','0');">
  <br>
<label for="select">Jenis SubMenu dari:</label>
  <select name="select" id="select" class="form-modern" onChange="route('partmenu_tambahsubmenu&part=add&id=<?php echo $_GET['id']; ?>&jenis='+this.value,'contentmenu','0');">
    <option value="text" <?php if (($_GET['jenis'] ?? '')=='text') { echo 'selected'; } ?> > Text</option>
    <option value="album" <?php if (($_GET['jenis'] ?? '')=='album') { echo 'selected'; } ?> >Album Gambar</option>
  </select>
<?php
	if (($_GET['jenis'] ?? '')=='album'){
		?>
	<div>
		<form action="post/upload_gambar.php" method="post" enctype="multipart/form-data" class="form-modern" id="uploadForm">
	<div class="form-group">
		<input type="file" name="file" required><br>
		<label>Keterangan Gambar</label>
		<textarea></textarea>
<input type="submit" class="btn-modern" value="Upload">
	</div>
</form>
<div class="progress">
  <div class="progress-bar">0%</div>
</div>
<div id="notif"></div>
<script>
$("#uploadForm").submit(function(e){

e.preventDefault();

var formData = new FormData(this);

$(".progress").show();
$("#notif").html("");

$.ajax({

url:"post/upload_gambar.php",
type:"POST",
data:formData,
contentType:false,
processData:false,

xhr:function(){

var xhr = new window.XMLHttpRequest();

xhr.upload.addEventListener("progress", function(e){

if(e.lengthComputable){

var percent = Math.round((e.loaded/e.total)*100);

$(".progress-bar").css("width",percent+"%");
$(".progress-bar").text(percent+"%");

}

});

return xhr;

},

success:function(res){

$(".progress-bar").css("width","100%");
$(".progress-bar").text("100%");

$("#notif").html("<span style='color:green'>Upload berhasil</span>");
},

error:function(){

$("#notif").html("<span style='color:red'>Upload gagal</span>");

}

});

});
</script>
		<div class="form-modern">
			<div id="galery-preview"></div>
		</div>
	</div>
	<?php
	}
	else {
	?>
	
  <form action="post/senddata.php" class="form-modern" id="formsubmenu">
	<div class="form-group">
	<label>SubMenu Baru Untuk : </label>
	<input type="text" name="judulsubmenu" id="judulsubmenu">
	<input name="actionform" type="hidden" id="actionform" value="save_submenu">
	<input name="token" type="hidden" id="token" value="<?php echo $_SESSION['token']; ?>">
	<input name="idmenu" type="hidden" id="idmenu" value="<?php echo $_GET['id']; ?>">
	<br>
	<label>Konten Submenu : 
	  <input type="hidden" name="quillcontent" id="quillcontent">
	</label>
	<div id="editor" style="height: 150px;"></div>
	</div><input type="submit" name="submit" id="submit" value="Submit" class="btn-modern">
  </form>
  <div>
    
  </div>
	<div id="hasil"></div>
</div>
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
	submitForm('#formsubmenu','senddata','#hasil','r', quill);
	
</script>
<?php 
	}
		?>

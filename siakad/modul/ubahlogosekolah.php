<h2>UBAH LOGO SEKOLAH</h2>
<hr>

<div style="text-align: center; padding: 15px;" id="logo"><?php include('modul/logo.php'); ?></div>
<form action="post/upload.php" method="post" enctype="multipart/form-data" class="form-modern" id="uploadForm">
	<div class="form-group">
		<input type="file" name="file" required><input type="submit" class="btn-modern" value="Upload">
      <input name="tokenid" type="hidden" id="tokenid" value="<?php echo $_SESSION['token']; ?>">
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

url:"post/upload.php",
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
route('pengaturan','kontenutama','0');
route('logo','logo','0');
},

error:function(){

$("#notif").html("<span style='color:red'>Upload gagal</span>");

}

});

});
</script>
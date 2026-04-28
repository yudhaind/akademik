<h2>ATUR HEADER HALAMAN UTAMA</h2>
<hr>
<div id="preview-image" style="min-height: 200px; overflow: auto;">
<?php
	$sql="SELECT * FROM `header_pict`";
	$pict=fetchAll($sql);
	$countpict=numRows($sql);
	
	
	?>
<div class="gallery" id="galery-container">
	<?php if ($countpict<=0) { ?>
    <div class="item">
      <img src="../aset/images/header-default-1.jpg" alt="">
        <button class="btn-hapus">×</button>
    </div>

    <div class="item">
      <img src="../aset/images/header-default-2.jpg" alt="">
        <button class="btn-hapus">×</button>
    </div>
	<div class="item">
      <img src="../aset/images/header-default-3.jpg" alt="">
        <button class="btn-hapus">×</button>
    </div>
	<?php
} else {
	include('modul/listheaderpict.php');
}
	?>

</div>
</div>
<form action="post/upload_header.php" class="form-modern" id="uploadForm">
<div class="form-group" style="align-items: center;">
	<input name="file" type="file" class="form-modern" id="file"><input type="submit" class="btn-modern" value="Upload" style="width: 40%; background-color: green;">
	
	<input name="token" type="hidden" id="token" value="<?php echo $_SESSION['token']; ?>">
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

url:"post/upload_header.php",
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
route('listheaderpict','galery-container','0');
},

error:function(){

$("#notif").html("<span style='color:red'>Upload gagal</span>");

}

});

});
</script>
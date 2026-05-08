
<div>
  <h1>Edit User</h1></div>
<hr>
<?php
$idprofil=$_GET['id'] ?? '';
$sql="SELECT users.id, users.username, users.email, users.role, users.status, users.created_at, users.updated_at, user_profiles.full_name, user_profiles.nik, user_profiles.nisn, user_profiles.nip, user_profiles.phone, user_profiles.address, user_profiles.gender, user_profiles.birth_date, user_profiles.photo FROM `users` LEFT JOIN user_profiles ON users.id=user_profiles.user_id WHERE users.id=?";

$du=fetchOne($sql,[$idprofil]);
$tgllhr=date('Y-m-d',strtotime($du['birth_date']));
$photo=$du['photo'];
if ($photo==''){
	$pictname='default-photo.png';
} else {
	$pictname=$photo;
}
?>
<div class="profile-container">
    <div class="profile-card">

        <!-- FOTO -->
        <div class="profile-img" id="profil-image">
           <?php include('modul/profilimage.php'); ?>
			<form>
				<div>
				</div>
			</form>
			<div id="notif"></div>
        </div>
		
		<form action="post/uploaddata.php" method="post" enctype="multipart/form-data" class="form-modern" id="uploadprofilpict">
			<div class="form-group">
				<div class="info-item">
                	<span>Foto Profil</span>
               	 	<p>
                  	<input name="tokenform" type="hidden" id="tokenform" value="<?php 
																		$tokenform=bin2hex(random_bytes(32));
																		$_SESSION['tokenform']=$tokenform;
																		echo $_SESSION['tokenform']; ?>">
						<input name="actionform" type="hidden" id="actionform" value="uploadprofilpict">
						<input name="idprofil" type="hidden" id="idprofil" value="<?= $idprofil;?>">
						<input name="file" type="file" id="file">
						<input type="submit" value="Unggah" class="btn-modern">
               	      <input name="actionupload" type="hidden" id="actionupload" value="uploadprofilpict">
               	 	</p>
            	</div>
			</div>
			<div class="progress">
  <div class="progress-bar">0%</div>
</div>
<div id="notif"></div>
		</form>
       
     
       <hr>

        <!-- INFO -->
		<form action="post/senddata.php" method="post" class="form-group" id="updateinfouser" name="upadateinfouser">
        <div class="profile-info form-modern">
			 <div class="info-item">
                <span>Nama</span>
                <p>
                  <input name="nama" type="text" id="nama" value="<?= $du['full_name']; ?>" style="width: 100%">
                  <input name="idprofil" type="hidden" id="idprofil" value="<?= $idprofil; ?>">
                </p>
            </div>
			
			<div class="info-item">
                <span>Role</span>
                <p><?php 
					$r=$du['role'];
					?>
                  <select name="role" id="role" style="width: 100%">
                    <option value="admin" <?php if ($r=='admin'){ echo 'selected';} ?> >admin</option>
                    <option value="student" <?php if ($r=='student'){ echo 'selected';} ?> >student</option>
					  <option value="teacher" <?php if ($r=='teacher'){ echo 'selected';} ?> >teacher</option>
					    <option value="counselor" <?php if ($r=='counselor'){ echo 'selected';} ?> >counselor</option>
				  </select>
              </p>
            </div>
			<div class="info-item">
                <span>Status</span>
                <p><?php 
					$s=$du['status'];
					?>
                  <select name="status" id="status" style="width: 100%">
                    <option value="active" <?php if ($s=='active'){ echo 'selected';} ?> >active</option>
                    <option value="inactive" <?php if ($s=='inactive'){ echo 'selected';} ?> >inactive</option>
                  </select>
              </p>
            </div>
			<div class="info-item">
                <span>Gender</span>
                <p><?php 
					$g=$du['gender'];
					?>
                  <select name="gender" id="gender" style="width: 100%">
                    <option value="male" <?php if ($g=='male'){ echo 'selected';} ?> >Laki-Laki</option>
                    <option value="female" <?php if ($g=='female'){ echo 'selected';} ?> >Perempuan</option>
                  </select>
                </p>
            </div>
			<div class="info-item">
                <span>Birth Date</span>
                <p>
                  <input name="tgllhr" type="date" id="tgllhr" value="<?= $tgllhr; ?>" style="width: 100%">
                </p>
            </div>
			 <div class="info-item">
                <span>NIP / NIS / NIK</span>
                <p>
                  <input name="nip" type="text" id="nip" value="<?= $du['nip']; ?>" style="width: 100%">
                </p>
            </div>
            <div class="info-item">
                <span>Email</span>
                <p>
                  <input name="email" type="text" id="email" value="<?= $du['email']; ?>" style="width: 100%">
                </p>
            </div>
            <div class="info-item">
                <span>Telepon</span>
                <p>
                  <input name="phone" type="text" id="phone" value="<?=  $du['phone']; ?>" style="width: 100%">
                </p>
            </div>
            <div class="info-item">
                <span>Alamat</span>
                <p>
                  <textarea name="address" id="address" cols="45" rows="5" style="width: 100%"><?= $du['address'] ?></textarea>
                </p>
            </div>
        </div>
			<!-- BUTTON -->
        <div class="profile-action">
          <input name="tokenform" type="hidden" id="tokenform" value="<?php 
			echo $_SESSION['tokenform']; ?>">
          <input name="actionform" type="hidden" id="actionform" value="updateprofil">
          <input type="submit" value="Simpan" class="btn primary">
            <input type="button" class="btn" value="Batal" style="background-color: red;" onClick="closeLightbox()">
        </div>
		</form>
        <div id="hasil"></div>

    </div>
</div>
<script>

$("#uploadprofilpict").submit(function(e){

e.preventDefault();

var formData = new FormData(this);

$(".progress").show();
//$("#notif").html("");

$.ajax({

url:"post/uploaddata.php",
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
setTimeout(function () {
    $(".progress").hide(); // bisa juga .hide()
}, 5000); // 5000 ms = 5 detik
//$(".progress").hide();
//$("#notif").html("<span style='color:green'>Upload berhasil</span>");
	route('profilimage&id=<?= $idprofil ?>&action=reload','profil-image','0');
	$("#file").val("");
},

error:function(){

$("#notif").html("<span style='color:red'>Upload gagal</span>");

}

});

});	
submitForm('#updateinfouser','senddata','#hasil',null);
</script>
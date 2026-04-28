<div><h1>Detail User</h1></div>
<hr>
<?php
$idprofil=$_GET['id'] ?? '';
$sql="SELECT users.id, users.username, users.email, users.role, users.status, users.created_at, users.updated_at, user_profiles.full_name, user_profiles.nik, user_profiles.nisn, user_profiles.nip, user_profiles.phone, user_profiles.address, user_profiles.gender, user_profiles.birth_date, user_profiles.photo FROM `users` LEFT JOIN user_profiles ON users.id=user_profiles.user_id WHERE users.id=?";

$du=fetchOne($sql,[$idprofil]);
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
        <div class="profile-img">
            <img src="../aset/profilpict/<?= $pictname; ?>" alt="Foto User">
        </div>

        <!-- NAMA -->
        <h2 class="name"><?= $du['full_name'];?></h2>
        <span class="role <?= $du['role']; ?>"><?= $du['role'].' | '.$du['status']; ?></span>

        <!-- INFO --><form class="form-modern">
        <div class="profile-info form-modern">
			<div class="info-item">
                <span>Gender</span>
                <p><?= $du['gender']; ?></p>
            </div>
			<div class="info-item">
                <span>Birth Date</span>
                <p><?= date('d-m-Y',strtotime($du['birth_date'])); ?></p>
            </div>
			 <div class="info-item">
                <span>NIP / NIS / NIK</span>
                <p><?= $du['nip']; ?></p>
            </div>
            <div class="info-item">
                <span>Email</span>
                <p><?= $du['email']; ?></p>
            </div>
            <div class="info-item">
                <span>Telepon</span>
                <p><?=  $du['phone']; ?></p>
            </div>
            <div class="info-item">
                <span>Alamat</span>
                <p><?= $du['address'] ?></p>
            </div>
        </div>
		<!-- BUTTON -->
		<div class="profile-action">
			<input type="button" class="btn primary" onClick="route('edituser&id=<?= $idprofil; ?>','popupcontent','0');" value="Edit Profil">
            <input type="button" class="btn" value="Setting">
        </div>
</form>
        
        

    </div>
</div>
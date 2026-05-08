<?php
$id=$_GET['id'] ?? '';
$id_sess=$_SESSION['user']['id'];
$role=$_SESSION['user']['role'];
if ($role=='admin'){
	if ($id_sess==$id){
		?>
<form action="post/senddata.php" method="post" class="form-modern" id="formchangepassword">
<input name="actionform" type="hidden" id="actionform" value="changepassword">
  <input type="hidden" name="tokenform" id="tokenform" value="<?php 
	$tokenform=bin2hex(random_bytes(32));
	$_SESSION['tokenform']=$tokenform;
	echo $_SESSION['tokenform']; ?>">
  <input name="iduser" type="hidden" id="iduser" value="<?= $_GET['id']; ?>">
  <div class="form-group">
    <label>Password Lama</label>
	  <input type="password" name="oldpassword" id="oldpassword" placeholder="Old Password">
  </div>
	<div class="form-group">
		<label>New Password</label>
		<input type="password" name="newpassword" id="newpassword" placeholder="New Password">
		<label>Repeat New Password</label>
		<input type="password" name="repeatpassword" id="repeatpassword" placeholder="Repeat New Password">
	</div>
  <input type="submit" class="btn-modern" value="Change Password">
</form>
<div id="hasil"></div>
<?php
	}
	else {
		echo 'oranglain';
	}
}
?>
<script>
submitForm('#formchangepassword','senddata','#hasil','r', null);
</script>
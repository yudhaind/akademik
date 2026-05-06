<div><h1>Tambah User</h1></div>
<hr>
<div>
<form action="post/senddata.php" class="form-modern" id="formtambahuser" method="post">
	<div class="form-group">
		<label>Nama Lengkap :</label>
		<input name="full_name" type="text" id="fullname" placeholder="Nama Lengkap">
	  <label>Username: </label>
		<input name="username" type="text" id="username" placeholder="Username">
		
		<label>Password : </label>
	  <input name="password" type="text" id="password" placeholder="Password">
		
		<label>Gender :</label>
		<select name="gender" id="gender">
			<option value="male">Male</option>
			<option value="female">Female</option>
		</select>
	  <label>Date :</label>
		<input name="birthdate" type="date" id="birthdate">
		
		<label>Role : </label>
		<select name="role" id="role">
		  <option value="admin">Admin</option>
		  <option value="student">Student</option>
		  <option value="teacher">Teacher</option>
		  <option value="councoler">Councelor</option>
		</select>
		
		<label>NIP / NIK / NIS: </label>
		<input name="nip" type="text" id="nip" placeholder="NIK / NIP / NIS">
		
		<label>Email: </label>
		<input name="email" type="text" id="email" placeholder="xxx@mail.com">
		
		<label>Phone :</label>
		<input name="phone" id="phone" type="text" placeholder="Phone">
		
	  <label>Status: </label>
		<select name="status" id="status">
		  <option value="active" selected="selected">Active</option>
		  <option value="inactive">Inactive</option>
		</select>
	  <label>Alamat : </label>
		<textarea name="alamat" id="alamat"></textarea>
	</div>
	
	<input name="actionform" type="hidden" id="actionform" value="tambahuser"><input type="submit" class="btn-modern" value="Tambah">	
</form>
	<div id="hasil"></div>
</div>
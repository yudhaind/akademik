<div><h1>Tambah User</h1></div>
<hr>
<div>
<form action="post/senddata.php" class="form-modern" id="formtambahuser" method="post">
	<div class="form-group">
		<label>Username: </label>
		<input name="username" type="text" id="username" placeholder="Username">
		
		<label>Password : </label>
	  <input name="password" type="text" id="password" placeholder="Password">
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
		
	  <label>Status: </label>
		<select name="status" id="status">
		  <option value="active" selected="selected">Active</option>
		  <option value="inactive">Inactive</option>
		</select>
		
	</div>
	
	<input name="actionform" type="hidden" id="actionform" value="tambahuser"><input type="submit" class="btn-modern" value="Tambah">	
</form>
	<div id="hasil"></div>
</div>
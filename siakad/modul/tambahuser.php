<div><h1>Tambah User</h1></div>
<hr>
<div>
<form action="post/senddata.php" class="form-modern" id="formtambahuser" method="post"><input name="tokenform" type="hidden" id="tokenform" value="<?php 
	$tokenform=bin2hex(random_bytes(32));
	$_SESSION['tokenform']=$tokenform;
	echo $_SESSION['tokenform']; ?>">
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
<script>
/*$(document).ready(function() {
    $(document).on('submit', '#formtambahuser', function(e) {
        e.preventDefault();

        let isValid = true;
        const emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        
        $(this).find('input, select, textarea').css('border', '1px solid #ccc');

        $(this).find('input, select, textarea').each(function() {
            if ($(this).attr('type') !== 'hidden' && $(this).attr('type') !== 'submit') {
                // PERBAIKAN: Gunakan $(this).val().trim() sebagai pengganti $.trim($(this).val())
                let value = $(this).val() ? $(this).val().toString().trim() : "";
                
                if (value === "") {
                    $(this).css('border', '2px solid red');
                    isValid = false;
                }
            }
        });

        const emailInput = $('#email');
        if (emailInput.length && !emailPattern.test(emailInput.val().trim())) {
            emailInput.css('border', '2px solid red');
            alert('Format email tidak valid!');
            isValid = false;
        }

        if (isValid) {
            const formAction = $(this).attr('action');
            const formData = $(this).serialize();

            $.ajax({
                url: formAction,
                type: 'POST',
                data: formData,
                beforeSend: function() {
                    $('.btn-modern').val('Processing...').attr('disabled', true);
                },
                success: function(response) {
                    $('#hasil').html('<div style="color: green; margin-top: 10px;">User berhasil ditambahkan!</div>');
                    $('#formtambahuser')[0].reset();
					route('listuser','list-user','0');
                },
                error: function() {
                    alert('Gagal mengirim data ke server.');
                },
                complete: function() {
                    $('.btn-modern').val('Tambah').attr('disabled', false);
                }
            });
        } else {
            alert('Harap isi semua bidang yang bertanda merah.');
        }
    });
});
</script>
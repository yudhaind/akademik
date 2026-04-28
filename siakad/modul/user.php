
<div style="background-color: white; border-radius: 25px; padding: 10px;">
<strong>
<h2>Manage User </h2></strong>
<hr>
<div class="form-modern">
	<div class="form-group">
		<div class="row-filter">
		<select name="role" id="role" style="30%;">
		  <option value="all">All</option>
		  <option value="student">Murid</option>
		  <option value="teacher">Guru</option>
		  <option value="staff">Staff</option>
		  <option value="search">Cari</option>
		</select>
      	<input type="button" name="button" id="button" value="Filter" class="btn-modern">
		<input type="button" name="button" id="button" value="+ Tambah User" class="btn-modern" onClick="route('tambahuser','popupcontent','1');">
		</div>
	</div>
  </div>
	
	<div id="list-user">
	<?php include('modul/listuser.php'); ?>	
	</div>
	
</div>
<script>
document.addEventListener('click', function(e){

    // klik tombol menu
    if(e.target.classList.contains('menu-btn')){
        let dropdown = e.target.nextElementSibling;

        // tutup semua
        document.querySelectorAll('.dropdown').forEach(d => {
            if(d !== dropdown) d.classList.remove('show');
        });

        dropdown.classList.toggle('show');
    } 
    else {
        // klik luar → tutup semua
        document.querySelectorAll('.dropdown').forEach(d => {
            d.classList.remove('show');
        });
    }

});

</script>
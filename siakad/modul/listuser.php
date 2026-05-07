<?php 
//halaman aktif

$page=isset($_GET['p']) ? (int)$_GET['p']:1;
$page=max($page,1);

$limit=5;
$offset=($page-1)*$limit;

$sql="SELECT 
    users.id,
    users.role,
	users.email,
	users.status,
	users.created_at,
	users.updated_at,
	user_profiles.full_name
FROM users
LEFT JOIN user_profiles 
    ON users.id = user_profiles.user_id
LIMIT ? OFFSET ?";
$hasil=fetchAll($sql,[$limit,$offset]);
$sqlcount="SELECT COUNT(*) as total FROM `users`";
$sqlresult=query($sqlcount);

$data=$sqlresult->fetch(PDO::FETCH_ASSOC);
$sqltotal=$data['total'];

$totalhalaman=ceil($sqltotal/$limit);

?>
<div class="pagination">
	<?php if ($page > 1) { ?>
    <!--<button class="page-btn" onClick="window.location=('?page=user&p=<?= $page-1 ?>');">«</button> -->
	<button class="page-btn" onClick="route('listuser&p=<?= $page-1; ?>','list-user','0');">«</button>
	<?php } ?>
	
	<?php
	for($i=1;$i<=$totalhalaman;$i++) {
		
		if (isset($_GET['p'])) {
			if($i==$_GET['p'] ){
				$a='active';
			}
		} else { 
		  if ($i==1){
			  $a='active';
		  }
		}
	?>
    <!--<button class="page-btn <?= $a ?>" onClick="window.location=('?page=user&p=<?= $i; ?>');"><?= $i; ?></button> -->
	<button class="page-btn <?= $a ?>" onClick="route('listuser&p=<?= $i; ?>','list-user','0');"><?= $i; ?></button>

  <?php } ?>
	
	<?php if ($page < $totalhalaman) { ?>
    <!--<button class="page-btn" onClick="window.location=('?page=user&p=<?= $page+1; ?>')">»</button> -->
	<button class="page-btn" onClick="route('listuser&p=<?= $page+1; ?>')">»</button>
	<?php  } ?>
</div>

<?php $no=$offset+1;
foreach ($hasil as $u){
	$id=$u['id'];
	$fullname=$u['full_name'];
?>
<div class="user-item">  
    <div class="user-left" onClick="route('detailuser&id=<?= $id; ?>','popupcontent','1');">
        <span class="no"><?= $no++; ?></span>
        <div class="user-info">
            <span class="nama"><?= $u['full_name']; ?></span>
            <span class="role <?= $u['role']; ?>"><?= $u['role'].' | status : '.$u['status'];?></span>
			
        </div>
    </div>

    <div class="user-right">
        <button class="menu-btn">⋮</button>

        <div class="dropdown">
			<a href="#" onClick="route('detailuser&id=<?= $id; ?>','popupcontent','1');">Detail</a>
            <a href="#" onClick="route('edituser&id=<?= $id; ?>','popupcontent','1');">Edit</a>
            <a href="#" onClick="route('changepassword&id=<?= $id; ?>','popupcontent','1')">Ganti Password</a>
            <a href="#" class="danger" onClick="hapusdata('listuser','<?= $id; ?>','<?= $fullname ?>','')">Hapus</a>
        </div>
    </div>
</div>
<?php
}
	?>
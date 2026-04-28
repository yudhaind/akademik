<?php 
$id=$_GET['id'] ?? '';
$idsub=$_GET['idsub'] ?? '';
$sql="SELECT menu.id, menu.menu, submenu.id, submenu.submenu_item, submenu.submenu_content FROM `menu` LEFT JOIN submenu ON menu.id=submenu.id_menu Where submenu.id_menu= ? AND submenu.id= ?";
$data=fetchOne($sql,[$id,$idsub]);
$menu=$data['menu'];
$judulsub=$data['submenu_item'];
$subcontent=$data['submenu_content'];
?>
<div>
  <input type="button" class="btn-modern" value="< kembali" style=" width: 150px;" onClick="route('menumanagement','popupcontent','0');">
  <br>
  <form action="post/senddata.php" class="form-modern" id="formsubmenu">
    <div class="form-group">
      <label>SubMenu Title : </label>
      <input name="judulsubmenu" type="text" id="judulsubmenu" value="<?php echo $judulsub; ?>">
      <input name="actionform" type="hidden" id="actionform" value="update_submenu">
      <input name="token" type="hidden" id="token" value="<?php echo $_SESSION['token']; ?>">
      <input name="idmenu" type="hidden" id="idmenu" value="<?php echo $idsub; ?>">
      <br>
      <label>Konten Submenu :</label>
        <input type="hidden" name="quillcontent" id="quillcontent">
      
      <div id="editor" style="height: 150px;"><?php echo $subcontent; ?></div>
    </div>
    <input type="submit" name="submit" id="submit" value="Submit" class="btn-modern">
  </form>
  <div></div>
  <div id="hasil"></div>
</div>
<script>
	var quill = new Quill('#editor',{
        theme:'snow',
        modules:{
            toolbar:[
                ['bold','italic','underline'],
                [{'list':'ordered'},{'list':'bullet'}],
                ['link','image'],
                ['clean']
            ]
        }
    });
	//initEditor();
	submitForm('#formsubmenu','senddata','#hasil','n', quill);
	
</script>

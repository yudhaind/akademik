// JavaScript Document

/*function initEditor(){

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

}
*/

function hapusdata(page,iddata,menu,container){
	
	if (confirm("Apakah Anda yakin ingin hapus data "+menu+'?')){
		route(page+'&id='+iddata,container,'hapus');
		alert('Data '+menu+' dihapus');
	}
}


function route(page,content,action){
	let token=$('#tokenid').val();
	switch (action) {
		case '0':
			var q={ajax:"true",act:action,pagetoken:token};
			stream(content,page,q);	
		break;
		case '1':
			openLightbox();
			var q={ajax:"true",pagetoken:token};
			stream(content,page,q);
		break;
		case 'savenamasekolah':
			var q={ajax:"true",act:action,namasekolah:$('#namasekolah').val(),pagetoken:token};
			stream(content,page,q);
			stream('kontenutama','pengaturan',q);
		break;
		case 'tambahmenu' :
			var q={ajax:"true",act:action,itemmenu:$('#menubaru').val(),pagetoken:token};
			if ($('#menubaru').val()=='') { alert ('Value Tidak Boleh Kosong'); } else {
			stream(content,page,q);	
			}
		break;
		case 'hapus':
			var q={ajax:"true",act:action,pagetoken:token};
			stream(content,page,q);
		break;
		case 'updateslogan' :
			var q={ajax:"true",act:action,header:$('#header').val(),subheader:$('#subheader').val(),pagetoken:token};
			stream(content,page,q);
		break;
	}
	
}

function submitForm(formSelector,url,resultTarget,preform){

    $(document).off("submit", formSelector).on("submit", formSelector, function(e){

        e.preventDefault();

        var form = this;

        $(resultTarget).html('<div align="center"><img src="../aset/images/loader.gif" width="140" height="16"></div>');

        // 🔥 ambil langsung dari global quill
        if (typeof quill !== 'undefined') {

            var isi = quill.root.innerHTML;

            console.log("ISI QUILL:", isi); // DEBUG

            if (isi === '<p><br></p>') {
                isi = '';
            }

            $('#quillcontent').val(isi);
        }

        // 🔥 DEBUG serialize
        console.log($(form).serialize());

        $.ajax({
            url: 'post/'+url+'.php',
            type: "POST",
            data: $(form).serialize(),

            success:function(res){
                $(resultTarget).html(res);

                if (preform=='r'){
                    form.reset();
                    quill.setContents([]);
					
                }
				if (formSelector=='#updateinfouser'){
						route('listuser','list-user','0');
					}
            },

            error:function(){
               alert("Terjadi kesalahan");
            }
        });
    });
}

function stream(c,p,q) {
	$('#'+c).html('<div align="center"><img src="../aset/images/loader.gif" width="140" height="16" alt=""/></div>');
	$.ajax({
		url:'ajaxserver.php?page='+p,
		type:'POST',
		data:q,
		success:function(response) {
			 if(response.trim() === 'SESSION_EXPIRED'){
        		alert('Session habis, silakan login lagi');

        			// redirect ke login
        			window.location.href = 'logout.php';
        			return;
			 	}
			$('#'+c).html(response);
			
	
		},
		error:function(xnr,status,error) {
			$('#'+c).html('<p style="color:red;">Gagal Memuat Data</p>');
		}
	});
}
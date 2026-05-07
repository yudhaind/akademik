$(document).ready(function() {
    $('#formtambahuser').on('submit', function(e) {
        e.preventDefault(); // Mencegah form submit secara default

        // Hapus pesan error sebelumnya
        $('.error-msg').remove();
        $('input, select, textarea').css('border-color', '');

        let isValid = true;
        const emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;

        // 1. Validasi Semua Input (Tidak Boleh Kosong)
        $(this).find('input, select, textarea').each(function() {
            // Kecuali input hidden dan submit
            if ($(this).attr('type') !== 'hidden' && $(this).attr('type') !== 'submit') {
                if ($.trim($(this).val()) === "") {
                    $(this).css('border-color', 'red');
                    isValid = false;
                }
            }
        });

        // 2. Validasi Format Email Spesifik
        const emailInput = $('#email');
        if (emailInput.val() !== "" && !emailPattern.test(emailInput.val())) {
            emailInput.css('border-color', 'red');
            alert('Format email tidak valid!');
            isValid = false;
        }

        // Jika semua validasi lolos, kirim data via AJAX
        if (isValid) {
            const formData = $(this).serialize();

            $.ajax({
                url: $(this).attr('action'),
                type: 'POST',
                data: formData,
                beforeSend: function() {
                    $('.btn-modern').val('Mengirim...').attr('disabled', true);
                },
                success: function(response) {
                    $('#hasil').html('<p style="color: green;">Data berhasil disimpan!</p>');
                    $('#formtambahuser')[0].reset(); // Reset form
                },
                error: function() {
                    $('#hasil').html('<p style="color: red;">Terjadi kesalahan saat mengirim data.</p>');
                },
                complete: function() {
                    $('.btn-modern').val('Tambah').attr('disabled', false);
                }
            });
        } else {
            alert('Mohon lengkapi semua data dengan benar.');
        }
    });
});
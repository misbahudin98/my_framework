$(document).ready(function(){
    $('.ubah').click(function () {
        $('#judul').html('Ubah data ');
        $('.modal-footer button[type=submit]').html('Ubah data');

        const id =$(this).data('id');

        $.ajax({
            type: "post",
            url: "http://localhost/psb/public/about/getUbah",
            data: {id :id },
            dataType:"json",
            success: function (data) {
                $('#username').val(data.username);

                $('#id').val(data.id);
            }
        });
        $('.modal-body form').attr('action','http://localhost/psb/public/about/ubah');

    });
    $('.tambah').click(function () {

        $('#judul').html('Tambah data');
        $('input,textarea').val('');
        $('select option:selected').removeAttr('selected');
        $('.modal-footer button[type=submit]').html('Tambah data');
        $('.modal-body form').attr('action','http://localhost/psb/public/about/tambah');

    });
});
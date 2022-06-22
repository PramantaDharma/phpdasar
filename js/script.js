$(document).ready(function(){

    // hilangkan tombol cari
    $('#butt-search').hide();

    // event ketika ditulis
    $('#keyword').on('keyup', function(){

        // munculkan icon loading
        $('.loader').show();

        // ajax menggunakan load
        // $('#container').load('ajax/hp.php?keyword=' + $('#keyword').val());

        // $.get()
        $.get('ajax/hp.php?keyword=' + $('#keyword').val(), function(data) {

            $('#container').html(data);
            $('.loader').hide();

        });

    });

});
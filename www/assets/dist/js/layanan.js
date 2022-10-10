$(document).ready(function () {
    $('.showKeteranganCustomRate').on("click",function(){
        var keterangan = $(this).data('keterangan');
        $('.keterangan').val(keterangan);
        $('#keteranganModal').modal('show');
    });
});
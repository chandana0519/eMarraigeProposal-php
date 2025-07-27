$(document).ready(function() {
    $("a[name='lnkVerifyEmail']").on('click', function(e) {
        e.preventDefault(); 
        $('#divVerifyEmail').block({
            message:'<p><i class="fa fa-circle-o-notch fa-spin fa-3x"></i><h4>Veryfying your email...</h4></p>'
        });
        $("#frmVerifyEmail").submit();        
        return false;
    });
});
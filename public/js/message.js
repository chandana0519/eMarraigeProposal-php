$(document).ready(function() {
    $("a[name='linkDeleteMessage']").on('click', function(e) {
    	$('#divMailContent').block({
            message:'<p><i class="fa fa-circle-o-notch fa-spin fa-3x"></i><h4>Deleting message...</h4></p>'
        });        
    });
    $("a[name='linkRestoreMessage']").on('click', function(e) {
    	$('#divMailContent').block({
            message:'<p><i class="fa fa-circle-o-notch fa-spin fa-3x"></i><h4>Restoring message...</h4></p>'
        });        
    });
    $("a[name='linkPDeleteMessage']").on('click', function(e) {
    	$('#divMailContent').block({
            message:'<p><i class="fa fa-circle-o-notch fa-spin fa-3x"></i><h4>Permanently Deleting...</h4></p>'
        });        
    });
});
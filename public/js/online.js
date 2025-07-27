$(document).ready(function() {

    if ($('#txtProfileDescription').length){
        $('#txtProfileDescription').elastic();
        $('#txtProfileDescription').trigger('update');    
        $("#txtProfileDescription").focus();
        $("#txtProfileDescription").blur();
    }

    $("a[name='linkOnlineMail']").on('click', function() {
        var data = $(this).data('params');
        $('#hdnSendMailToId').val(data.id);
        $('#hdnSendMailToName').val(data.name);
        $('#lblSendMailTo').text(data.name);
        openpopup('popupSendMail',600);        
        return false;
    });
	
	//$('#frmSendMail').on( 'submit', function(e) {
    $("#btnSendMailSend").on('click', function(e) {
		e.preventDefault();
     	var form = $('#frmSendMail');
		var dataString = form.serialize();
		
		$.ajax({
            type: "POST",
            url : "/message/new",
            data: dataString,
            dataType: "JSON",
            cache: false,
            beforeSend: function (xhr) {
                $('#popupSendMail').block({
                    message:'<p><i class="fa fa-circle-o-notch fa-spin fa-3x"></i><h4>Updating...</h4></p>'                    
                });                
            },
            error: function () {
                
            },
            success: function(data) {
                
            },
            complete: function () {
                var toid=$('#hdnSendMailToId').val();
                ShowClientMessage(toid,'Message successfully sent to ' + data.name + ".",'alert-success');
                $('#popupSendMail').unblock();               
            }
        }) 

		$( "#popup-closebtn" ).trigger( "click" );
		
    });

    $("a[name='linkReplyMail']").on('click', function() {
        var data = $(this).data('params');
        openpopup('popupSendMail',600);        
        return false;
    });

    $("#btnReplyMailSend").on('click', function(e) {         
        e.preventDefault();
        var form = $('#frmReplyMail');
        var dataString = form.serialize();
        
        $.ajax({
            type: "POST",
            url : "/message/reply",
            data: dataString,
            dataType: "JSON",
            cache: false,
            beforeSend: function (xhr) {
                $('#popupSendMail').block({
                    message:'<p><i class="fa fa-circle-o-notch fa-spin fa-3x"></i><h4>Updating...</h4></p>'
                });                
            },
            error: function () {
                
            },
            success: function(data) {
                
            },
            complete: function () {
                $('#popupSendMail').unblock();               
            }
        }) 

        $( "#popup-closebtn" ).trigger( "click" );
        
    });

    $("#btnSendMailSave").on('click', function() {
    	$( "#popup-closebtn" ).trigger( "click" );
    });

    $("#btnSendMailCancel").on('click', function() {
        $( "#popup-closebtn" ).trigger( "click" );
    });

    $("#btnReplyMailCancel").on('click', function() {
        $( "#popup-closebtn" ).trigger( "click" );
    });

    $("a[name='linkOnlineInterest']").on('click', function(e) {
        e.preventDefault();        
        var data = $(this).data('params');
        var updateParameters = GetUserID(data);
        $.ajax({
            type: "POST",
            url : "/interest",
            data: updateParameters,
            dataType: "JSON",
            cache: false,
            beforeSend: function (xhr) {
                var token = $('meta[name="csrf_token"]').attr('value');
                if (token) {
                  return xhr.setRequestHeader('X-CSRF-TOKEN', token);
                }                
            },
            error: function () {
                
            },
            success: function(data) {                
            },
            complete: function () {
                var toid=$('#hdnSendMailToId').val();
                ShowClientMessage(data.id,'Interest successfully sent to ' + data.name + ".",'alert-success');
            }
        });
        return false;
    });

    $("a[name='linkOnlineFavourite']").on('click', function(e) {
        e.preventDefault();        
        var data = $(this).data('params');        
        var updateParameters = GetUserID(data);
        $.ajax({
            type: "POST",
            url : "/favourite",
            data: updateParameters,
            dataType: "JSON",
            cache: false,
            beforeSend: function (xhr) {
                var token = $('meta[name="csrf_token"]').attr('value');
                if (token) {
                  return xhr.setRequestHeader('X-CSRF-TOKEN', token);
                }                
            },
            error: function () {
                
            },
            success: function(data) {
                
            },
            complete: function () {                
            }
        });
        return false;
    });


    function GetUserID(data) {
        return {toUser:data.id,toUserName:data.name}
    }

    function ShowClientMessage(toid,message,cssclass){        
        $("#divClientMessage" + toid).html(message);
        $("#divClientMessage" + toid).removeClass('display-hidden').removeAttr("style").addClass(cssclass);
        $("#divClientMessage" + toid).not('.display-hidden').delay(3000).slideUp(300);
    }

    function wait(ms){
        var start = new Date().getTime();
        var end = start;
        while(end < start + ms) {
            end = new Date().getTime();
        }
    }

});
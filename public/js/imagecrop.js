$(document).ready(function() {
    
    function readURL(input) {
		if (input.files && input.files[0]) {
		    var reader = new FileReader();
		    
		    reader.onload = function (e) {
		    	$('#profilePicpreview').attr('src', e.target.result);
		        $('#blah').attr('src', e.target.result);
		    	$('#blah').Jcrop({
		        	onChange: showPreview,
		          	onSelect: showPreview,
		          	bgOpacity: .4,
		            setSelect: [ 20, 20, 100, 100 ],
		            aspectRatio: 1,
		            allowSelect : false
		        });
		        	        
		    }		    
		    
		    reader.readAsDataURL(input.files[0]);
		}
	}
	
	function showPreview(c)
	{
		var rx = 100 / c.w;
		var ry = 100 / c.h;

		$('#p-x').val(c.x);
		$('#p-y').val(c.y);
		$('#p-w').val(c.w);
		$('#p-h').val(c.h);
		
		$('#profilePicpreview').css({
			width: Math.round(rx * $('#blah').width()) + 'px',
			height: Math.round(ry * $('#blah').height()) + 'px',
			marginLeft: '-' + Math.round(rx * c.x) + 'px',
			marginTop: '-' + Math.round(ry * c.y) + 'px'
		});
		
	}

	$("#profilePicSelect").change(function(){
		var modalContent=$("#hdnmodal-content").clone(true);
		modalContent.attr("id","modal-content");
		modalContent.removeClass("display-hidden");
		$("body").append(modalContent);
		modalContent.find("#blaha").attr("id","blah");
		$("#modal-background").removeClass("display-hidden");
		readURL(this);		
	});

	$("#profilepic-close").click(function (e) {
		//var formData = new FormData($('#frmProfilePic')[0]);
		var x = $('#profilePicSelect')[0].files[0];
		var formData = GetProfilePicParameters();
		$.ajax({
            type: "POST",
            url : "/photo/profile",
            data: formData,
            dataType: "JSON",
            processData: false,
            contentType: false,
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
		$("#modal-content").remove();
		$("#modal-background").addClass("display-hidden");		
		return false;
	});
	
    function GetProfilePicParameters() {
		var formData = new FormData();		
		formData.append('profileimage', $('#profilePicSelect')[0].files[0]);
		formData.append('x', $('#p-x').val());
		formData.append('y', $('#p-y').val());
		formData.append('w', $('#p-w').val());
		formData.append('h', $('#p-h').val());
		return formData;
 	}
    
});
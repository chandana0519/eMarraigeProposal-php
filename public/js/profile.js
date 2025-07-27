$(document).ready(function() {
    $('#btnPersonalInfo').on('click', function() {
        var updateParameters = GetPersonalInfoUpdateParameters();
        var position= $(window).scrollTop();
        $.ajax({
            type: "POST",
            url : "/update",
            data: updateParameters,
            dataType: "JSON",
            cache: false,
            beforeSend: function (xhr) {
                $('.js-personal-info').block({
                    message:'<p><i class="fa fa-circle-o-notch fa-spin fa-3x"></i><h4>Updating...</h4></p>'
                });
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
                CloseEditSection($('.js-personal-info'));
                $('.js-personal-info').unblock();
                if(position>310){
                    $(window).scrollTop(310);
                }
            }
        })        
    });

    $('#btnWorkEdu').on('click', function() {
        var updateParameters = GetWorkEducationUpdateParameters();
        var position= $(window).scrollTop();
        $.ajax({
            type: "POST",
            url : "/update",
            data: updateParameters,
            dataType: "JSON",
            cache: false,
            beforeSend: function (xhr) {
                $('.js-work-education').block({
                    message:'<p><i class="fa fa-circle-o-notch fa-spin fa-3x"></i><h4>Updating...</h4></p>'
                });
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
                CloseEditSection($('.js-work-education'));
                $('.js-work-education').unblock();
                if(position>310){
                    $(window).scrollTop(310);
                }
            }
        })        
    });

    $('#btnLocResidency').on('click', function() {
        var updateParameters = GetLocationResidencyParameters();
        var position= $(window).scrollTop();
        $.ajax({
            type: "POST",
            url : "/update",
            data: updateParameters,
            dataType: "JSON",
            cache: false,
            beforeSend: function (xhr) {
                $('.js-location-residency').block({
                    message:'<p><i class="fa fa-circle-o-notch fa-spin fa-3x"></i><h4>Updating...</h4></p>'
                });
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
                CloseEditSection($('.js-location-residency'));
                $('.js-location-residency').unblock();
                if(position>310){
                    $(window).scrollTop(310);
                }
            }
        })        
    });

    $('#btnAbtPartner').on('click', function() {
        var updateParameters = GetAbtPartnerUpdateParameters();
        var position= $(window).scrollTop();
        $.ajax({
            type: "POST",
            url : "/update",
            data: updateParameters,
            dataType: "JSON",
            cache: false,
            beforeSend: function (xhr) {
                $('.js-abt-partner').block({
                    message:'<p><i class="fa fa-circle-o-notch fa-spin fa-3x"></i><h4>Updating...</h4></p>'
                });
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
                CloseEditSection($('.js-abt-partner'));
                $('.js-abt-partner').unblock();
                if(position>310){
                    $(window).scrollTop(310);
                }
            }
        })
    });

    $("#btnBasicSettings").on('click', function(e) {
        e.preventDefault();
        var updateParameters = GetBasicSettingsParameters();
        var position= $(window).scrollTop();
        $.ajax({
            type: "POST",
            url : "/update",
            data: updateParameters,
            dataType: "JSON",
            cache: false,
            beforeSend: function (xhr) {
                $('.js-basic-settings').block({
                    message:'<p><i class="fa fa-circle-o-notch fa-spin fa-3x"></i><h4>Updating...</h4></p>'
                });
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
                CloseEditSection($('.js-basic-settings'));                
                $('.js-basic-settings').unblock();
                if(position>310){
                    $(window).scrollTop(310);
                }
            }
        });
        
    });

    $("#btnChangePassword").on('click', function(e) {
        e.preventDefault();
        var form = $('#frmChangePassword');
        var dataString = form.serializeArray();        
        dataString.push({name: 'usection', value: 6});
        var position= $(window).scrollTop();
        $.ajax({
            type: "POST",
            url : "/update",
            data: dataString,
            dataType: "JSON",
            cache: false,
            beforeSend: function (xhr) {
                $('.js-change-password').block({
                    message:'<p><i class="fa fa-circle-o-notch fa-spin fa-3x"></i><h4>Updating...</h4></p>'
                });
                var token = $('meta[name="csrf_token"]').attr('value');
                if (token) {
                  return xhr.setRequestHeader('X-CSRF-TOKEN', token);
                }
            },
            error: function () {
                
            },
            success: function(data) {  
                handleChangePasswordData(data);
            },
            complete: function () {                
                $('.js-change-password').unblock();
                if(position>310){
                    $(window).scrollTop(310);
                }            
            }
        });        
    });

    $(document).on('click', '.toggle-active-button', function() {
        $(this).toggleClass('toggle-active-button-selected');
        if ($(this).hasClass( "toggle-active-button-selected" )) {
            $(this).find("span#btntext").text("Active");
        } else {
            $(this).find("span#btntext").text("Inactive");
        }
    });

    $(document).on('click', '.toggle-yes-button', function() {
        $(this).toggleClass('toggle-yes-button-selected');        
    });

    $('.js-location-residency #country').on('change', function() {
        //var updateParameters = {loctype:2, id:190};
        var updateParameters = {loctype:2, id:$(this).val()};
        fillLocationDropdown($('.js-location-residency #state'),$('.js-location-residency #divProgressState'),updateParameters);
    });

    $('.js-location-residency #state').on('change', function() {
        var updateParameters = {loctype:3, id:$(this).val()};
        fillLocationDropdown($('.js-location-residency #city'),$('.js-location-residency #divProgressCity'),updateParameters);
    });

    function fillLocationDropdown(dropdown,progress,updateParameters){
        $.ajax({
            type: "POST",
            url : "/location",
            data: updateParameters,
            dataType: "JSON",
            beforeSend: function (xhr) {
                dropdown.prop("disabled", true);
                $(progress).removeClass("display-hidden");
                var token = $('meta[name="csrf_token"]').attr('value');
                if (token) {
                  return xhr.setRequestHeader('X-CSRF-TOKEN', token);
                }                
            },
            error: function () {                
            },
            success: function(data) {                
                //dropdown.append($('<option>').val(this.value).text(this.label));
                dropdown.empty();
                dropdown.append($('<option>').val(0).text('  -- Please Select --  '));
                //$(data).each(function(id, name)
                $.each(data , function(id, name)
                 {   
                     //ption.attr('value', this.value).text(this.label);
                     //$('#myDropDown').append(option);
                     dropdown.append($('<option>').val(id).text(name));
                     //return $('<option>').val(this.id).text(this.name);                    
                 });
            },
            complete: function () {
                //alert(progress.attr('id'));
                progress.addClass("display-hidden");
                dropdown.prop("disabled", false);
            }
        })  
    }

    function getApprerense(){
        var apprerense = [  
                            $('.js-personal-info #height').selectedText(),
                            $('.js-personal-info #weight').selectedText(),
                            $('.js-personal-info #bodytype').selectedText(),
                            $('.js-personal-info #complexion').selectedText()
                        ];
        return apprerense.filter(Boolean).join(", ");
    }

    function getLocationText(){
        var city = $('.js-location-residency #city').val() > 0 ? 
                        $('.js-location-residency #city').selectedText() : $('.js-location-residency #state').selectedText() ;
        var loc = [
                    city,
                    $('.js-location-residency #country').selectedText()                            
                  ];                  
        return loc.join(", ");
    }

     function GetPersonalInfoUpdateParameters() {
        var title = $.trim($('.js-personal-info #title').val());
        var aboutme = $.trim($('.js-personal-info #aboutme').val());
        var maritalstatus = $('.js-personal-info #maritalstatus').val();
        var height = $('.js-personal-info #height').val();
        var weight = $('.js-personal-info #weight').val();
        var bodytype = $('.js-personal-info #bodytype').val();
        var complexion = $('.js-personal-info #complexion').val();
        var living = $('.js-personal-info #living').val();
        var kids = $('.js-personal-info #kids').val();
        var smoking = $('.js-personal-info #smoking').val();
        var drinking = $('.js-personal-info #drinking').val();
        var complted = 0;

        if (title.length>0) complted++;
        if (aboutme.length>0) complted++;
        if (maritalstatus>0) complted++;
        if (height>0) complted++;
        if (weight>0) complted++;
        if (bodytype.length>0) complted++;
        if (complexion.length>0) complted++;
        if (living.length>0) complted++;
        if (kids>0) complted++;
        if (smoking>0) complted++;
        if (drinking>0) complted++;
        complted = (100/11|0)*complted;

        $('.js-personal-info #lbltitle').text(title);
        $('.js-personal-info #lblaboutme').text(aboutme);
        $('.js-personal-info #lblmaritalstatus').text($('.js-personal-info #maritalstatus').selectedText());
        $('.js-personal-info #lblappearance').text(getApprerense());
        $('.js-personal-info #lblliving').text($('.js-personal-info #living').selectedText());
        $('.js-personal-info #lblkids').text($('.js-personal-info #kids').selectedText());
        $('.js-personal-info #lblsmoking').text($('.js-personal-info #smoking').selectedText());
        $('.js-personal-info #lbldrinking').text($('.js-personal-info #drinking').selectedText());
        $('.js-personal-info #completePercentage').text(complted);

        return {title:title, aboutme:aboutme, maritalstatus:maritalstatus, height:height, weight:weight, bodytype:bodytype, complexion:complexion, 
                 living:living, kids:kids, smoking:smoking, drinking:drinking,usection:1}
     }

     function GetWorkEducationUpdateParameters() {
        var work = $('.js-work-education #work').val();
        var education = $('.js-work-education #education').val();
        var complted = 0;

        if (work>0) complted++;
        if (education>0) complted++;
        complted = (100/2|0)*complted;
        
        $('.js-work-education #lblwork').text($('.js-work-education #work').selectedText());
        $('.js-work-education #lbleducation').text($('.js-work-education #education').selectedText());
        $('.js-work-education #completePercentage').text(complted);

        return {work:work, education:education, usection:2}
     }

    function GetLocationResidencyParameters() {
        var country = $('.js-location-residency #country').val();
        var state = $('.js-location-residency #state').val();
        var city = $('.js-location-residency #city').val();
        var residency = $.trim($('.js-location-residency #residency').val());
        var complted = 0;

        if (country>0) complted++;
        if (state>0) complted++;
        if (city>0) complted++;
        if (title.length>0) complted++;
        complted = (100/4|0)*complted;
        
        $('.js-location-residency #lbllocation').text(getLocationText());
        $('.js-location-residency #lblresidency').text(residency);
        $('.js-location-residency #completePercentage').text(complted);

        return {country:country, state:state, city:city, residency:residency ,usection:3}
    }

    function GetAbtPartnerUpdateParameters() {
        var relationship = $('.js-abt-partner #relationship').val();
        var agepreference = $('.js-abt-partner #agepreference').val();
        var rangedata = $.trim($('.js-abt-partner #prefreredage').val());
        var agerange = rangedata.split(",");
        var minage = agerange[0];
        var maxage = agerange[1];
        
        $('.js-abt-partner #lblrelationship').text($('.js-abt-partner #relationship').selectedText());
        $('.js-abt-partner #lblagepreference').text(agepreference);
        $('.js-abt-partner #lblprefreredage').text(minage+' to '+maxage);
        
        return {relationship:relationship, agepreference:agepreference, minage:minage, maxage:maxage, usection:4}
     }

    function GetBasicSettingsParameters() {
        var email = $.trim($('.js-basic-settings #email').val());
        var dateofbirth = $('.js-basic-settings #dateofbirth').val();
        
        $('.js-basic-settings #lblemail').text(email);
        $('.js-basic-settings #lbldateofbirth').text(dateofbirth);

        return {email:email, dateofbirth:dateofbirth ,usection:5}
    }

    function handleChangePasswordData(data){
        if(data.success){
            CloseEditSection($('.js-change-password'));                
            ShowClientMessage('divClientMessagePasswordSuccess',data.message,'alert-success');
        }else{
            ShowClientMessage('divClientMessagePasswordError',data.message,'alert-error');
        }
    }

    function CloseEditSection(editableSection) { 
        editableSection.find(".ui-icon").removeClass("ui-icon-active");
        editableSection.find(".section-editable-view").removeClass("hidden-mode").addClass("view-mode");
        editableSection.find(".section-editable-edit").removeClass("view-mode").addClass("hidden-mode");        
    }

    function ShowClientMessage(clientmessageid,message,cssclass){        
        $("#" + clientmessageid).html(message);
        $("#" + clientmessageid).removeClass('display-hidden').removeAttr("style").addClass(cssclass);
        $("#" + clientmessageid).not('.display-hidden').delay(5000).slideUp(300);
    }

});
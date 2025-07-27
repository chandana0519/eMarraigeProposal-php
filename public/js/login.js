$(document).ready(function() {
    $('#loginForm').formValidation({
        framework: 'bootstrap',
        excluded: ':disabled',
        icon: {
            valid: 'glyphicon glyphicon-ok',
            invalid: 'glyphicon glyphicon-remove',
            validating: 'glyphicon glyphicon-refresh'
        },
        fields: {
            username: {
                validators: {
                    notEmpty: {
                        message: 'The username is required'
                    }
                }
            },
            password: {
                validators: {
                    notEmpty: {
                        message: 'The password is required'
                    }
                }
            }
        }
    })
     .on('keyup', '[name="username"], [name="password"]', function(e) {
        if($('#divLoginErr').length){
            $('#divLoginErr').addClass('display-hidden');
        }
     });

    $('#registrationForm').formValidation({
        framework: 'bootstrap',
        excluded: ':disabled',
        icon: {
            valid: 'glyphicon glyphicon-ok',
            invalid: 'glyphicon glyphicon-remove',
            validating: 'glyphicon glyphicon-refresh'
        },
        fields: {
            username: {
                validators: {
                    notEmpty: {
                        message: 'The username is required'
                    }
                }
            },
            password: {
                validators: {
                    notEmpty: {
                        message: 'The password is required'
                    }
                }
            },
            password_confirmation: {
                validators: {
                    notEmpty: {
                        message: 'The password confirmation is required'
                    }
                }
            },
            email: {
                validators: {
                    notEmpty: {
                        message: 'The Email Address is required'
                    }
                }
            },
            sex: {
                validators: {
                    callback: {
                        message: 'Please select your Sex',
                        callback: function(value, validator, $field) {
                            // Get the selected options
                            var options = validator.getFieldElements('sex').val();
                            return (options != null && options > 0);
                        }
                    }
                }
            },
            dob: {
                validators: {
                    notEmpty: {
                        message: 'Please select your Date of Birth'
                    }
                }
            },
            country: {
                validators: {
                    callback: {
                        message: 'Please select your Country',
                        callback: function(value, validator, $field) {
                            // Get the selected options
                            var options = validator.getFieldElements('country').val();
                            return (options != null && options > 0);
                        }
                    }
                }
            }
        }
    })
    .on('err.field.fv', function(e, data) {
        // $(e.target)  --> The field element
        // data.fv      --> The FormValidation instance
        // data.field   --> The field name
        // data.element --> The field element

        // Hide the messages
        data.element
            .data('fv.messages')
            .find('.help-block[data-fv-for="' + data.field + '"]').hide();
    });
});
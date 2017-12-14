var FormWizard = function() {


    return {
        //main function to initiate the module
        init: function() {
            if (!jQuery().bootstrapWizard) {
                return;
            }

            function format(state) {
                if (!state.id)
                    return state.text; // optgroup
                return "<img class='flag' src='/assets/global/img/flags/" + state.id.toLowerCase() + ".png'/>&nbsp;&nbsp;" + state.text;
            }

            $("#country_list").select2({
                placeholder: "Select",
                allowClear: true,
                formatResult: format,
                formatSelection: format,
                escapeMarkup: function(m) {
                    return m;
                }
            });

            var form = $('#submit_form');
            var error = $('.alert-danger', form);
            var success = $('.alert-success', form);

            jQuery.validator.addMethod("password", function(value, element) {
                return this.optional(element) || /(?=.*[0-9])(?=.*[a-zA-Z]).{8,20}/.test(value);
            }, "Minimum 8 charecters. Enter a combination containing letters, numerics & special characters"),
                    jQuery.validator.addMethod("money", function(value, element) {
                return this.optional(element) || /((?=.*[0-9])\d{1,5}(?:\.\d{1,2})?|100000.00|100000)/.test(value);
            }, "Accepts only numeric characters."),
                    jQuery.validator.addMethod("greater", function(value, element, compair) {
                if (parseInt($(compair).val()) > parseInt(value))
                {
                    return false;
                }
                else
                {
                    return true;

                }
            }, "Value should be greater than minimum."),
                    jQuery.validator.addMethod("less", function(value, element, compair) {
                if (parseInt($(compair).val()) < parseInt(value))
                {
                    return false;
                }
                else
                {
                    return true;

                }
            }, "Value should be less than maximum.");

            form.validate({
                doNotHideMessage: true, //this option enables to show the error/success messages on tab switch.
                errorElement: 'span', //default input error message container
                errorClass: 'help-block help-block-error', // default input error message class
                focusInvalid: false, // do not focus the last invalid input
                rules: {
                    //account
                    username: {
                        minlength: 5,
                        required: true
                    },
                    password: {
                        minlength: 8,
                        maxlength: 50,
                        password: true,
                        required: true
                    },
                    rpassword: {
                        minlength: 8,
                        required: true,
                        equalTo: "#submit_form_password"
                    },
                    //profile
                    fullname: {
                        required: true
                    },
                    email: {
                        required: true,
                        email: true
                    },
                    phone: {
                        required: true
                    },
                    mobile: {
                        required: true,
                        digits: true,
                        maxlength: 13,
                        minlength: 10
                    },
                    gender: {
                        required: true
                    },
                    address: {
                        required: true
                    },
                    city: {
                        required: true,
                        maxlength: 40,
                        lettersonly: true
                    },
                    zip: {
                        required: true,
                        maxlength: 10,
                        minlength: 6,
                        digits: true
                    },
                    state: {
                        required: true,
                        maxlength: 40,
                        lettersonly: true
                    },
                    country: {
                        required: true,
                        maxlength: 40,
                        lettersonly: true
                    }
                    ,
                    min_price: {
                        money: true,
                        less: "#max_amount"
                    }
                    ,
                    max_price: {
                        money: true,
                        greater: "#min_amount"
                    },
                    unitcost: {
                        money: true
                    }
                    ,
                    min_seat: {
                        digits: true,
                        less: "#max_seat"
                    }
                    ,
                    max_seat: {
                        digits: true,
                        greater: "#min_seat"

                    }
                    ,
                    unitavailable: {
                        digits: true
                    }

                },
                messages: {// custom messages for radio buttons and checkboxes
                    'confirm': {
                        required: "Please confirm terms & conditions",
                        minlength: jQuery.validator.format("Please confirm terms & conditions")
                    }
                },
                errorPlacement: function(error, element) { // render error placement for each input type
                    if (element.attr("name") == "gender") { // for uniform radio buttons, insert the after the given container
                        error.insertAfter("#form_gender_error");
                    } else if (element.attr("name") == "confirm") { // for uniform checkboxes, insert the after the given container
                        error.insertAfter("#form_payment_error");
                    } else {
                        error.insertAfter(element); // for other inputs, just perform default behavior
                    }
                },
                invalidHandler: function(event, validator) { //display error alert on form submit   
                    success.hide();
                    error.show();
                    Metronic.scrollTo(error, -200);
                },
                highlight: function(element) { // hightlight error inputs
                    $(element)
                            .closest('.form-group').removeClass('has-success').addClass('has-error'); // set error class to the control group
                },
                unhighlight: function(element) { // revert the change done by hightlight
                    $(element)
                            .closest('.form-group').removeClass('has-error'); // set error class to the control group
                },
                success: function(label) {
                    if (label.attr("for") == "gender" || label.attr("for") == "confirm") { // for checkboxes and radio buttons, no need to show OK icon
                        label
                                .closest('.form-group').removeClass('has-error').addClass('has-success');
                        label.remove(); // remove error label here
                    } else { // display success icon for other inputs
                        label
                                .addClass('valid') // mark the current input as valid and display OK icon
                                .closest('.form-group').removeClass('has-error').addClass('has-success'); // set success class to the control group
                    }
                },
                submitHandler: function(form) {
                    form.submit();
                    //success.show();
                    error.hide();
                    //add here some ajax code to submit your form or just call form.submit() if you want to submit the form without ajax
                }

            });

            var displayConfirm = function() {
                $('#tab4 .form-control-static', form).each(function() {
                    var input = $('[name="' + $(this).attr("data-display") + '"]', form);
                    if (input.is(":radio")) {
                        input = $('[name="' + $(this).attr("data-display") + '"]:checked', form);
                    }
                    if (input.is(":text") || input.is("textarea")) {
                        $(this).html(input.val());
                    } else if (input.is("select")) {
                        $(this).html(input.find('option:selected').text());
                    } else if (input.is(":radio") && input.is(":checked")) {
                        $(this).html(input.attr("data-title"));
                    }
                });
            }

            var handleTitle = function(tab, navigation, index) {
                var total = navigation.find('li').length;
                var current = index + 1;
                // set wizard title
                $('.step-title', $('#form_wizard_1')).text('Step ' + (index + 1) + ' of ' + total);
                // set done steps
                jQuery('li', $('#form_wizard_1')).removeClass("done");
                var li_list = navigation.find('li');
                for (var i = 0; i < index; i++) {
                    jQuery(li_list[i]).addClass("done");
                }

                if (current == 1) {
                    $('#form_wizard_1').find('.button-previous').hide();
                } else {
                    $('#form_wizard_1').find('.button-previous').show();
                }

                if (current >= total) {
                    $('#form_wizard_1').find('.button-next').hide();
                    $('#form_wizard_1').find('.button-submit').show();
                    displayConfirm();
                } else {
                    $('#form_wizard_1').find('.button-next').show();
                    $('#form_wizard_1').find('.button-submit').hide();
                }
                Metronic.scrollTo($('.page-title'));
            }

            // default form wizard
            $('#form_wizard_1').bootstrapWizard({
                'nextSelector': '.button-next',
                'previousSelector': '.button-previous',
                onTabClick: function(tab, navigation, index, clickedIndex) {
                    return false;
                    /*
                     success.hide();
                     error.hide();
                     if (form.valid() == false) {
                     return false;
                     }
                     handleTitle(tab, navigation, clickedIndex);
                     */
                },
                onNext: function(tab, navigation, index) {
                    success.hide();
                    error.hide();

                    if (form.valid() == false) {
                        return false;
                    }

                    handleTitle(tab, navigation, index);
                },
                onPrevious: function(tab, navigation, index) {
                    success.hide();
                    error.hide();

                    handleTitle(tab, navigation, index);
                },
                onTabShow: function(tab, navigation, index) {
                    var total = navigation.find('li').length;
                    var current = index + 1;
                    var $percent = (current / total) * 100;
                    $('#form_wizard_1').find('.progress-bar').css({
                        width: $percent + '%'
                    });
                }
            });

            $('#form_wizard_1').find('.button-previous').hide();
            $('#form_wizard_1 .button-submit').click(function() {
                document.getElementById("submit_form").submit();
            }).hide();

            //apply validation on select2 dropdown value change, this only needed for chosen dropdown integration.
            $('#country_list', form).change(function() {
                form.validate().element($(this)); //revalidate the chosen dropdown value and show error or success message for the input
            });
        }

    };

}();
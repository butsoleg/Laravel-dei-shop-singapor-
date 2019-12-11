(function($) {
  'use strict';
    $.validator.addMethod("passwordCheck", function(value, element) {
      if(!empty(value)){
        return /^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[#?!@$%^&*-]).{8,}$/.test(value);
      }
    });   
     $.validator.addMethod("contactCheck", function(value, element) {
      if(!empty(value)){
        return  /^\(?([0-9]{3})\)?[-. ]?([0-9]{3})[-. ]?([0-9]{4})$/.test(value);
      }
    });

  $.validator.setDefaults({
    // This will ignore all hidden elements alongside `contenteditable` elements
    // that have no `name` attribute
    ignore: ":hidden, [contenteditable='true']:not([name])"
  });
  $(function() {
    // validate the comment form when it is submitted
    // validate signup form on keyup and submit
    $("#loginform").validate({
        rules: {
            email: {
                required: true,
                email: true
            },   
            password: {
                required: true,
            },
        },
        messages: {

            email: {
            required: "The email field is required",
            email: "Please enter a valid email address",

            }, 
            password: {
            required: "The password field is required",
            },

        },
        errorPlacement: function(label, element) {
            label.addClass('mt-2 text-danger');
            label.insertAfter(element);
        },
        highlight: function(element, errorClass) {
            $(element).parent().addClass('has-danger')
            $(element).addClass('form-control-danger')
        },
        success: function(label,element) {
            label.removeClass('mt-2 text-danger');
            label.remove();
            $(element).parent().removeClass('has-danger');
            $(element).removeClass('form-control-danger')
        },
    });

    $("#addcardform").validate({
        rules: {
            name: {
                required: true
            },   
            number: {
                required: true,
            },   
            expiration_month: {
                required: true,
            },    
            expiration_year: {
                required: true,
            },
        },
        messages: {

            name: {
            required: "The Cardholder's name field is required",
            }, 
            number: {
            required: "The number field is required",
            },

        },
        errorPlacement: function(label, element) {
            label.addClass('mt-2 text-danger');
            label.insertAfter(element);
        },
        highlight: function(element, errorClass) {
            $(element).parent().addClass('has-danger')
            $(element).addClass('form-control-danger')
        },
        success: function(label,element) {
            label.removeClass('mt-2 text-danger');
            label.remove();
            $(element).parent().removeClass('has-danger');
            $(element).removeClass('form-control-danger')
        },
    });
 

 $("#updatepasswordform").validate({
      rules: {
  
     
        password_confirmation: {
          // required: true,
          equalTo: "#change_password"
        },
      },
      messages: {
       
        password_confirmation: {
          required: "Please provide a password",
          minlength: "Your password must be at least 8 characters long",
          equalTo: "Please enter the same password as above"
        },
    
      },
      errorPlacement: function(label, element) {
        label.addClass('mt-2 text-danger');
        label.insertAfter(element);
      },
      highlight: function(element, errorClass) {
        $(element).parent().addClass('has-danger')
        $(element).addClass('form-control-danger')
      },
      success: function(label,element) {
        label.removeClass('mt-2 text-danger');
        label.remove();
        $(element).parent().removeClass('has-danger');
        $(element).removeClass('form-control-danger')
      },
    });


    $('#adminupdateprofile').validate({
      rules: {
        name: {
          required: true,
        },
        email: {
          required: true,
          email: true
        },
        phone: {
          required: true,
          number: true,
          minlength: 10
        },
        country: {
          required: true,
        },
         password: {
          minlength: 8
          // passwordCheck: true
        },
      },
      messages: {
        name: "Please enter your name",
        email: "Please enter a valid email address",
        phone: "Please enter your phone number",
        country: "Please enter your country",
        password: {
          minlength: "Your password must be at least 8 characters long",
          // passwordCheck: "Must contain at least one number and one uppercase and lowercase letter, and at least 8 or more characters with special characters"
        }
      },
      errorPlacement: function(label, element) {
        label.addClass('mt-2 text-danger');
        label.insertAfter(element);
      },
      highlight: function(element, errorClass) {
        $(element).parent().addClass('has-danger')
        $(element).addClass('form-control-danger')
      },
      success: function(label,element) {
        label.removeClass('mt-2 text-danger');
        label.remove();
        $(element).parent().removeClass('has-danger');
        $(element).removeClass('form-control-danger')
      },
    });

    $('#common').validate({
      ignore: ":hidden:not(#summernoteExample,#summernoteExample1),.note-editable.card-block",
      rules: {
        name: {
          required: true,
        },
        website: {
          url: true
        },
        postal_code: {
          required: true,
          minlength: 6
        },
        contact:{
          required: true,
          number: true,
          minlength: 10
        }
      },
      messages: {
        name: "Please enter name",
      },
      errorPlacement: function(label, element) {
        label.addClass('mt-2 text-danger');
        label.insertAfter(element.next());
      },
      highlight: function(element, errorClass) {
        $(element).parent().addClass('has-danger')
        $(element).addClass('form-control-danger')
      },
      success: function(label,element) {
        label.removeClass('mt-2 text-danger');
        label.remove();
        $(element).parent().removeClass('has-danger');
        $(element).removeClass('form-control-danger')
      },
    });
   
     $('#contactus').validate({
        errorElement: 'span',
        rules: {
            contact_name: {
                required: true,
            },
              contact_email: {
                required: true,
                email: true
            },      
            contact_number: {
                required: true,
                // maxlength: 10,
                contactCheck: true
              
            }, 
             topic: {
                required: true,
            },  subject: {
                required: true,
            },   
            message: {
                required: true,
             
            },
          
          
            
        },
        messages: {
          contact_name: "Please enter First name",
          topic: "Please enter topic",
          subject: "Please enter subject",
          message: "Please enter message",
          contact_email: "Please enter a valid email address",
          contact_number: {
               required: "Please enter a phone number",
               // maxlength: "Your phone must be at least 8 characters long",
               contactCheck: "Please enter valid phone number"
          },
         
        },
       errorPlacement: function (error, element) {
            var type = $(element).attr("type");
            if (type === "radio") {
                // custom placement
                error.insertAfter(element).wrap('<li/>');
            } else if (type === "checkbox") {
                // custom placement
                error.insertAfter(element).wrap('<li/>');
            } else {
                error.insertAfter(element).wrap('<div/>');
            }
        },
      highlight: function(element, errorClass) {
        $(element).parent().addClass('has-danger')
        $(element).addClass('form-control-danger')
      },
      success: function(label,element) {
        label.removeClass('mt-2 text-danger');
        label.remove();
        $(element).parent().removeClass('has-danger');
        $(element).removeClass('form-control-danger')
      },
    });

    


  });
})(jQuery);
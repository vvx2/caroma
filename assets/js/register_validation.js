$(function () {

   $("#name_error_message").hide();
   $("#email_error_message").hide();
   $("#password_error_message").hide();
   $("#retype_password_error_message").hide();
   $("#phone_error_message").hide();
   $("#address_error_message").hide();
   $("#zip_error_message").hide();
   $("#city_error_message").hide();
   $("#state_error_message").hide();

   var error_name = false;
   var error_email = false;
   var error_password = false;
   var error_retype_password = false;
   var error_phone = false;
   var error_address = false;
   var error_zip = false;
   var error_city = false;
   var error_state = false;


   $("#name").focusout(function () {
      check_name();
   });
   $("#email").focusout(function () {
      check_email();
   });
   $("#password").focusout(function () {
      check_password();
   });
   $("#c_password").focusout(function () {
      check_retype_password();
   });
   $("#contact").focusout(function () {
      check_phone();
   });
   $("#address").focusout(function () {
      check_address();
   });
   $("#postcode").focusout(function () {
      check_zip();
   });
   $("#city").focusout(function () {
      check_city();
   });
   $("#state").change(function () {
      check_state();
   });

   function check_name() {
      var pattern = /^[a-zA-Z\s]+$/;
      var name = $("#name").val();
      if (pattern.test(name) && name !== '') {
         $("#name_error_message").hide();
         $("#name").css("border-bottom", "2px solid #34F458");
      } else {
         $("#name_error_message").html("Only Characters");
         $("#name_error_message").show();
         $("#name").css("border-bottom", "2px solid #F90A0A");
         error_name = true;
      }
   }


   function check_password() {
      var pattern = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[#$@!%&*?])[A-Za-z\d#$@!%&*?]{8,30}$/;
      var password_length = $("#password").val();
      if (pattern.test(password_length) && password_length !== '') {
         $("#password_error_message").hide();
         $("#password").css("border-bottom", "2px solid #34F458");
      } else {
         $("#password_error_message").html("Atleast 8 Characters & uppercase letter & lowercase letter & special character & number.");
         $("#password_error_message").show();
         $("#password").css("border-bottom", "2px solid #F90A0A");
         error_password = true;
      }
   }

   function check_retype_password() {
      var password = $("#password").val();
      var retype_password = $("#c_password").val();
      if (retype_password == '') {
         var retype_password = false;
         $("#retype_password_error_message").html("Check Your Password");
         $("#retype_password_error_message").show();
         $("#c_password").css("border-bottom", "2px solid #F90A0A");
      }
      else {
         if (password !== retype_password) {
            $("#retype_password_error_message").html("Passwords Did Not Matched");
            $("#retype_password_error_message").show();
            $("#c_password").css("border-bottom", "2px solid #F90A0A");
            error_retype_password = true;
         } else {
            $("#retype_password_error_message").hide();
            $("#c_password").css("border-bottom", "2px solid #34F458");
         }
      }
   }

   function check_email() {
      var pattern = /^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/;
      var email = $("#email").val();
      if (pattern.test(email) && email !== '') {
         $("#email_error_message").hide();
         $("#email").css("border-bottom", "2px solid #34F458");
      } else {
         $("#email_error_message").html("Invalid Email");
         $("#email_error_message").show();
         $("#email").css("border-bottom", "2px solid #F90A0A");
         error_email = true;
      }
   }

   function check_phone() {
      var pattern = /^(\+?6?01)[0|1|2|3|4|6|7|8|9]\-*[0-9]{7,8}$/;
      var phone = $("#contact").val();
      if (pattern.test(phone) && phone !== '') {
         $("#phone_error_message").hide();
         $("#contact").css("border-bottom", "2px solid #34F458");
      } else {
         $("#phone_error_message").html("Kindly Insert A Valid Contact Number As : 012-3456789");
         $("#phone_error_message").show();
         $("#contact").css("border-bottom", "2px solid #F90A0A");
         error_phone = true;
      }
   }

   function check_address() {
      var pattern = /.{8,}/;
      var address = $("#address").val()
      if (pattern.test(address) && address !== '') {
         $("#address_error_message").hide();
         $("#address").css("border-bottom", "2px solid #34F458");
      } else {
         $("#address_error_message").html("Kindly Insert A Valid Address With No Special Characters");
         $("#address_error_message").show();
         $("#address").css("border-bottom", "2px solid #F90A0A");
         error_address = true;
      }
   }

   function check_zip() {
      var pattern = /[0-9]{5}/;
      var zip = $("#postcode").val();
      if (pattern.test(zip) && zip !== '') {
         $("#zip_error_message").hide();
         $("#postcode").css("border-bottom", "2px solid #34F458");
      } else {
         $("#zip_error_message").html("Kindly Insert A Valid Zip Code As : 81100");
         $("#zip_error_message").show();
         $("#postcode").css("border-bottom", "2px solid #F90A0A");
         error_zip = true;
      }
   }

   function check_city() {
      var pattern = /^[a-zA-Z\s]+$/;
      var city = $("#city").val();
      if (pattern.test(city) && city !== '') {
         $("#city_error_message").hide();
         $("#city").css("border-bottom", "2px solid #34F458");
      } else {
         $("#city_error_message").html("Only Characters");
         $("#city_error_message").show();
         $("#city").css("border-bottom", "2px solid #F90A0A");
         error_city = true;
      }
   }

   function check_state() {
      var pattern = /.{1,}/;;
      var state = $('#state option:selected').val();
      // console.log("state value:" + state);
      if (pattern.test(state) && state !== '') {
         $("#state_error_message").hide();
         $("#state").css("border-bottom", "2px solid #34F458");
         $(".error-select").css("border-bottom", "2px solid #34F458");
      } else {
         $("#state_error_message").html("Kindly Select Your State");
         $("#state_error_message").show();
         $("#state").css("border-bottom", "2px solid #F90A0A");
         $(".error-select").css("border-bottom", "2px solid #F90A0A");
         error_state = true;
      }
   }


   $("#form_user").submit(function () {
      error_name = false;
      error_email = false;
      error_password = false;
      error_retype_password = false;
      error_phone = false;
      error_address = false;
      error_zip = false;
      error_city = false;
      error_state = false;

      check_name();
      check_email();
      check_password();
      check_retype_password();
      check_phone();
      check_address();
      check_zip();
      check_city();
      check_state();

      if (error_name === false && error_email === false && error_password === false && error_retype_password === false && error_phone === false && error_address === false && error_zip === false && error_city === false && error_state === false) {
         // alert("Registration Successfull");
         return true;
      } else {
         alert("Please Fill the form Correctly");
         return false;
      }


   });


   $("#form_reset_password").submit(function () {
      error_email = false;

      check_email();

      if (error_email === false) {
         // alert("Registration Successfull");
         return true;
      } else {
         alert("Please Fill the form Correctly");
         return false;
      }


   });

   $("#form_reset_password_api").submit(function () {

      error_password = false;
      error_retype_password = false;

      check_password();
      check_retype_password();

      if (error_password === false && error_retype_password === false) {
         // alert("Registration Successfull");
         return true;
      } else {
         alert("Please Fill the form Correctly");
         return false;
      }


   });
});
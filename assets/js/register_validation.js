$(function () {

   $("#fname_error_message").hide();
   $("#email_error_message").hide();
   $("#password_error_message").hide();
   $("#retype_password_error_message").hide();
   $("#phone_error_message").hide();
   $("#address_error_message").hide();
   $("#zip_error_message").hide();

   var error_fname = false;
   var error_email = false;
   var error_password = false;
   var error_retype_password = false;
   var error_phone = false;
   var error_address = false;
   var error_zip = false;


   $("#form_fname").focusout(function () {
      check_fname();
   });
   $("#form_email").focusout(function () {
      check_email();
   });
   $("#form_password").focusout(function () {
      check_password();
   });
   $("#form_retype_password").focusout(function () {
      check_retype_password();
   });
   $("#form_phone").focusout(function () {
      check_phone();
   });
   $("#form_address").focusout(function () {
      check_address();
   });
   $("#form_zip").focusout(function () {
      check_zip();
   });

   function check_fname() {
      var pattern = /^[a-zA-Z]*$/;
      var fname = $("#form_fname").val();
      if (pattern.test(fname) && fname !== '') {
         $("#fname_error_message").hide();
         $("#form_fname").css("border-bottom", "2px solid #34F458");
      } else {
         $("#fname_error_message").html("Only Characters");
         $("#fname_error_message").show();
         $("#form_fname").css("border-bottom", "2px solid #F90A0A");
         error_fname = true;
      }
   }


   function check_password() {
      var password_length = $("#form_password").val().length;
      if (password_length < 8) {
         $("#password_error_message").html("Atleast 8 Characters");
         $("#password_error_message").show();
         $("#form_password").css("border-bottom", "2px solid #F90A0A");
         error_password = true;
      } else {
         $("#password_error_message").hide();
         $("#form_password").css("border-bottom", "2px solid #34F458");
      }
   }

   function check_retype_password() {
      var password = $("#form_password").val();
      var retype_password = $("#form_retype_password").val();
      if (password !== retype_password) {
         $("#retype_password_error_message").html("Passwords Did Not Matched");
         $("#retype_password_error_message").show();
         $("#form_retype_password").css("border-bottom", "2px solid #F90A0A");
         error_retype_password = true;
      } else {
         $("#retype_password_error_message").hide();
         $("#form_retype_password").css("border-bottom", "2px solid #34F458");
      }
   }

   function check_email() {
      var pattern = /^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/;
      var email = $("#form_email").val();
      if (pattern.test(email) && email !== '') {
         $("#email_error_message").hide();
         $("#form_email").css("border-bottom", "2px solid #34F458");
      } else {
         $("#email_error_message").html("Invalid Email");
         $("#email_error_message").show();
         $("#form_email").css("border-bottom", "2px solid #F90A0A");
         error_email = true;
      }
   }

   function check_phone() {
      var pattern = /^(\+?6?01)[0|1|2|3|4|6|7|8|9]\-*[0-9]{7,8}$/;
      var phone = $("#form_phone").val();
      if (pattern.test(phone) && phone !== '') {
         $("#phone_error_message").hide();
         $("#form_phone").css("border-bottom", "2px solid #34F458");
      } else {
         $("#phone_error_message").html("Kindly Insert A Valid Contact Number As : 012-3456789");
         $("#phone_error_message").show();
         $("#form_phone").css("border-bottom", "2px solid #F90A0A");
         error_phone = true;
      }
   }

   function check_address() {
      var pattern = /.{8,}/;
      var address = $("#form_address").val()
      if (pattern.test(address) && address !== '') {
         $("#address_error_message").hide();
         $("#form_address").css("border-bottom", "2px solid #34F458");
      } else {
         $("#address_error_message").html("Kindly Insert A Valid Address With No Special Characters");
         $("#address_error_message").show();
         $("#form_address").css("border-bottom", "2px solid #F90A0A");
         error_address = true;
      }
   }

   function check_zip() {
      var pattern = /[0-9]{5}/;
      var zip = $("#form_zip").val();
      if (pattern.test(zip) && zip !== '') {
         $("#zip_error_message").hide();
         $("#form_zip").css("border-bottom", "2px solid #34F458");
      } else {
         $("#zip_error_message").html("Kindly Insert A Valid Zip Code As : 81100");
         $("#zip_error_message").show();
         $("#form_zip").css("border-bottom", "2px solid #F90A0A");
         error_zip = true;
      }
   }


   $("#registration_form").submit(function () {
      error_fname = false;
      error_email = false;
      error_password = false;
      error_retype_password = false;
      error_phone = false;
      error_address = false;
      error_zip = false;

      check_fname();
      check_email();
      check_password();
      check_retype_password();
      check_phone();
      check_address();
      check_zip();

      if (error_fname === false && error_email === false && error_password === false && error_retype_password === false && error_phone === false && error_address === false && error_zip === false) {
         alert("Registration Successfull");
         return true;
      } else {
         alert("Please Fill the form Correctly");
         return false;
      }


   });
});
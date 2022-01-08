// JavaScript Document

//Wizard Init
//FOR WIZARD AND VALIDATIONS

$(document).ready(function () {
	'use strict';

	//defining form
	var form = $("#example-form").show();


	form.validate({
		ignore: ".ignore",
		focusInvalid: true,

		errorPlacement: function errorPlacement(error, element) {
			return false
		},

		//error message block
		showErrors: function (errorMap, errorList) {
			$("#wizard").find("input").each(function () {
				$(this).removeClass("error");
			});
			$(".errorblock").html("");
			if (errorList.length) {
				$(".errorblock").html(errorList[0]['message']);
				$(errorList[0]['element']).addClass("error");
			}
		},

		//rules for validation
		rules: {
			confirm: {
				equalTo: "#password"
			},
			pay: {
				required: true,
			},
			payp: {
				required: '#customRadio2[value="Paypal"]:checked',
			},
			qrcode: {
				required: '#customRadio3[value="Google-Pay"]:checked',
			},
			tnc: {
				required: true,
			},

		},

		//message for validation
		messages: {
			"fname": {
				required: "Nombre obligatorio."
			},
			"lname": {
				required: "Apellido obligatorio."
			},
			"pnumber": {
				required: "Número de teléfono obligatorio.",
			},
			"email": {
				required: "Email obligatorio.",
				email: "Email no válido."
			},
			"category": {
				required: "Selecciona evento.",
			},
			"service": {
				required: "Selecciona número de entradas.",
			},
			"consultant": {
				required: "Select consultant."
			},
			"dp": {
				required: "Select dates."
			},
			"pay": {
				required: "Select atleast one mode of payment."
			},
			"payp": {
				required: "Paypal address is required.",
				email: "Please enter a valid email ID."
			},
			"qrcode": {
				required: "Send us your transaction ID."
			},
			"tnc": {
				required: "Acepta los términos y condiciones."
			},
		},


	});

	//wizard steps
	form.children("div").steps({
		headerTag: "h3",
		bodyTag: "section",
		transitionEffect: "none",
		titleTemplate: '#title#',

		//labels
		labels: {
			finish: "Reservar",
			next: "Siguiente",
			previous: "Atrás",
		},

		//while changing step
		onStepChanging: function (event, currentIndex, newIndex) {

			// Allways allow previous action even if the current form is not valid!
			if (currentIndex > newIndex) {
				return true;
			}

			form.validate().settings.ignore = ":disabled,:hidden";
			return form.valid();
		},

		//while finishing
		onFinishing: function (event, currentIndex) {
			return form.valid();
		},

		//when finished
		onFinished: function (event, currentIndex) {
	
		
		

			$("#example-form").on("submit", function (e) {
				//send data through ajax
				e.preventDefault();
				return false;
			});

			//Ajax Example
			var field1 = $('#fname').val();		//take values from firstname input
			var field2 = $('#lname').val();
			var field3 = $('#pnumber').val();
			var field4 = $('#email').val();
			var field5 = $('#category').val();
			var field6 = $('#service').val();
			var field7 = $('#consultant').val();
			var field8 = $('#dp').val();
			var field9 = $('#message1').val();
			var field12 = $('input[name="pay"]:checked').val();
			var field10 = $('#payp').val();
			var field11 = $('#qrcode').val();
			
			
			function getCookie(name) {

      var cookieValue = null;
      if (document.cookie && document.cookie != '') {
          var cookies = document.cookie.split(';');
          for (var i = 0; i < cookies.length; i++) {
              var cookie = jQuery.trim(cookies[i]);
              if (cookie.substring(0, name.length + 1) == (name + '=')) {
              cookieValue = decodeURIComponent(cookie.substring(name.length + 1));
                  break;
              }
          }
      }
      //RETORNANDO EL TOKEN
      return cookieValue;

    }//end function getCookie
			
	
		
				 var csrftoken = getCookie('csrftoken');
			$.ajax({
				//Google form url : check documentation
				url: "https://docs.google.com/forms/d/e/1FAIpQLSdBEQWgu_9R5zVduxk3VSx3DNabUfljcIRIYDL5xRC4xEFM_g/formResponse?",
				data: {
					//for getting entry.number : check documentation
					"entry.775571601": field1,		//take values from field1 and send it to entry.760639197
					"entry.897696818": field2,
					"entry.2000097269": field4,
					"entry.56053993": field3,
					"entry.2090780411": field5,
					"entry.204924916": field6,
				},
				type: "POST",
				dataType: "xml",
				success: function (data) {},

			});
			
			var NiceRandomNumber = Math.random().toString(36).substr(2, 9);
			$.ajax({
   type: "POST",
   url: "wassender",
   data: {  
   csrfmiddlewaretoken : csrftoken,
   nombre: field1,
   ticket: NiceRandomNumber,
   	apellido: field2,
   	email: field4,
   	numero: field3,
   	evento: field5,
   	entradas: field6
     },
   success: function callback(response){
               console.log(response);
            }
});

			
			
			
			
			//On submit
			alert("!Mira tu WhatsApp!");
			$('#example-form')[0].reset();
			$("#wizard").steps('reset');
		}

	});


})

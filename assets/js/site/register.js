(function($, PATH, Helpers){

	// var masks = function () {
	// 	Helpers.phoneMask($('#phone'));
    // }

	var revealpass = function(){
		$('body').on('click','.reveal-pass',function(){
			var icon = $(this).children('i');
			
			if(icon.hasClass('fa-eye')){
				icon.addClass('fa-eye-slash');
				icon.removeClass('fa-eye');

				$('#password').prop('type','text');
			}else{
				icon.removeClass('fa-eye-slash');
				icon.addClass('fa-eye');
				$('#password').prop('type','password');

			}
		})
	}

	var checkcombine = function(){
		$('body').on('keyup','#repassword',function(){
			
			let icon = $(this).parent().children('.input-inline-append').children('.combine-result').children('i')
			let value = $('#repassword').val();
			let valuecheck = $('#password').val();
			if(value == valuecheck){
				icon.addClass('fa-circle-check');
				icon.removeClass('fa-circle-xmark');
			}else{
				icon.removeClass('fa-circle-check');
				icon.addClass('fa-circle-xmark');
			}
		})

		$('body').on('keyup','#password',function(){
			
			let icon = $('#repassword').parent().children('.input-inline-append').children('.combine-result').children('i')
			let value = $('#repassword').val();
			let valuecheck = $('#password').val();
			if(value == valuecheck){
				icon.addClass('fa-circle-check');
				icon.removeClass('fa-circle-xmark');
			}else{
				icon.removeClass('fa-circle-check');
				icon.addClass('fa-circle-xmark');
			}
		})
	}

	var register = function(){
		$('body').on('click', '#save', function(){
			$('#loader-overlay').fadeIn(500, async function(){
				if(await checkCamps()){
					let formObj = $("form[name='register']");
					let formURL = formObj.attr("action");
                    let formData = new FormData($("form[name='register']")[0]);

					$.ajax({
						url: PATH + '/registerUser',
						dataType: 'JSON',
						type: 'POST',
						contentType: 'multipart/form-data',
						contentType: false,
						cache: false,
						processData: false,
						async: false,
						data: formData,
						complete: function(res){
							$('#loader-overlay').fadeOut();
							if (res.responseJSON.result) {
                                swal({
                                    type: 'success',
                                    title: 'Cadastrado com sucesso!',
                                    text: 'Sua conta foi cadastrada com sucesso',
                                    confirmButtonColor: '#F15D40',
                                    confirmButtonText: 'Continuar',
                                }).then(function(){
                                    window.location.href = PATH + '/';
                                });
							
							}else{
								swal({
									type: 'warning',
									title: 'Ops!',
									text: 'Ocorreu algum erro inesperado. Tente novamente mais tarde.',
									confirmButtonColor: '#F15D40',
									confirmButtonText: 'Continuar',
								})

								return false
							
							}
						}
					})
				}
			})
		})
	}

	var checkCamps = async function(){
		let name 		= $('#name').val();
		let email		= $('#email').val();
        let password	= $('#password').val();
        let repassword	= $('#repassword').val();

		if (name.trim() == "") {		
			$('#name').focus();

			swal({
				type: 'warning',
				title: 'Cadastro de usuario',
				text: 'Insira um nome para sua conta.',
                confirmButtonColor: "#F15D40",
                confirmButtonText: "Continuar",
			});
			$('#loader-overlay').fadeOut();
			return false
		}
		

		if (email.trim() == ""){
			$('#email').focus();
			swal({
				type: 'warning',
				title: 'Cadastro de usuario',
				text: 'Insira um email',
				confirmButtonColor: "#F15D40",
				confirmButtonText: "Continuar",
			});
			$('#loader-overlay').fadeOut();
			return false
		}
	
        if (password.trim() == "") {		
            $('#password').focus();	
            swal({
                type: 'warning',
                title: 'Cadastro de usuario',
                text: 'Insira uma senha',
                confirmButtonColor: "#F15D40",
                confirmButtonText: "Continuar",
            });
            $('#loader-overlay').fadeOut();
            return false
        }
        if (repassword.trim() == "") {	
            $('#repassword').focus();		
            swal({
                type: 'warning',
                title: 'Cadastro de usuario',
                text: 'Confirme a senha que foi digitada',
                confirmButtonColor: "#F15D40",
                confirmButtonText: "Continuar",
            });
            $('#loader-overlay').fadeOut();
            return false
        }
        if (repassword != password) {		
            $('#repassword').focus();	
            swal({
                type: 'warning',
                title: 'Cadastro de usuario',
                text: 'As senhas devem ser iguais!',
                confirmButtonColor: "#F15D40",
                confirmButtonText: "Continuar",
            });
            $('#loader-overlay').fadeOut();
            return false
        }

        if (checkEmail(email)) {

            swal({
                type: 'error',
                title: 'Erro - Login',
                text: 'Email ja cadastrado',
            });
			$('#loader-overlay').fadeOut();
            return false;

        }
	
		return true;
	}

	// var checkEmail = function (email){
	// 	return $.ajax({
	// 		url: PATH + '/checkEmail',
	// 		type: 'POST',
	// 		data :{
	// 			email: email
	// 		},
	// 		dataType: 'JSON',
	// 	});
	// }
       // Verificando o email do usuario
    var checkEmail = (email) => {

        var checkUser;

        $.ajax({
            url: PATH + '/checkEmail',
            dataType: 'json',
            type: 'POST',
            async: false,
            data: {
                email: email,
            },
            complete: function (response) {
                checkUser = response.responseJSON.result;
            }
        });

        return checkUser;

    }

	// var checkPhone = function (phone){
	// 	return $.ajax({
	// 		url: PATH + '/checkPhone',
	// 		type: 'POST',
	// 		data :{
	// 			phone: phone
	// 		},
	// 		dataType: 'JSON',
	// 	});
	// }

	

	$(document).ready(function() {
		revealpass();
        checkcombine();
		register();
		$('#course').selectpicker();
	});

})($, PATH, Helpers);
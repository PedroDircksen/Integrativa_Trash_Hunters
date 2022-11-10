/**
 *
 * Script do login de admin
 *
 * @author Emprezaz
 *
 **/
(function ($, PATH, Helpers) {


    // Verificando o nome de usuário
    var checkName = (name) => {
        var checkLogin;

        $.ajax({
            url: PATH + '/checkName',
            dataType: 'json',
            type: 'POST',
            async: false,
            data: {
                name: name,
            },
            complete: function (response) {
                checkLogin = response.responseJSON.result;
            }
        });

        return checkLogin;

    }

    // // Verificando a senha
    // var checkLogin = (name, password) => {

    //     var checkPassword;

    //     $.ajax({
    //         url: PATH + '/checkLogin',
    //         dataType: 'json',
    //         type: 'POST',
    //         async: false,
    //         data: {
    //             name: name,
    //             password: password,
    //         },
    //         complete: function (response) {

    //             checkPassword = response.responseJSON.result;

    //         }
    //     });

    //     return checkPassword;

    // }

 

    // Validação dos campos
    var validateFields = () => {

        var name = $('#name').val();
        var password = $('#password').val();

        if (login == '') {

            swal({
                type: 'error',
                title: 'Erro - Login',
                text: 'Preencha o nome de usuario',
            });
            return false;

        }

        if (password == '') {

            swal({
                type: 'error',
                title: 'Erro - Login',
                text: 'Preencha sua senha'
            });
            return false;

        }

        if (!checkName(name)) {

            swal({
                type: 'error',
                title: 'Erro - Login',
                text: 'Usuario nao cadastrado',
            });
            return false;

        }

        return true;

    }

    // Função parar executar o login
    var login = () => {

        var name = $('input[name="name"]').val();
        var password = $('#password').val();

        // $('#loader-overlay').fadeIn();

        if (validateFields()) {
            $.ajax({
				url: PATH + '/loginUser',
				data: { 
					name 	 : name.trim(),
					password : password
				},
				type: 'POST',
				dataType: 'JSON',
				async: false,
			}).done(function(res){
				$('#loader-overlay').fadeOut();

				if (res.result == true) {
					
					if(res.url){
						window.location.href = PATH + res.url;
					}else{
						// window.location.href = PATH + '/meu-perfil';
						window.location.href = PATH + '/';
					}
					return true;

				}else if(res.result == false){
					swal({
						type: 'error',
						title: 'Login de usuário',
						text: 'Email ou senha incorretos.',
						confirmButtonColor: '#21cecd',
						confirmButtonText: 'Ok',
					}).then(function(){
						return false;
					})	
				}
				else{	
					swal({
						type: 'error',
						title: 'Login de usuário',
						text: 'Ocorreu um erro inesperado. Tente novamente mais tarde.',
						confirmButtonColor: '#21cecd',
						confirmButtonText: 'Continuar',
					}).then(function(){
						return false;
					})	
				}
			})

        }

    }


    var revealpass = function () {
        $('body').on('click', '.reveal-pass', function () {
            var icon = $(this).children('i');

            if (icon.hasClass('fa-eye')) {
                icon.addClass('fa-eye-slash');
                icon.removeClass('fa-eye');

                $('#password').prop('type', 'text');
            } else {
                icon.removeClass('fa-eye-slash');
                icon.addClass('fa-eye');
                $('#password').prop('type', 'password');

            }
        })
    }

    $(document).on('keydown', function (event) {
        if (event.keyCode === 13) {
            event.preventDefault();
            login();
        }
    });
    $('body').on('click', '.btn-login', function () {
        login();
    })
    $(document).ready(function () {
        revealpass();
    });

})($, PATH, Helpers);
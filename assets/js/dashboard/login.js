/**
 *
 * Script do login de admin
 *
 * @author Emprezaz
 *
 **/
 (function ($, PATH, Helpers) {

    // Verificando a senha
    var checkPasswordInDatabase = (login, password) => {

        var checkPassword;

        $.ajax({
            url: PATH + '/checkPasswordAdm',
            dataType: 'json',
            type: 'POST',
            async: false,
            data: {
                login: login,
                password: password,
            },
            complete: function (response) {

                checkPassword = response.responseJSON.result;

            }
        });

        return checkPassword;

    }

    // Verificando o nome de usuário
    var checkLoginInDatabase = (login) => {

        var checkLogin;

        $.ajax({
            url: PATH + '/checkLoginAdm',
            dataType: 'json',
            type: 'POST',
            async: false,
            data: {
                login: login,
            },
            complete: function (response) {
                checkLogin = response.responseJSON.result;
            }
        });

        return checkLogin;

    }
    // Verificando o email do usuário
    var checkEmailInDatabase = (email) => {

        var checkUser;

        $.ajax({
            url: PATH + '/checkEmailAdm',
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

    // Validação dos campos
    var validateFields = () => {

        var login = $('input[name="username"]').val();
        var password = $('input[name="password"]').val();

        if (login == '') {

            swal({
                type: 'error',
                title: 'Erro - Login',
                text: 'Preencha o nome de usuário',
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

        if (!checkLoginInDatabase(login)) {

            swal({
                type: 'error',
                title: 'Erro - Login',
                text: 'Usuário não cadastrado',
            });
            return false;

        }

        if (!checkPasswordInDatabase(login, password)) {

            swal({
                type: 'error',
                title: 'Erro - Login',
                text: 'Senha incorreta',
            });
            return false;

        }

        return true;

    }

    // Função parar executar o login
    var login = () => {

        var login = $('input[name="username"]').val();
        $('#loader-overlay').fadeIn();

        if (validateFields()) {
            $.ajax({
                url: PATH + '/saveLogin',
                type: 'POST',
                dataType: 'json',
                data: {
                    login: login,
                },
                complete: function (response) {
                    $('#loader-overlay').fadeOut()

                    if (response.responseJSON.result) {
                        window.location.href = PATH + '/dashboard';
                        return true;
                    } else {

                        swal({
                            type: 'error',
                            title: 'Erro - Login',
                            text: 'Algo deu errado, tente novamente mais tarde.'
                        }).then(function () {
                            window.location.reload();
                            return false;
                        });

                    }

                }
            });

        }

    }

    var recover = () => {

        $('body').on('click', '#recover-email', function () {
            Swal.fire({
                title: 'Digite seu e-mail para enviar link de recuperação',
                html: '<input name="emailRecover" type="email" class="form-control">',
                showCancelButton: true,
                cancelButtonText: "Fechar",
                confirmButtonText: "Confirmar email",
            }).then(result => {
                $('#loader-overlay').fadeIn();

                var email = $('input[name="emailRecover"]').val();
                if (result.value) {

                    if (checkEmailInDatabase(email)) {

                        $.ajax({
                            url: PATH + "/admin/sendRecover",
                            type: 'POST',
                            dataType: 'JSON',
                            data: {
                                email: email
                            },
                            complete: function (response) {
                                $('#loader-overlay').fadeOut()

                                if (response.responseJSON.result) {

                                    swal({
                                        type: 'success',
                                        title: 'Recuperar de Senha',
                                        text: 'O link de recuperação foi enviado para o seu email.',
                                    }).then(function () {
                                        window.location.reload();
                                        return true;
                                    });

                                } else {

                                    swal({
                                        type: 'error',
                                        title: 'Erro - Login',
                                        text: 'Algo deu errado, tente novamente mais tarde.'
                                    }).then(function () {
                                        window.location.reload();
                                        return false;
                                    });

                                }

                            }
                        })

                    } else {
                        $('#loader-overlay').fadeOut()
                        Swal.fire({
                            type: 'error',
                            title: 'Recuperar de Senha',
                            text: 'O usuário não foi encontrado'
                        }).then(function () {
                            window.location.reload();
                            return false;
                        });
                    }
                }
            });


        })

    }

    var revealpass = function(){
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

    $(document).on('keydown', function(event) {
        if(event.keyCode === 13) {
           event.preventDefault();
           login();
        }
    });
    $('body').on('click', '.btn-login', function(){
        login();
    })
    $(document).ready(function () {
        recover();
        revealpass();
    });

})($, PATH, Helpers);
/**
*
* Script do login de admin
*
* @author Emprezaz
*
**/
(function($, PATH, Helpers){

	var check = function () {
		newPass = $('input[name="newPassword"]').val()
		newPassConfirm = $('input[name="newPasswordConfirm"]').val()

        if (newPass == "") {
            swal({
                type: "error",
                title: "Recuperação de Senha",
                text: "Insira a nova senha"
            })
            return false;
        }
        if (newPassConfirm == "") {
            swal({
                type: "error",
                title: "Recuperação de Senha",
                text: "Insira a confirmação da nova senha"
            })
            return false;
        }

		if(newPass != newPassConfirm){
			swal({
				type: "error",
				title: "Recuperação de Senha",
				text: "As senhas devem se coincidir"
			})
			return false;
		}

        return true
	}

	const submitRecover = () => {
        $('body').on('click', '#btn-recover', function(){     
			if (check()) {
                $('#loader-overlay').fadeIn();

				password = $('input[name="newPassword"]').val();
				id =$('input[name="newPassword"]').attr('data-id')

				$.ajax({
					url: PATH + '/recoverPasswordAdmin',
					type: 'POST',
					dataType: 'JSON',
					data: {id:id,password:password},
				}).then(function(response) {
					$('#loader-overlay').fadeOut()

					if(response.error) {
						swal({
							type: 'error',
							title: 'Falha ao alterar senha, verifique os caracteres digitados.',
							text: response.error,
						});
					}else{
						swal({
							type: 'success',
							title: 'Senha alterada com sucesso!',
							onClose() {
								window.location.href = PATH + '/dashboard/login';
								return true;
							}
						});
					}
				})
			}

		});
	}

    $(document).ready(function() {
        submitRecover();
	});

})($, PATH, Helpers);
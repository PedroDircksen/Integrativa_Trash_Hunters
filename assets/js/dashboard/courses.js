/**
 *
 * Script de perfil
 *
 * @author Emprezaz
 *
 **/
 (function($, PATH, Helpers){
    const mask = function () {
        Helpers.searchTable();
    }

    var registerCourse = function(){
        $('body').on('click', '.register-course', function(){
            $idCourse = $(this).attr('data-id');
            $nameCourse = $(this).attr('data-name');
            swal({
                text: 'Qual o nome do curso?',
                type: 'question',
                showCancelButton: true,
                input: 'text',
                inputPlaceholder: 'Digite aqui',
                inputValue: $nameCourse,
                confirmButtonColor: '#8fbd63',
                // cancelButtonColor: '#e74b3e',
                confirmButtonText: 'Cadastrar',
                cancelButtonText: 'Cancelar',
            }).then( (result) => {
                if (result.value) {
                    $.ajax({
                        url: PATH + '/saveCourse',
                        type: 'POST',
                        dataType: 'json',
                        data: {
                            id: $idCourse,
                            name: result.value,
                        },
                        async:false,
                        complete: function(response){
                            $('#loader-overlay').fadeOut()
    
                            if(response.responseJSON.result){
    
                                swal({
                                    text: 'Família cadastrada com sucesso',
                                    type: 'success',
                                    confirmButtonColor: '#7fcdcb',
                                }).then(function(){
                                    window.location.reload();
                                    return true;
                                });
                            } else{
                                swal({
                                    text: 'Um erro inesperado aconteceu. Tente novamente mais tarde.',
                                    type: 'error',
                                    confirmButtonColor: '#7fcdcb',
                                }).then(function(){
                                    window.location.reload();
                                    return true;
                                });
    
                            }
    
                        }
                    });
                }else{
                    $('#loader-overlay').fadeOut()
                }
                $('#loader-overlay').fadeOut()
            })
            $('#loader-overlay').fadeOut()
        })
    }

    var deleteCourse = function(){
        $('body').on('click', '.delete-course', function(){
            var idCourse = $(this).attr('data-id');
            console.log(idCourse)
            var trCourse = $(this).parents('tr');
            swal({
                type: 'question',
                text: 'Deseja mesmo deletar este curso?',
                showCancelButton: true,
                confirmButtonColor: '#8fbd63',
                // cancelButtonColor: '#e74b3e',
                confirmButtonText: 'Deletar',
                cancelButtonText: 'Cancelar',
            }).then( (result) => {
                if (result.value) {
                    $('#loader-overlay').fadeIn(async function(){
                        $.ajax({
                            url: PATH + '/deleteCourse',
                            type: 'POST',
                            dataType: 'json',
                            data: {
                                id: idCourse,
                            },                    
                            complete: function(res){
                                $('#loader-overlay').fadeOut();
                                if (res.responseJSON.result) {
                                    swal({
                                        type: 'success',
                                        title: 'Curso deletado!',
                                        confirmButtonColor: '#F15D40',
                                        confirmButtonText: 'Continuar',
                                    }).then(function(){
                                        trCourse.remove();
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
                    })
                }
            })

        })
    }  
    var addPoints = function(){
        $('body').on('click', '.add-points', function(){
            var courseId = $(this).attr('data-id');
            var courseScore = $(this).attr('data-score');
            var courseTd = $(this).parents().find('.score');
            swal({
                text: 'Quantos pontos deseja acrescenter?',
                type: 'question',
                showCancelButton: true,
                input: 'text',
                inputPlaceholder: 'Digite aqui',
                confirmButtonColor: '#8fbd63',
                // cancelButtonColor: '#e74b3e',
                confirmButtonText: 'Adicionar',
                cancelButtonText: 'Cancelar',
            }).then( (result) => {
                $('#loader-overlay').fadeIn()
                if (result.value) {
                    var points = result.value;
                    $.ajax({
                        url: PATH + '/addPoints',
                        type: 'POST',
                        dataType: 'json',
                        data: {
                            id: courseId,
                            points: result.value,
                        },
                        async:false,
                        complete: function(response){
                            $('#loader-overlay').fadeOut()
    
                            if(response.responseJSON.result){
    
                                swal({
                                    text: 'Pontos adicionados com sucesso',
                                    type: 'success',
                                    confirmButtonColor: '#7fcdcb',
                                }).then(function(){
                                    courseTd.html(parseInt(courseScore) + parseInt(points));
                                    return true;
                                });
                            } else{
                                swal({
                                    text: 'Um erro inesperado aconteceu. Tente novamente mais tarde.',
                                    type: 'error',
                                    confirmButtonColor: '#7fcdcb',
                                }).then(function(){
                                    return true;
                                });
    
                            }
    
                        }
                    });
                }else{
                    $('#loader-overlay').fadeOut()
                }
                $('#loader-overlay').fadeOut()
            })
            $('#loader-overlay').fadeOut()
        })
    }

    var passLevel = function(){
        $('body').on('click', '.pass-level', function(){
            var courseId = $(this).attr('data-id');
            var courseLevel = $(this).attr('data-level');
            var courseTd = $(this).parents().find('.level');
            $('#loader-overlay').fadeIn()
            $.ajax({
                url: PATH + '/passLevel',
                type: 'POST',
                dataType: 'json',
                data: {
                    id: courseId,
                },
                async:false,
                complete: function(response){
                    $('#loader-overlay').fadeOut()
                    if(response.responseJSON.result){

                        swal({
                            text: 'O curso passou de fase',
                            type: 'success',
                            confirmButtonColor: '#7fcdcb',
                        }).then(function(){
                            courseTd.html(parseInt(courseLevel) + 1);
                            return true;
                        });
                    } else{
                        swal({
                            text: 'Um erro inesperado aconteceu. Tente novamente mais tarde.',
                            type: 'error',
                            confirmButtonColor: '#7fcdcb',
                        }).then(function(){
                            return true;
                        });

                    }

                }
            });
     
            $('#loader-overlay').fadeOut()
        })
    }

   $(document).ready(function() {
        mask();
        registerCourse();
        deleteCourse();
        addPoints();
        passLevel();
   });

})($, PATH, Helpers);
<section class="courses dashboard-page" id="courses-content">
    <div class="row title">
        <div class="col-md-8 p-0">
            <h3 class="font-bold dashboard-title">Cursos</h3>
        </div>
        <div class="col-md-4 align-self-end">
            <a class="btn btn-green btn-animation register-course">
                + Novo Curso
            </a>
        </div>
    </div>
    <div class="row search-box">
        <h4>Pesquisa</h4>
        <input type="text" name="search" id="search" class="form-control mb-3" placeholder="Digite para pesquisar" />
    </div>
    <div class="table-content">
        <div class="table-responsive">
            <table class="table table-striped" id="table-courses">
                <thead>
                    <tr>
                        <th scope="col" class="text-center left-radius">Id</th>
                        <th scope="col" class="text-center">Nome do curso</th>
                        <th scope="col" class="text-center">Pontuação</th>
                        <th scope="col" class="text-center">Fase</th>
                        <th scope="col" class="text-center"></th>
                        <th scope="col" class="text-center right-radius"></th>

                    </tr>
                </thead>
                <tbody>

                    <?php foreach($courses as $key => $course) { ?>
                        
                        <tr>
                            <th scope="row" class="text-center"><?=$course['id']?></th>
                            <td class="text-center"><?=$course['name']?></td>
                            <td class="text-center score"><?=$course['score']?></td>
                            <td class="text-center level"><?=$course['level']?></td>
                            <td class="text-center">
                                <a class="btn btn-gray add-points" data-score="<?=$course['score']?>" data-id="<?=$course['id']?>">Adicionar pontos
                                    <img src="<?= $url; ?>/assets/img/icons/edit.svg" alt="">
                                </a>
                                <a class="btn btn-gray pass-level" data-level="<?=$course['level']?>" data-id="<?=$course['id']?>">Passar de fase
                                </a>
                            </td>
                            <td class="text-center" style="min-width: 200px;">
                                <a class="btn btn-gray register-course" data-id="<?=$course['id']?>" data-name="<?=$course['name']?>">Editar
                                </a>
                                <a class="btn btn-gray delete-course" data-id="<?=$course['id']?>">Deletar
                                </a>
                            </td>

                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>

</section>
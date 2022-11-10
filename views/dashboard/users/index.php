<section class="users dashboard-page" id="users-content">
    <div class="row title">
        <div class="col-md-8 p-0">
            <h3 class="font-bold dashboard-title">Usuários</h3>
        </div>
    </div>
    <div class="row search-box">
        <h4>Pesquisa</h4>
        <input type="text" name="search" id="search" class="form-control mb-3" placeholder="Digite para pesquisar" />
    </div>
    <div class="table-content">
        <div class="table-responsive">
            <table class="table table-striped" id="table-users">
                <thead>
                    <tr>
                        <th scope="col" class="text-center left-radius">Id</th>
                        <th scope="col" class="text-center">Nome do usuário</th>
                        <th scope="col" class="text-center">Email do usuário</th>
                        <th scope="col" class="text-center">Pontuação</th>
                        <th scope="col" class="text-center">Curso do usuário</th>
                        <th scope="col" class="text-center right-radius"></th>

                    </tr>
                </thead>
                <tbody>

                    <?php foreach($users as $key => $user) { 
                        $courseName = "";
                        foreach($courses as $keyCourse => $course){
                            if( $user['courses_id'] == $course['id']){
                                $courseName = $course['name'];
                            }
                        }
                    ?>
                        
                        <tr>
                            <th scope="row" class="text-center"><?=$user['id']?></th>
                            <td class="text-center"><?=$user['name']?></td>
                            <td class="text-center"><?=$user['email']?></td>
                            <td class="text-center" ><?=$user['score']?></td>
                            <td class="text-center"><?=$courseName?></td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>

</section>
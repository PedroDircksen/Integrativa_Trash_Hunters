<div class="container">
    <center>
        <div class="login">
            <header class="text-center user-select-none">
                <img src="<?php echo $url; ?>/assets/img/logo.png" alt="">
            </header>
            <h3 class="text-center">Cadastro de usuario</h3>
            <form id="register" name="register">
                <div class="form-group">
                    <label class="text-left w-100">Nome de Usuario</label>
                    <input class="form-control" name="name" type="text" id="name"/>
                </div>
                <div class="form-group">
                    <label class="text-left w-100">Email</label>
                    <input class="form-control" name="email" type="text" id="email"/>
                </div>
                <div class="form-group">
                    <label class="text-left w-100">Curso</label>
                    <select class="form-control" name="course" id="course"  data-live-search="true">
                        <option value="" selected disabled>Selecione o seu curso</option>
                        <?php foreach($courses as $key => $course){?>
                            <option value="<?=$course['id']?>"><?=$course['name']?></option>
                        <?php }?>
                    </select>
                </div>
                <div class="form-group pass">
                    <label class="text-left w-100" for="password">Senha</label>
                    <input class="form-control" name="password" id="password" type="password" />
                    <div class="reveal-pass">
                        <i class="fa-solid fa-eye"></i>
                    </div>
                </div>
                <div class="form-group">
                    <label class="text-left w-100" for="repassword">Confirme a senha</label>
                        <div class="pass">
                        <input class="form-control" id="repassword" type="password">
                        <div class="input-inline-append text-left">
                            <div class="combine-result">
                                <i class="fa-solid fa-circle-xmark blue-light"></i>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="text-left user-select-none">
                    <div id="login-invited">Ja possui login? 
                        <a href="<?=$url?>/entrar">Entrar</a></div>
                </div>

                <a class="btn btn-green mt-5" id="save">Cadastrar</a>

            </form>
        </div>
    </center>
</div>

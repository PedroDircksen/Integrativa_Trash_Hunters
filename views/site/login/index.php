<div class="container">
    <center>
        <div class="login">
            <header class="text-center">
                <img src="<?php echo $url; ?>/assets/img/logo.png" alt="">
            </header>
            <form id="login">
            <h3>Faca seu Login</h3>

                <div class="form-group">
                    <label class="text-left w-100">Nome de Usuario</label>
                    <input class="form-control" name="name" type="text" id="name"/>
                </div>
                <div class="form-group pass">
                    <label class="text-left w-100">Senha</label>
                    <input class="form-control" name="password" id="password" type="password" />
                    <div class="reveal-pass">
                        <i class="fa-solid fa-eye"></i>
                    </div>
                </div>
                <div class="text-left user-select-none">
                    <div id="login-invited">Nao possui login? 
                        <a href="<?=$url?>/cadastrar">Cadastre-se</a></div>
                </div>

                <div class="btn btn-green btn-login mt-5">Entrar <img src="<?=$url?>/assets/img/icons/arrow-right.svg" alt=""></div>

            </form>
        </div>
    </center>
</div>

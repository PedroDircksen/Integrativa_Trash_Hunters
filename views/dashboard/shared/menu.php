<aside class="col-lg-3 col-md-4 sidebar">
    <div class="header-menu">

        <div class="dropdown">
            <button class="btn dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <i class="fas fa-user-circle"></i>
            </button>
            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                <a class="dropdown-item" href="<?php echo $url ?>/logoutAdmin">
                    <i class="fas fa-walking"></i>
                    Sair
                </a>
            </div>
        </div>

    </div>

    <div class="sidebar-links">
        <ul>
            <li>
                <a href="<?php echo $url; ?>/" class="<?php echo (end($params) == 'dashboard') ? 'active' : ''; ?>">
                    <i class="fa-solid fa-home"></i>
                    Home
                </a>
            </li>
            <li>
                <a href="<?=$url;?>/dashboard/courses" class="<?= (in_array('courses', $params)) ? 'active' : '';?>">
                    <i class="fa-solid fa-person-chalkboard"></i>                    
                    Cursos
                </a>
            </li>
            <li>
                <a href="<?=$url?>/dashboard/users" class="<?= (in_array('users', $params)) ? 'active' : '';?>">
                    <i class="fa-solid fa-user"></i>
                    Usuários
                </a>
            </li>
        </ul>
    </div>
</aside>
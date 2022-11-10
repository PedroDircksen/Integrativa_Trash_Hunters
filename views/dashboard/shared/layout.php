<?php
$url      = $this->helpers['URLHelper']->getURL();
$location = $this->helpers['URLHelper']->getLocation()[1];
$params     = $this->helpers['URLHelper']->getAllParameters();


if($params == ""){
	$params = array();
}

if(gettype($params) != "array"){
	$array = array(
		0 => $params
	);
	$params = $array;
}
?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width">
    <meta name="author" content="Madeflona">
    <title><?php $this->helpers['URLHelper']->getTitle(); ?></title>

    <!-- Styles -->
    <?php $this->helpers['URLHelper']->getStyles(); ?>
    <link rel="stylesheet" href="<?php echo $url; ?>/assets/css/loader.css">
    <link rel="stylesheet" href="<?php echo $url; ?>/assets/libs/icons/style.css">
    <link rel="shortcut icon" href="<?php echo $url ?>/assets/img/favicon.png" type="image/x-icon">

</head>

<body>
    <div id="loader-overlay" style="display:none">
        <span class="loader loader-circles"></span>
    </div>
    <header class="page-header">
        <div class="expanded row">
            <div class="col-lg-3 logo">
                <img src="<?php echo $url; ?>/assets/img/logo.png">
            </div>
            <!-- navbar right -->
            <div class="col-lg-9 col-md-12 navbar-right text-center" style="background-color: #fff;">
                <div class="toggle-menu bars" data-open-sidebar>
                    <i class="fa fa-bars" style="margin-left: 10px;"></i>
                </div>

                <div class="mobile logo">
                    <img src="<?php echo $url; ?>/assets/img/logo.png">
                </div>

                <ul class="nav pull-right">
                    <li class="switch-li toggle-sidebar">
                        <label class="switch">
                            <input type="checkbox" checked>
                            <span class="slider round"></span>
                        </label>
                    </li>

                    <li class="divider"></li>

                    <li>
                        <a href="javascript:void(0)" onclick="location.reload();">
                            <i class="fas fa-sync-alt"></i>
                        </a>
                    </li>

                    <li class="hide-fullscreen">
                        <a href="javascript:void(0)" data-action="fullscreen">
                            <i class="fas fa-expand"></i>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </header>

    <section id="content">
        <div class="expanded row app-wrap">

            <div class="col-lg-3 col-md-3 c-2">

                <?php require ROOT . '/views/dashboard/shared/menu.php'; ?>

            </div>

            <div class="col-lg-9 col-md-12 page">

                <?php require $file; ?>

            </div>
        </div>
    </section>

    <script type="text/javascript">
        var PATH = "<?php echo $url; ?>";
        var Helpers = {};
    </script>

    <!-- Scripts -->
    <?php $this->helpers['URLHelper']->getScripts(); ?>
    <script defer type="text/javascript" src="<?= $url ?>/assets/libs/jquery/jquery.min.js"></script>
    <script defer type="text/javascript" src="<?= $url ?>/assets/libs/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script defer type="text/javascript" src="<?= $url ?>/assets/js/helpers/helpers.js"></script>
    <script defer type="text/javascript" src="<?= $url ?>/assets/js/dashboard/menu.js"></script>


</body>

</html>
<?php
	$url      = $this->helpers['URLHelper']->getURL();
	$location = $this->helpers['URLHelper']->getLocation();
?>

<!DOCTYPE html>
<html lang="pt-BR">

	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
		<meta name="author" content="...">
		<meta name="description" content="">
		<meta name="keywords" content="...">

		<title><?php $this->helpers['URLHelper']->getTitle(); ?></title>

		<!-- Styles -->
		<link rel="stylesheet" href="<?=$url?>/assets/css/loader.css">
		<link rel="stylesheet" href="<?=$url?>/assets/css/font.css">
		<link rel="stylesheet" href="<?=$url?>/assets/css/site/style.css">
		<link rel="stylesheet" href="<?= $url ?>/assets/libs/fontawesome/css/all.min.css">
		<?php $this->helpers['URLHelper']->getStyles(); ?>
		<link rel="shortcut icon" href="<?php echo $url ?>/assets/img/favicon.png" type="image/x-icon">

	</head>

	<body>

		<div id="loader-overlay" style="display:none">
			<span class="loader loader-circles"></span>
		</div>

		<header>
			
		</header>

		<main class="content">
			<?php require $file; ?>
		</main>

		<footer>

		</footer>

		<!--Others-->

		<!-- Scripts -->
		<script type="text/javascript">
			var PATH = "<?php echo $url; ?>";
			var Helpers = {};
		</script>

		<script defer type="text/javascript" src="<?= $url ?>/assets/libs/jquery/jquery.min.js"></script>
		<script defer type="text/javascript" src="<?= $url ?>/assets/libs/jquery/jquery.mask.min.js"></script>
		<script defer type="text/javascript" src="<?= $url ?>/assets/js/helpers/helpers.js"></script>

		<?php $this->helpers['URLHelper']->getScripts(); ?>

	</body>
</html>
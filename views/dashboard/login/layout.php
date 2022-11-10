<?php
	$url      = $this->helpers['URLHelper']->getURL();
	$location = $this->helpers['URLHelper']->getLocation();
?>

<!DOCTYPE html>
<html lang="pt-BR">

	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width">
		<meta name="author" content="trash hunters">
		<title><?php $this->helpers['URLHelper']->getTitle(); ?></title>

		<link rel="shortcut icon" href="<?php echo $url ?>/assets/img/favicon.png" type="image/x-icon">

		<!-- Styles -->
		<?php $this->helpers['URLHelper']->getStyles(); ?>

	</head>

	<body>

		<main class="content">
			<?php require $file; ?>
		</main>

		<script type="text/javascript">
			var PATH = "<?php echo $url; ?>";
			var Helpers = {};
		</script>
		<script defer type="text/javascript" src="<?= $url ?>/assets/libs/jquery/jquery.min.js"></script>
		<script defer type="text/javascript" src="<?= $url ?>/assets/libs/bootstrap/js/bootstrap.bundle.min.js"></script>
		<script defer type="text/javascript" src="<?= $url ?>/assets/js/helpers/helpers.js"></script>

		<!-- Scripts -->
		<?php $this->helpers['URLHelper']->getScripts(); ?>

	</body>
</html>

<style>
	@media(max-width:767px){

		footer p{
			font-size: 12px;
		}

		footer .col-md-6,
		footer .socialMedia{
			text-align: center!important;
		}
	}
</style>
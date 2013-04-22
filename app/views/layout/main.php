<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8" />

		<!-- Always force latest IE rendering engine (even in intranet) & Chrome Frame
		Remove this if you use the .htaccess -->
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />

		<title><?php echo $title; ?></title>
		<meta name="description" content="" />
		<meta name="author" content="PRO11_6" />

		<meta name="viewport" content="width=device-width, initial-scale=1.0" />

		<!-- Replace favicon.ico & apple-touch-icon.png in the root of your domain and delete these references -->
		<link rel="shortcut icon" href="/favicon.ico" />
		<link rel="apple-touch-icon" href="/apple-touch-icon.png" />
	</head>

	<body>
		<script type="text/javascript">
			document.write('<textarea class="hidden">');
		</script>
		<?php echo $contents; ?>
		<textarea class="hidden"></textarea>
		
		<script type="text/javascript">
			var viewData = <?php echo $viewData; ?>;
			Mustache = {};
		</script>
		
		<?php if($app->config('environment') == 'development'):
			$app->render('layout/js.php');
		else: ?>
			<!-- TODO: minify javascript application -->
		<?php endif; ?>
	</body>
</html>

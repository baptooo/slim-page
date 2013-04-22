<?php
	// Slim import & init
	require 'Slim/Slim.php';
	\Slim\Slim::registerAutoloader();
	
	//Config
	$templatePath = './app/views';
	
	// App import
	require 'app/Compiler.php';
	AppCompiler::compile($templatePath);
	
	$app = new \Slim\Slim(array(
		'templates.path' => $templatePath
	));
	
	// Environment setting
	switch($_SERVER['SERVER_NAME']) {
		case 'dev.slim.local':
			$app->config('environment', 'development');
			break;
		default:
			$app->config('environment', 'production');
	}
	
	// Remap router
	$app->get('/(:section)(/:page)', function($section = 'pages', $page = 'home') use($app) {
		$pathToSectionData = 'data/' . $section . '.json';
		
		if(!file_exists($pathToSectionData)) {
			return $app->render('pages/404.php', array(
				'message' => '404 Error: The section ' . $section . ' does not exists on this website.'
			), 404);
		}
		$sectionData = json_decode(file_get_contents($pathToSectionData), true);
		
		if(!isset($sectionData[$page])) {
			return $app->render('pages/404.php', array(
				'message' => '404 Error: The page ' . $section . ' / ' . $page . ' does not exists on this website.'
			), 404);
		}
		
		$viewData = $sectionData[$page];
		
		if($app->request()->isAjax()) {
			die(json_encode($viewData));
		}
		
		// Mustache contents view setting
		$m = new \Slim\Extras\Views\Mustache();
		$m->setTemplatesDirectory($app->config('templates.path'));
		$m->setData($viewData);
		
		$app->render('layout/main.php', array(
			'app' => $app,
			'title' => $viewData['title'],
			'contents' => $m->render($viewData['template'] . '.php'),
			'viewData' => json_encode($viewData)
		));
	});
	
	$app->run();
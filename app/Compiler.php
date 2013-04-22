<?php
/**
 * Class Compiler, builds automatically each templates
 * of the project for front-end application
 */
class AppCompiler {
	/**
	 * lastModified filepath
	 */
	protected static $lastModified = 'app/last_modified.txt';
	
	public static $js = array();
	
	/*
	 * Compile all the templates
	 */
	public static function compile($templatePath) {
		$lastModified = '';
		$tpls = array();
		
		foreach(glob($templatePath.'/pages/*') as $filename) {
			$lastModified .= filemtime($filename);
			$name = str_replace(array($templatePath.'/', '.php'), '', $filename);
			$tpls[(string)$name] = file_get_contents($filename);
		}
		
		$lastModified = md5($lastModified);
		
		// TemplatePath not modified since last compilation
		if($lastModified == self::getLastModified()) {
			return false;
		};
		// Updating lastModified md5 chain
		self::setLastModified($lastModified);
		
		$output = 'Mustache.compiled = ' . json_encode($tpls). ';';
		file_put_contents('src/compile/templates.js', $output);
	}
	
	/*
	 * return last modified templatePath
	 */
	public static function getLastModified() {
		return file_get_contents(self::$lastModified);
	}
	/**
	 * set last modified templatePath
	 */
	public static function setLastModified($time) {
		file_put_contents(self::$lastModified, $time);
	}
	
	/**
	 * Add js file
	 */
	public static function js($path) {
		$basePath = preg_match('/http:\/\//', $path) ? '' : 'src/';
		array_push(self::$js, $path);
		echo '<script type="text/javascript" src="' . $basePath . $path . '" charset="utf-8" ></script>'. "\n";
	}
}
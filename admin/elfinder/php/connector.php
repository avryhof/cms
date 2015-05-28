<?php

/*
$basepath = $_SERVER['DOCUMENT_ROOT'];
$baseurl = "http" . ((!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] != 'off') ? "s" : "") . "://" . $_SERVER['HTTP_HOST'];
*/

require_once("../../../config.inc.php");

$folder = $_GET['folder'];

error_reporting(0); // Set E_ALL for debuging

include_once __DIR__.DIRECTORY_SEPARATOR.'elFinderConnector.class.php';
include_once __DIR__.DIRECTORY_SEPARATOR.'elFinder.class.php';
include_once __DIR__.DIRECTORY_SEPARATOR.'elFinderVolumeDriver.class.php';
include_once __DIR__.DIRECTORY_SEPARATOR.'elFinderVolumeLocalFileSystem.class.php';
// Required for MySQL storage connector
// include_once $basepath."/vendor/studio-42/elfinder/php".DIRECTORY_SEPARATOR.'elFinderVolumeMySQL.class.php';
// Required for FTP connector support
// include_once $basepath."/vendor/studio-42/elfinder/php".DIRECTORY_SEPARATOR.'elFinderVolumeFTP.class.php';


/**
 * Simple function to demonstrate how to control file access using "accessControl" callback.
 * This method will disable accessing files/folders starting from  '.' (dot)
 *
 * @param  string  $attr  attribute name (read|write|locked|hidden)
 * @param  string  $path  file path relative to volume root directory started with directory separator
 * @return bool|null
 **/
function access($attr, $path, $data, $volume) {
	return strpos(basename($path), '.') === 0       // if file/folder begins with '.' (dot)
		? !($attr == 'read' || $attr == 'write')    // set read+write to false, other (locked+hidden) set to true
		:  null;                                    // else elFinder decide it itself
}

$opts = array(
	// 'debug' => true,
	'roots' => array(
		array(
			'driver'        => 'LocalFileSystem',   // driver for accessing file system (REQUIRED)
			'path'          => $basepath.'/uploads/'.(!empty($folder) ? "$folder/" : ""),         // path to files (REQUIRED)
			'URL'           => $baseurl.'/uploads/'.(!empty($folder) ? "$folder/" : ""), // URL to files (REQUIRED)
			'tmbPath'		=> 'thumbs',
			'attributes' => array(
                array( // hide readmes
                    'pattern' => '/thumbs/',
                    'read' => true,
                    'write' => true,
                    'hidden' => true,
                    'locked' => false
                )
			),
			'accessControl' => 'access'             // disable and hide dot starting files (OPTIONAL)
		)
	)
);

// run elFinder
$connector = new elFinderConnector(new elFinder($opts));
$connector->run();


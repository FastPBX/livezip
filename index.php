<?php

include "CreateZipFile.php";
include "CreateZipDirectory.php";

// CONFIG
$pathWorkspace = 'workspace';
$urlPrefix = 'livezip';
$use404ifNotFound = false;


// get our uri
$requestedFile = $_ENV['REQUEST_URI'];

// split URL into parts
$parts = explode('/', $requestedFile);
// remove first empty element
array_shift($parts);

if($parts[0] == $urlPrefix)
{
	// match
	$workspaceByName = $parts[1];
	// remove .zip extensions
	$workspaceByName = str_ireplace(".zip", "", $workspaceByName);

	// now try and find the next part in workspace
	if(strlen($workspaceByName))
	{
		return zipDirectoryFromWorkspace($pathWorkspace . '/' . $workspaceByName);
	}
}
else
{
	handleNotFound($use404ifNotFound);
}


function zipDirectoryFromWorkspace($directory)
{
	$zip = new CreateZipDirectory;

	$zip->get_files_from_folder("$directory/","");

	// output live
	header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
	header("Cache-Control: post-check=0, pre-check=0", false);
	header("Pragma: no-cache");
	header('Content-Disposition: attachment; filename='.'zipper'.'.zip'.'');
	header('Content-Type: application/zip');
	$content = $zip->getZippedfile();
	$length = strlen($content);
	header('Content-Length: '.$length);
	echo $content;
	exit();
}


function handleNotFound($shouldUse404=false)
{
	echo " NOT FOUND " . getcwd();
}

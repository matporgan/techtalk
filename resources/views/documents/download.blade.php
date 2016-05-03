<?php
	$file_name = $document->name;
	$file_url = "http://$_SERVER[HTTP_HOST]" . $document->path;

	header('Content-Type: application/octet-stream');
	header("Content-Transfer-Encoding: Binary"); 
	header("Content-disposition: attachment; filename=\"".$file_name."\""); 
?>
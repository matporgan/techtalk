<?php
	$file_name = $document->name;
	$file_url = public_path() . $document->path;

	$headers = array(
		"Content-Type: application/octet-stream",
		"Content-Disposition: attachment; filename=\"".$file_name."\""
	);

	return Response::download($file_url, $file_name, $headers);
?>
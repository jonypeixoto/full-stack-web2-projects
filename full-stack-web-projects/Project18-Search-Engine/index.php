<!DOCTYPE html>
<html>
<head>
    <title>Search Engine</title>
</head>
<body>

<?php

	if(isset($_POST['q'])){
	$q = urlencode($_POST['q']);
	$handle = curl_init();
 
	$url = 'https://www.googleapis.com/customsearch/v1?key=AIzaSyC58OGfZzDtUSXrU_WW3hVrBLB6yxWuClw&cx=8082d3163bc38490b&q='.$q;
 
	// Set the url
	curl_setopt($handle, CURLOPT_URL, $url);
	// Set the result output to be a string.
	curl_setopt($handle, CURLOPT_RETURNTRANSFER, true);
	curl_setopt($handle, CURLOPT_SSL_VERIFYPEER , false);
	$output = curl_exec($handle);
	 
	curl_close($handle);
 
	$result = json_decode($output);

	for($i = 0; $i < count($result->items);$i++){
		echo '<a href="'.$result->items[$i]->link.'">';
		echo $result->items[$i]->title;
		echo '</a>';
		echo '<br>';
	}

	}
?>

<form method="post">
	<input type="text" name="q">
	<input type="hidden" name="search">
	<input type="submit" name="action" value="Search!">
</form>

</body>
</html>
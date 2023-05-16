<?php
if(isset($_POST['acao'])){
$urlPost = urlencode($_POST['q']);
$url = 'http://pt.wikipedia.org/w/api.php?action=query&prop=extracts|info&exintro&titles='.$urlPost.'&format=json&explaintext&redirects&inprop=url&indexpageids';

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);  
curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
$data = curl_exec($ch);
curl_close($ch);

$data = json_decode($data);

$pageid = $data->query->pageids[0];
//echo $data->query->pages->$pageid->title;
echo $data->query->pages->$pageid->extract;
}
?>
<form method="post">
	<input type="text" name="q">
	<input type="submit" name="acao" value="Enviar">
</form>

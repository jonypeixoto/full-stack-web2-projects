<form method="post">
	<input type="text" name="message">
</form>

<?php
if(isset($_POST['message'])){
//Garantir que seja lido sem problemas

//Worskspace
$workspace = "7bdf7bf9-2adb-44b6-9b09-3603ba68d044";
$apikey = "6aajDnz4BTK5CX6iGK77oGT0Zh2ammWXxKoqOWeM_0_H";

$texto = $_POST['message'];

//Verifica se existe identificador
//Caso não haja, crie um
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
if(isset($_SESSION["identificador"])){
	$identificador = $_SESSION["identificador"];
}else{
	//Você pode usar qualquer identificador
	//Você pode usar ID do usuário ou similar
	$identificador = md5(uniqid(rand(), true));
	$_SESSION["identificador"] = $identificador;
}

//URL da API
$url = "https://gateway.watsonplatform.net/conversation/api/v1/workspaces/" . $workspace;
$urlMessage = $url . "/message?version=2017-05-26";

//Dados
$dados  = "{";
$dados .= "\"input\": ";
$dados .= "{\"text\": \"" . $texto . "\"},";
$dados .= "\"context\": {\"conversation_id\": \"" . $identificador . "\",";
$dados .= "\"system\": {\"dialog_stack\":[{\"dialog_node\":\"root\"}], \"dialog_turn_counter\": 1, \"dialog_request_counter\": 1}}";
$dados .= "}";

//Cabeçalho que leva tipo de Dados
$headers = array('Content-Type:application/json');

//Iniciando Comunicação cURL
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $urlMessage);
curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_POSTFIELDS, $dados);
curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

curl_setopt($ch, CURLOPT_USERPWD, "apikey:$apikey");
curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
//Executar
$retorno = curl_exec($ch);
//Fechar Conexão
curl_close($ch);

//Imprimir com leitura fácil para humanos
$retorno = json_decode($retorno);
print_r($retorno);

//echo $retorno->output->text['0'];

}
?>
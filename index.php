<?php 
define('TOKEN', getenv('token'));
define('API', 'https://api.telegram.org/bot'.TOKEN.'/');

$permitted_chars = '0123456789abcdefghijklmnopqrstuvwxyz';
$promoCode = strtoupper(substr(str_shuffle($permitted_chars), 0, 7));

$data = json_decode(file_get_contents('php://input'));

switch ($data->message->text) {
	case '/start':
		$result = file_get_contents(API.'sendMessage?'.http_build_query([
			'chat_id' => $data->message->chat->id, 
			'text'=> 'Hello, I BOT!'
		]));
		break;

	case '/promo':
		$result = file_get_contents(API.'sendMessage?'.http_build_query([
			'chat_id' => $data->message->chat->id, 
			'text'=> 'Промокод Boom: ' . $promoCode
		]));
		break;


	
	// default:
	// 	$result = file_get_contents(API.'sendMessage?'.http_build_query([
	// 		'chat_id' => $data->message->chat->id, 
	// 		'text'=> $data->message->text
	// 	]));
	// 	break;
}

print_r($result);
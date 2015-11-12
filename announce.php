<?php
error_reporting(E_ALL);
$secretPhrase = "";

require('recaptcha/src/autoload.php');
$recaptcha = new \ReCaptcha\ReCaptcha('6LentBATAAAAAClsv5C-L76fJYC4PDiJMTEyi4df');

$resp = $recaptcha->verify($_POST['g-recaptcha-response'], $_SERVER['REMOTE_ADDR']);
if($resp->isSuccess())
{
	$url = 'http://127.0.0.1:7776/nhz';

	// check if account exists
	$data = array(
		'requestType'=>'getAccount',
		'account'=>$_POST['recipient']
	);
	$data_string = '';
	foreach($data as $key=>$value) { $data_string .= $key.'='.$value.'&'; }
	rtrim($data_string, '&');
	$ch = curl_init($url);
	curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (X11; Linux i686; rv:20.0) Gecko/20121230 Firefox/20.0');
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	curl_setopt($ch, CURLOPT_POST, count($data));
	curl_setopt($ch, CURLOPT_POSTFIELDS, $data_string);
	$result = curl_exec($ch);
	$error = curl_error($ch);
	curl_close($ch);

	if(!empty($error))
	{
	  print_r($error); exit();
	}

	$result = json_decode($result,true);

	if(isset($result['publicKey'])) {
		echo 'Account public key already broadcasted';
	} else {
		$data = array(
			'requestType'=>'sendMessage',
			'recipient'=>$_POST['recipient'],
			'recipientPublicKey'=>$_POST['publicKey'],
			'message'=>'Account activation',
			'secretPhrase'=>$secretPhrase,
			'feeNQT'=>100000000,
			'deadline'=>60
		);
		$data_string = '';
		foreach($data as $key=>$value) { $data_string .= $key.'='.$value.'&'; }
		rtrim($data_string, '&');
		$ch = curl_init($url);
		curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (X11; Linux i686; rv:20.0) Gecko/20121230 Firefox/20.0');
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_POST, count($data));
		curl_setopt($ch, CURLOPT_POSTFIELDS, $data_string);
		$result = curl_exec($ch);
		$error = curl_error($ch);
		curl_close($ch);

		if(!empty($error))
		{
		  print_r($error);
		}

		echo $result;
	}
}
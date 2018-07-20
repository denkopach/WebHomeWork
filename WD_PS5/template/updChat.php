<?php
 
if(empty($access) && $_SERVER['REQUEST_METHOD'] !== 'POST') {
    header("location:/"); 
}

//get msg if uodate time diferent
	
if (isset($_POST['updChat'])) {
	if(file_exists('../json/chatMsg.json')){

		$file = file_get_contents('../json/chatMsg.json', true);
		$msgObj = json_decode($file,true);

		$msgObj = array_filter($msgObj, function($val){
			return $val[time] > time() - 3600;
		});

		echo json_encode($msgObj);
	}

}

//add msg to json
if (isset($_POST['btmMsg'])) {
	$userMsg = $_POST['userMsg'];
	addMsgToDb($userMsg);
}

function addMsgToDb($userMsg) {
	if(file_exists('json/chatMsg.json')){
		$file = file_get_contents('json/chatMsg.json', true);
		$msg = json_decode($file,true);
	}
	$msg[] = [
				"name" => $_SESSION['user'],
				"time" => time(), 
				"msg"=> $userMsg
				];
	file_put_contents('json/chatMsg.json',json_encode($msg, JSON_UNESCAPED_UNICODE|JSON_PRETTY_PRINT));
}

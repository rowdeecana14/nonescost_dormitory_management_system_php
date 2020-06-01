<?php	
	require_once "../models/model.php";
	session_start();
	date_default_timezone_set('Asia/Manila');
	$date =  date("Y-m-d h:i:s");
	$message = "Logout successfully.";
	$action = "Logout";
	$user_id = $_SESSION['DMMS_userid'];
	userLogs($message, $action, $date, $user_id);

	unset($_SESSION['DMMS_userid']);
	unset($_SESSION['DMMS_login_token']);
	header("location: ../views/login/");

	function userLogs($message, $action, $date, $user_id) {
		$database = new Database;
		$crud = new CRUD;
		$sql = "INSERT INTO user_logs (message, action, date, user_id) VALUES ('$message', '$action', '$date', '$user_id')";
		$crud->addRecord($sql);
	}
?>
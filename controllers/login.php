<?php
	require_once "../models/model.php";
	session_start();

	if($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['action'])) {

		//LOGIN
		if($_POST['action'] == "login" ) {
			if($_SESSION['DMMS_login_token'] == $_POST['DMMS_login_token']) {
				$database = new Database;
				$login = new Login;
				$user = new CRUD;

				date_default_timezone_set('Asia/Manila');
				$date =  date("Y-m-d h:i:s");
				$username_is_valid = $database->checkData($_POST['username']);
				$password_is_valid = $database->checkData($_POST['password']);
				$action = "";

				if($username_is_valid == false) {
					array_push($php_message, "Username is required.");
				}
				if($password_is_valid == false) {
					array_push($php_message, "Password is required.");
				}
				if($username_is_valid == true &&
					$password_is_valid == true) {

					$userid = "";
					$username = $database->cleanData($_POST['username']);
					$password = $database->cleanData($_POST['password']);
					$password = md5($password);

					$sql1 = "SELECT * FROM users WHERE username='$username'";
					$username_exist = $login->validateLogin($sql1);
					$sql2 = "SELECT * FROM users WHERE username='$username' AND user_password='$password'";
					$password_exist = $login->validateLogin($sql2);
					$sql3 = "SELECT * FROM users WHERE username='$username' AND user_password='$password' AND user_status='Active'";
					$account_active = $login->validateLogin($sql3);

					$user_data = $user->displayRecord($sql1);
					$message = validateResult($username_exist, $password_exist, $account_active);
					

					if($message == "Login successfully.") {
						$user_id = $user_data[0]['user_id'];
						$_SESSION['DMMS_userid'] = $user_id;
						$action = "Login";
						userLogs($message, $action, $date, $user_id);
						$data = array("link" =>"../dashboard/", "php_message" =>$message, "php_error" =>false);
						echo json_encode($data);
					}
					else {

						if($username_exist == false) {
							$user_id = 0;
						}
						else {
							$user_id = $user_data[0]['user_id'];
						}
						$action = "Error";
						userLogs($message, $action, $date, $user_id);
						$data = array("link" =>"", "php_message" =>[$message], "php_error" =>true);
						echo json_encode($data);
					}
				}
				else {
					$data = array("link" =>"", "php_message" =>"Invalid input.", "php_error" =>true);
					echo json_encode($data);
				}
			}
		}

	
	}


	function validateResult($username_exist, $password_exist, $account_active) {
		$php_message = "";
		if($username_exist == true) {
			if($password_exist == true) {
				if($account_active == true) {
					$php_message = "Login successfully.";
				}
				else {
					$php_message = "User account is inactive.";
				}
			}
			else {
				$php_message = "User password is incorrect.";
			}
		}
		else {
			$php_message = "User account not exist.";
		}
		return $php_message;
	}

	function userLogs($message, $action, $date, $user_id) {
		$database = new Database;
		$crud = new CRUD;
		$sql = "INSERT INTO user_logs (message, action, date, user_id) VALUES ('$message', '$action', '$date', '$user_id')";
		$crud->addRecord($sql);
	}
?>
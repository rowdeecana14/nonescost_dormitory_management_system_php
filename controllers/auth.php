<?php
	session_start();
	function loginAuth() {
		if(isset($_SESSION['DMMS_userid']) && !empty($_SESSION['DMMS_userid'])) {
			header("location: ../dashboard/");
		}
	}

	function homeAuth() {
		if(!isset($_SESSION['DMMS_userid']) && empty($_SESSION['DMMS_userid'])) {
			header("location: ../login/");
		}
	}

	function token($name) {
		require_once "../../models/model.php";
		$database = new Database;
		$DMMS_token = $database->generateToken();
		$_SESSION[$name] = $DMMS_token;
		return $DMMS_token;
	}
?>
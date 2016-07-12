<?php
session_name('evypms');
session_start();
header("Content-Type: text/json");

function dexit($errorcode) {
	die(json_encode(array("success"=>false,"error"=>$errorcode)));
}

if (!isset($_SESSION["login"]) || empty($_SESSION["login"]) ||  $_SESSION["login"] !== true) {
	// user not login
	dexit("1");
}

if (!isset($_GET["fileid"]) || empty($_GET["fileid"])) {
	dexit("1");
}

$mysqli = new mysqli("localhost", "root", "", "evypms");
$query = "SELECT * FROM files WHERE FileID='".$mysqli->real_escape_string($_GET["fileid"])."'";
$qq = $mysqli->query($query);
if ($qq->num_rows > 0) {
	$thefile = $qq->fetch_assoc();
	$file = "projectfiles/".$thefile["Filename"];
		if (file_exists($file)) {
	    header('Content-Description: File Transfer');
	    header('Content-Type: application/octet-stream');
	    header('Content-Disposition: attachment; filename="'.$thefile["Name"].'"');
	    header('Expires: 0');
	    header('Cache-Control: must-revalidate');
	    header('Pragma: public');
	    header('Content-Length: ' . filesize($file));
	    readfile($file);
	    die();
	}
} else {
	dexit("2");
}
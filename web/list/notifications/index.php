<?php
// Main include
include $_SERVER["DOCUMENT_ROOT"] . "/inc/main.php";

if ($_REQUEST["ajax"] == 1 && $_REQUEST["token"] == $_SESSION["token"]) {
	// Data
	exec("v-list-user-notifications $user json", $output, $return_var);
	$data = json_decode(implode("", $output), true);

	function sort_priorty_id($element1, $element2) {
		return $element2["PRIORITY"] <=> $element1["PRIORITY"];
	}
	$data = array_reverse($data, true);
	usort($data, sort_priorty_id(...));

	foreach ($data as $key => $note) {
		$note["ID"] = $key;
		$data[$key] = $note;
	}
	echo json_encode($data);
	exit();
}

$TAB = "NOTIFICATIONS";

// Data
exec("v-list-user-notifications $user json", $output, $return_var);
$data = json_decode(implode("", $output), true);
$data = array_reverse($data, true);

// Render page
render_page($user, $TAB, "list_notifications");

// Back uri
$_SESSION["back"] = $_SERVER["REQUEST_URI"];

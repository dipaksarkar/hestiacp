<?php
ob_start();
include $_SERVER["DOCUMENT_ROOT"] . "/inc/main.php";

// Check token
verify_csrf($_GET);

exec("v-add-cron-reports " . $user, $output, $return_var);
unset($output);

header("Location: /list/cron/");
exit();

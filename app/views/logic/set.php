<?php
$username = $_SESSION['cocotmuuser'];
$users = query("SELECT id FROM users_tb WHERE username = '$username'")[0];
// buat cookie
setcookie('port', $users['id'], time() + (60 * 60 * 24 * 7), '/');
setcookie('key', hash('sha256', $username), time() + (60 * 60 * 24 * 7), '/');
header("Location:" . BASEURL);
exit;
?>
<?php
$users = json_decode(file_get_contents("users.json"), true);
print_r($users);
?>

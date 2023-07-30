<?php
// ini_set('display_errors', 1);
// error_reporting(E_ALL);
include "/home/voodoo/Desktop/zoofari_API/config/config.php";

$select_users = $database->prepare("SELECT * FROM post_data");
$select_users->execute();
$users = $select_users->fetchAll(PDO::FETCH_ASSOC);

include "/home/voodoo/Desktop/zoofari_API/views/home.html";
?>
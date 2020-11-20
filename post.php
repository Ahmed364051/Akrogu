<?php
session_start();
require_once 'vendor/connect.php';
if(!$_GET['post_id']){header('Location: ../profile.php');} 


$post = getOne("SELECT * FROM list WHERE id_list = {$_GET['post_id']}");
?>
<!-- Тут делаешь дизайн дальше и где надо будет будешь вставлть этот код: 
<?=$post['list_name']?>
<?=$post['comment']?>
<?=$post['rating']?>
 -->
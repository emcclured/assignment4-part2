<?php
require_once("dataBase.php");

videoDB::getInstance()->toggle_checkout($_POST['id']);
header('Location: editVideoList.php');
?>

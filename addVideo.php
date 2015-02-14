<?php
/* * Start session */
session_start();

/** Create a new database object */
require_once("dataBase.php");

if ($_SERVER['REQUEST_METHOD'] == "POST") {
       videoDB::getInstance()->insert_video($_POST['name'], $_POST['category'], $_POST['length'], $_POST['rented']);
       header('Location: editVideoList.php');
       exit;
}
?>
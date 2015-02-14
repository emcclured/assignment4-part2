<?php
  require_once("dataBase.php");
  
  videoDB::getInstance()->delete_video_with_id($_POST['id']);
  header('Location: editVideoList.php' );
?>

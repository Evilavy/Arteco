<?php
session_start();

session_destroy();
header('Location: write_new_article.php');
exit();
?>
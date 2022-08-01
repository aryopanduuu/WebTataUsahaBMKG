<?php 
 include "../database/db.php";
 session_start();
 session_destroy();
  
 header("Location: ../index.php");
  
 ?>
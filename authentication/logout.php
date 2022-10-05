<?php
session_start();
   $can_logout = $_POST["can_logout"];

   if($can_logout){
    session_destroy();
    session_unset();
   }

   echo json_encode(array("can_logout" => true));
?>
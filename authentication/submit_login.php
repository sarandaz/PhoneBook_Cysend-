<?php
session_start();
include('../db/config.php');
if (isset($_POST['action'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $query = $conn->prepare("SELECT * FROM user WHERE username=:username");
    $query->bindParam("username", $username, PDO::PARAM_STR);
    $query->execute();
    $result = $query->fetch(PDO::FETCH_ASSOC);
    if (!$result) {
        echo '<p class="error">Username password combination is wrong!</p>';
    } else {
        if ($password == $result['password']) {
            $_SESSION['username'] = $result['username'];
            echo 'OK';
        } else {
            echo '<p class="error">Username password combination is wrong!</p>';
        }
    }
}
?>
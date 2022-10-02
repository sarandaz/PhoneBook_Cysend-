<?php 
include('../db/config.php');
$first_name = $_POST["first_name"];
$last_name = $_POST["last_name"];
$address = $_POST["address"];
$country = $_POST["country"];
$username = $_SESSION['username'];
// var_dump($_POST);

try {
$stmt = $conn->prepare("UPDATE user SET first_name = :first_name , last_name = :last_name, 
address = :address, country= :country where username = :username");
    $stmt->bindParam(':first_name', $first_name);
    $stmt->bindParam(':last_name', $last_name);
    $stmt->bindParam(':address', $address);
    $stmt->bindParam(':country', $country);
    $stmt->bindParam(':username', $username);

// insert a row
    // var_dump($stmt);
    $stmt->execute();

    echo "Contact data saved successfully";
}  catch(PDOException $e)
{
    $urlError =  $e->getMessage();
}

try {
    $data = [];
    foreach ($_POST['phone'] as $phone) {
        $published = isset($phone[1]) ? true : false;
        $data[] =
            [
                'username' => $_SESSION['username'],
                'phone_number' => $phone[0],
                'published' => $published
            ];

    }
    // var_dump($data);
    $sql = "INSERT INTO phone_number(username, phone_number, published) 
    VALUES (:username,:phone_number,:published)";
    $stmt = $conn->prepare($sql);
    try {

        foreach ($data as $row)
        {   
            $stmt->execute($row);
        }
        echo "Phone numbers saved successfully";
    }catch (Exception $e){
        $conn->rollback();
        throw $e;
    }
} catch(PDOException $e) {
    $urlError =  $e->getMessage();
}

try {
    $data = [];
    foreach ($_POST['email'] as $email) {
        $published = isset($email[1]) ? true : false;
        $data[] =
            [
                'username' => $_SESSION['username'],
                'email_address' => $email[0],
                'published' => $published
            ];

    }
    // var_dump($data);
    $sql = "INSERT INTO email(username, email_address, published) 
    VALUES (:username,:email_address,:published)";
    $stmt = $conn->prepare($sql);
    try {

        foreach ($data as $row)
        {   
            $stmt->execute($row);
        }
        echo "Emails saved successfully";
    }catch (Exception $e){
        $conn->rollback();
        throw $e;
    }
} catch(PDOException $e) {
    $urlError =  $e->getMessage();
}

<?php
session_start();

require ('Configuratiomn/database.php');

$database =new Database();

//check user logging

if (isset($_POST['username']) && isset($_POST['password'])){
    $username = $database->sanitize($_POST['username']);
    $password = $database->sanitize($_POST['password']);

    $password=$database->mid($password);

    $count=$database->find($username, $password);

    if ($count == 1) {
        $_SESSION['username'] = $username;
        $res = $database->activate($username, $password); //user activated
        if ($res) {
            echo json_encode(array("statusCode" => 200));
        }
    }else {
        echo json_encode(array("statusCode" => 201));
    }
}else {
    echo json_encode(array("statusCode" => 202));
}

?>


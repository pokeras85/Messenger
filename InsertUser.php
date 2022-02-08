<?php
require('Configuratiomn/database.php');

$database =new Database();

if(isset($_POST['username']) && isset($_POST['email']) && isset($_POST['password']) ) {
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    $username = $database->sanitize($_POST['username']);

        $r = $database->check_username($username);


        //check if email allredy exist
        if ($r !== 1) {
            $email = $database->sanitize($_POST['email']);
            $password = $database->sanitize($_POST['password']);

            $password = $database->mid($password);

            $res = $database->create($username, $email, $password);

            if ($res) {
                echo json_encode(array("statusCode" => 200));
            }else{
                echo json_encode(array("statusCode" => 201));
            }
        }
        else {
            echo json_encode(array("statusCode" => 202));
        }
};

?>
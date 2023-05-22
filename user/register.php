<?php

include '../connection.php';

$name = $_POST['name'];
$email = $_POST['email'];
$password = $_POST['password'];
$created_at = $_POST['created_at'];
$updated_at = $_POST['updated_at'];

$sql_check = "SELECT * FROM users WHERE email = '$email'";

$result_check = $connect->query($sql_check);

$password_hashed = password_hash($password, PASSWORD_DEFAULT);

if ($result_check->num_rows > 0) {
    echo json_encode(
        array(
            "success" => false,
            "message" => "email"
        )
    );
} else {
    $sql = "INSERT INTO users 
            SET 
            name = '$name',
            email = '$email',
            password = '$password_hashed',
            created_at = '$created_at',
            updated_at = '$updated_at'
           ";

    $result = $connect->query($sql);

    if ($result) {
        echo  json_encode(
            array(
                "success" => true,
            )
        );
    } else {
        echo  json_encode(
            array(
                "success" => false,
                "message" => "Gagal"
            )
        );
    }
}

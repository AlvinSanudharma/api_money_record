<?php

include '../connection.php';

$email = $_POST['email'];
$password = $_POST['password'];

$sql = "SELECT * FROM users WHERE email = '$email'";

$result = $connect->query($sql);

if ($result->num_rows > 0) {
    $user = array();

    while ($row = $result->fetch_assoc()) {
        $user[] = $row;
    }


    if (password_verify($password, $user[0]['password'])) {
        echo json_encode(array(
            "success" => true,
            "data" => $user[0]
        ));
    }
} else {
    echo json_encode(array(
        "success" => false
    ));
}

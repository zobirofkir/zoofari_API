<?php
// ini_set('display_errors', 1);
// error_reporting(E_ALL);
include "/home/voodoo/Desktop/zoofari_API/config/config.php";

// $create_data = $database->prepare("CREATE TABLE post_data(id INT PRIMARY KEY NOT NULL AUTO_INCREMENT, username VARCHAR(500) NOT NULL, email VARCHAR(500) NOT NULL, password VARCHAR(500) NOT NULL)");
// $create_data->execute();

if (isset($_POST["send"])) {
    $username = $_POST["username"];
    $email = $_POST["email"];
    $password = $_POST["password"];
    $confirm_password = $_POST["confirm_password"];

    if ($password !== $confirm_password) {
        $bad = "Passwords do not match!";
    } else {
        $check_count = $database->prepare("SELECT COUNT(*) FROM post_data WHERE email=:email");
        $check_count->bindParam(":email", $email);
        $check_count->execute();
        $check_email = $check_count->fetchColumn();

        if ($check_email > 0) {
            $exist = "Email already exists!";
        } else {
            $send_data = $database->prepare("INSERT INTO post_data(username, email, password) VALUES (:username, :email, :password)");
            $send_data->bindParam(":username", $username);
            $send_data->bindParam(":email", $email);
            $send_data->bindParam(":password", $password);

            // You should handle errors during the database query execution.
            if ($send_data->execute()) {
                // ini_set('display_errors', 1);
                // error_reporting(E_ALL);
                header("Location: /database/select.php");
                exit; // Add exit here to stop further execution after the redirection
            } else {
                $error = "Error inserting data into the database.";
            }
        }
    }
}

// ini_set('display_errors', 1);
// error_reporting(E_ALL);
include "/home/voodoo/Desktop/zoofari_API/views/index.html";
?>

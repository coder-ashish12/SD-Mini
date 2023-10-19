<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "user_authentication";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $fullname = $_POST["fullname"];
    $contact = $_POST["contact"];
    $email = $_POST["email"];
    $password = password_hash($_POST["password"], PASSWORD_BCRYPT);
    $medlcn = $_POST["medlcn"];


    $sql = "INSERT INTO sd_user_authentication (fullname, contact, email, password, medlcn) VALUES ('$fullname', '$contact', '$email', '$password', '$medlcn')";

    if ($conn->query($sql) === TRUE) {
        echo json_encode(array("status" => "success", "message" => "User registered successfully"));
    } else {
        echo json_encode(array("status" => "error", "message" => "Error: " . $sql . "<br>" . $conn->error));
    }
}

$conn->close();
?>

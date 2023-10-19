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
    $email = $_POST["email"];
    $password = $_POST["password"];

    $sql = "SELECT * FROM sd_user_authentication WHERE email='$email'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        if (password_verify($password, $row["password"])) {
           echo json_encode(array("status" => "success", "message" => "Login successful"));
        } else {
           echo json_encode(array("status" => "error", "message" => "Invalid password"));
        }
     } else {
        echo json_encode(array("status" => "error", "message" => "User not found"));
     }
     
}

$conn->close();
?>

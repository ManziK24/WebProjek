<?php
//var_dump($_POST); //FOR DEBUGGING ONLY
//die();
session_start();
include 'connect.php';


if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['login'])) {

    $userName = $_POST['userName'];
    $password = $_POST['password'];

    // Fetch user by username(prepared statement)
    $stmt = $conn->prepare("SELECT id, userName, password FROM users WHERE userName = ?");
    $stmt->bind_param("s", $userName);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows === 1) {
        $row = $result->fetch_assoc();

        // Verify password against BCRYPT hash
        if (password_verify($password, $row['password'])) {
            $_SESSION['userName'] = $row['userName'];
            $_SESSION['user_id']  = $row['id'];
            $stmt->close();
            header("Location: welcome.php");
            exit();
        }
    }

    $stmt->close();
    // Invalid credentials — send back with error
    header("Location: ../pages/login.html?error=1");
    exit();

} else {
    header("Location: welcome.php");
    exit();
}
?>

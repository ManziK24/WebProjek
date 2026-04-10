<?php 
//var_dump($_POST); //FOR DEBUGGING ONLY
//die();
include 'connect.php';

if (isset($_POST['signUp'])) {
    $userName = $_POST['userName'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $passwordConfirm = $_POST['passwordConfirm'];
    $passwordHash = password_hash($password, PASSWORD_DEFAULT);

    // Validate passwords match
    if ($password !== $passwordConfirm) {
        die("Passwords do not match. <a href='../pages/signup.html'>Go back</a>");
    }
 
// Check if email already exists (prepared statement)
    $stmt = $conn->prepare("SELECT id FROM users WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $stmt->store_result();
 
    if ($stmt->num_rows > 0) {
        $stmt->close();
        die("Email already registered. <a href='../pages/signup.html'>Go back</a>");
    }
    $stmt->close();
 
    // Insert new user (prepared statement)
    $stmt = $conn->prepare("INSERT INTO users (userName, email, password) VALUES (?, ?, ?)");
    $stmt->bind_param("sss", $userName, $email, $passwordHash);
 
    if ($stmt->execute()) {
        $stmt->close();
        header("Location: ../pages/login.html");
        exit();
    } else {
        echo "Error: " . $conn->error;
    }
 
    $stmt->close();
 
} else {
    // Not a valid POST — send them back
    header("Location: ../pages/signup.html");
    exit();
}
?>
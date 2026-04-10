/*The A Team
Manzi Karama, Nathan Skerritt, Andrew Dopplinger
Generates welcome page on user login*/

<?php 
session_start();
//var_dump($_POST); //FOR DEBUGGING ONLY
//die();
include 'connect.php';

// Check if the user is logged in, if not redirect to login page
if (!isset($_SESSION['userName'])) {
    header("Location: ../pages/login.html");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome – Ebay Clone</title>
    <link rel="stylesheet" href="../includes/forms.css">
  </head>
  <body>
 
    <header>
      <div class="title">
        <h1>Ebay Clone</h1>
      </div>
      <nav>
        <div class="navigation">
          <a href="../pages/categories.html">Categories</a>
          <a href="./logout.php">Logout</a>
        </div>
      </nav>
    </header>
 
    <main>
      <div class="formContainer">
        <div class="formTitle">
          <h2>Welcome, <?php echo htmlspecialchars($_SESSION['userName']); ?>!</h2>
        </div>
        <p style="color: var(--light); margin-top: 16px;">You have successfully logged in.</p>
        <a href="logout.php" class="btn" style="margin-top: 28px; text-align: center; text-decoration: none; display: block;">Logout</a>
      </div>
    </main>
 
  </body>
</html>
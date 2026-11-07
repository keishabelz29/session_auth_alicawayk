<?php
session_start();
require_once 'db.php';


if (isset($_SESSION['user_id'])) {
    header("Location: dashboard.php");
    exit();
}


$message = '';
if (isset($_SESSION['message'])) {
    $message = $_SESSION['message'];
    unset($_SESSION['message']);
}


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = trim($_POST['username']);
    $password = $_POST['password'];


    $stmt = $conn->prepare("SELECT id, password FROM users WHERE username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $stmt->store_result();


    if ($stmt->num_rows > 0) {
        $stmt->bind_result($id, $hashed_password);
        $stmt->fetch();
        if (password_verify($password, $hashed_password)) {
            $_SESSION['user_id'] = $id;
            $_SESSION['username'] = $username;
            header("Location: dashboard.php");
            exit();
        } else {
            $message = "Invalid password!";
        }
    } else {
        $message = "User not found!";
    }
    $stmt->close();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light d-flex align-items-center justify-content-center vh-100">


    <div class="card shadow-sm p-4" style="width: 380px; border-radius: 8px;">
        <h2 class="text-center mb-4 text-dark fw-bold">Login</h2>
        
        <?php if($message): ?>
            <div class="alert alert-info text-center p-2 small"><?php echo $message; ?></div>
        <?php endif; ?>


        <form method="POST" action="">
            <div class="mb-3">
                <input type="text" name="username" class="form-control" placeholder="Username" required>
            </div>
            <div class="mb-3">
                <input type="password" name="password" class="form-control" placeholder="Password" required>
            </div>
            <button type="submit" class="btn btn-primary w-100 fw-semibold">Login</button>
        </form>
        
        <p class="text-center mt-3 mb-0 text-secondary">
            Don't have an account? <a href="register.php" class="text-decoration-none">Register here</a>
        </p>
    </div>


</body>
</html>
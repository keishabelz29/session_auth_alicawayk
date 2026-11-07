<?php
session_start();
require_once 'db.php';


$message = '';


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = trim($_POST['username']);
    $email = trim($_POST['email']);
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);


    $stmt =$conn->prepare("SELECT id FROM users WHERE username = ? OR email = ?");
    $stmt->bind_param("ss", $username,$email);
    $stmt->execute();$stmt->store_result();


    if ($stmt->num_rows > 0) {$message = "Username or Email is already taken!";
    } else {
        $stmt->close();
        $stmt =$conn->prepare("INSERT INTO users (username, email, password) VALUES (?, ?, ?)");
        $stmt->bind_param("sss", $username, $email,$password);


        if ($stmt->execute()) {$_SESSION['message'] = "Registration successful! Please log in.";
            header("Location: index.php");
            exit();
        } else {
            $message = "Error registering user.";
        }
    }
    $stmt->close();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light d-flex align-items-center justify-content-center vh-100">


    <div class="card shadow-sm p-4" style="width: 380px; border-radius: 8px;">
        <h2 class="text-center mb-4 text-dark fw-bold">Register</h2>
        
        <?php if($message): ?>
            <div class="alert alert-danger text-center p-2 small"><?php echo $message; ?></div>
        <?php endif; ?>


        <form method="POST" action="">
            <div class="mb-3">
                <input type="text" name="username" class="form-control" placeholder="Username" required>
            </div>
            <div class="mb-3">
                <input type="email" name="email" class="form-control" placeholder="Email" required>
            </div>
            <div class="mb-3">
                <input type="password" name="password" class="form-control" placeholder="Password" required>
            </div>
            <button type="submit" class="btn btn-primary w-100 fw-semibold">Register</button>
        </form>
        
        <p class="text-center mt-3 mb-0 text-secondary">
            Already have an account? <a href="index.php" class="text-decoration-none">Login here</a>
        </p>
    </div>


</body>
</html>
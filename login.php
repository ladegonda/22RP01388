<?php

require 'db.php';

session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $username = trim($_POST['username']);

    $password = trim($_POST['password']);



    $stmt = $pdo->prepare("SELECT * FROM admins WHERE username = ?");

    $stmt->execute([$username]);

    $admin = $stmt->fetch();



    if ($admin && password_verify($password, $admin['password'])) {

        $_SESSION['admin'] = $admin['username'];

        header("Location: admin.php");

        exit;

    } else {

        $error = "Invalid credentials.";

    }

}

?>

<!DOCTYPE html>

<html>

<head>

    <title>Admin Login - Unique Portal</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">

    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@600;700&display=swap" rel="stylesheet">

    <style>

        body {

            margin: 0;

            padding: 0;

            font-family: 'Montserrat', 'Segoe UI', Arial, sans-serif;

            background: linear-gradient(135deg, #232526 0%, #414345 100%);

            min-height: 100vh;

            color: #fff;

        }

        .login-header {

            text-align: center;

            margin-top: 40px;

            margin-bottom: 10px;

        }

        .login-header img {

            width: 60px;

            margin-bottom: 10px;

        }

        .login-header h2 {

            font-size: 2.1em;

            font-weight: 700;

            letter-spacing: 1px;

            color: #ffb347;

            margin: 0;

        }

        .login-header p {

            color: #e0e0e0;

            font-size: 1.1em;

            margin-top: 8px;

        }

        .container {

            max-width: 350px;

            margin: 30px auto 0 auto;

            padding: 38px 32px 28px 32px;

            background: rgba(255,255,255,0.07);

            border-radius: 18px;

            box-shadow: 0 8px 32px 0 rgba(31,38,135,0.18);

            backdrop-filter: blur(4px);

            border: 1.5px solid rgba(255,255,255,0.18);

        }

        form {

            display: flex;

            flex-direction: column;

            gap: 18px;

        }

        input[type="text"],

        input[type="password"] {

            padding: 13px;

            border: none;

            border-radius: 8px;

            font-size: 15px;

            background: #232526;

            color: #fff;

            box-shadow: 0 2px 8px rgba(0,0,0,0.08);

            margin-bottom: 6px;

        }

        input[type="text"]:focus,

        input[type="password"]:focus {

            outline: 2px solid #ffb347;

            background: #2c2c2c;

        }

        button {

            padding: 13px;

            background: linear-gradient(90deg, #ffb347 0%, #ffcc33 100%);

            border: none;

            color: #232526;

            border-radius: 8px;

            font-size: 17px;

            font-weight: 700;

            cursor: pointer;

            transition: background 0.2s;

            margin-top: 8px;

        }

        button:hover {

            background: linear-gradient(90deg, #ffcc33 0%, #ffb347 100%);

        }

        .register-link {

            text-align: center;

            margin-top: 10px;

        }

        .register-link a {

            color: #ffb347;

            text-decoration: underline;

        }

        .error-message {

            background: #ffdddd;

            color: #c0392b;

            border: 1px solid #ffb3b3;

            padding: 10px;

            border-radius: 8px;

            margin-bottom: 12px;

            text-align: center;

        }

        .login-footer {

            text-align: center;

            color: #bbb;

            font-size: 0.98em;

            margin-top: 40px;

            letter-spacing: 0.5px;

        }

    </style>

</head>

<body>

    <div class="login-header">

        <img src="https://img.icons8.com/ios-filled/100/ffb347/lock-2.png" alt="Admin Icon" />

        <h2>Admin Portal</h2>

        <p>Unique Login Experience</p>

    </div>

    <div class="container">

        <?php if (isset($error)) echo "<div class='error-message'>$error</div>"; ?>

        <form method="post">

            <input type="text" name="username" placeholder="Username" required>

            <input type="password" name="password" placeholder="Password" required>

            <button type="submit">Login</button>

        </form>

        <div class="register-link">

            Don't have an admin account? <a href="register.php">Register</a>

        </div>

    </div>

    <div class="login-footer">

       

    </div>

</body>

</html>
